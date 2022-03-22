<?php

namespace App\Http\Controllers;

use App\Enquire;
use App\Property;
use App\Invoice;
use App\Paypal;
use App\PaymentHistory;
use Cartalyst\Stripe\Stripe;
use App\Http\Requests\Admin\UpdatePaynowRequest;
use App\Notifications\WL_EmailNotification;

use Tzsk\Payu\Facade\Payment;
use \PDF;
use Auth;
use Validator;
use Carbon;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class InvoiceController extends Controller
{
 
  public function __construct()
    { 
     $this->middleware('auth');
    }

  // Unpaid Invoices
     public function unpaidInvoices(Request $request)
      {

      $customer_name = $request->customer_name;

      $customer_mobile = $request->customer_mobile;
     


      if ( ! empty( $customer_name  ) ) {


              $data = 
              [
              'items'      =>  \DB::table('invoices')
                                ->where('paymentstatus','unpaid')
                                ->select('invoices.*', 'customer_id')
                                ->join('users', 'invoices.customer_id', '=', 'users.id')
                                ->where('invoices.customer_id', $customer_name)
                                ->paginate(50),
              ]; 

       }

      else if ( ! empty( $customer_mobile  ) ) {


              $data = 
              [
              'items'      =>  \DB::table('invoices')
                                ->where('paymentstatus','unpaid')
                                ->select('invoices.*', 'customer_id')
                                ->join('users', 'invoices.customer_id', '=', 'users.id')
                                ->where('users.mobile','Like', "%$customer_mobile%")
                                ->paginate(50),
              ]; 

       }


       else
       {
            $data = 
            [
            'items'         => Invoice::latest('updated_at')->where('paymentstatus', 'unpaid')->paginate(50),
            ]; 
       }



      

        return view('admin.invoices.unpaid-invoices',$data);
      }
  //end unpaid invoices

      // Show Unpaid Invoices
     public function show(Request $request , $id)
      {

       $data = 
      [
        'item'         => Invoice::findOrFail($id),
      ]; 
        

        return view('admin.invoices.unpaid-invoices.show', $data);
      }
  //end Show unpaid invoices

   //Payment
    public function payNow( Request $request, $id )
    { 

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

      $item = Invoice::where('id', '=', $id)->where('customer_id', '=', getContactId())->first();

        if ( ! $item ) {
            flashMessage('danger', 'not_found' );
            return back();
        }

        $payment_gateway = $request->payment_gateway;

        $data = array(
            'paymentmethod' => $payment_gateway,
            'total_amount'  => $item->total_amount,
        );

        // Let us apply few validations here before saving data.
       $currency_code = getDefaultCurrency( 'code' );

      if ( 'paypal' === $payment_gateway ) {
            if ( ! in_array( strtoupper( $currency_code ), paypalCurrencies() ) ) {
                flashMessage('danger', 'create', trans('global.orders.paypal-currency-not-supported'));
                return back();
            }
        }

        if ( 'stripe' === $payment_gateway ) {
            if ( ! in_array( strtolower( $currency_code ), stripeCurrencies() ) ) {
                flashMessage('danger', 'create', trans('global.orders.stripe-currency-not-supported'));
                return back();
            }
        }

        if ( 'payu' === $payment_gateway ) {
            if ( ! in_array( strtolower( $currency_code ), ['inr'] ) ) {
                flashMessage('danger', 'create', trans('global.orders.payu-currency-not-supported'));
                return back();
            }
        }

       if ( $id > 0 ) 
       {
         $user = \App\User::where('id', '=', getContactId())->first();
        $token = $this->preserveBeforeSave( $id, $payment_gateway );

         if ( 'paypal' === $payment_gateway ) {
            $paypal = new Paypal();
            $paypal->config['return']        = route('payment.process-payment', [ $token ] );
            $paypal->config['currency_code'] = $currency_code;
            
            $paypal->config['invoice'] = $token;
            $paypal->config['first_name'] = $user->name;

       
        
          $invoice_id = $item->id;
          $paypal->add($item->id, $item->total_amount, "" , $invoice_id); //ADD  item
          return $paypal->pay(); //Proccess the payment

          }if ( 'payu' === $payment_gateway ) {

                $payu_testmode = getSetting('payu_testmode','payu', 'true');
                $payu_provider = getSetting('payu-provider', 'payu', 'payubiz');

                $env = ( 'true' === $payu_testmode ) ? 'test' : 'secure';
                $payconfig = array( 'payu.env' => $env);
                $payconfig['payu.default'] = $payu_provider;
                                
                if ( 'payubiz' === $payu_provider ) {
                    $payconfig['payu.accounts.payubiz.key'] = getSetting('payu_merchant_key','payu', 'gtKFFx');
                    $payconfig['payu.accounts.payubiz.salt'] = getSetting('payu_salt','payu', 'eCwWELxi');
                } else {
                    $payconfig['payu.accounts.payumoney.key'] = getSetting('payu_merchant_key','payu', 'JBZaLc');
                    $payconfig['payu.accounts.payumoney.salt'] = getSetting('payu_salt','payu', 'GQs7yium');
                }
                config( $payconfig ); // Write the dynamic values from DB.
                
                     $parameters = [
                          'txnid'         => $token . '_' . date("ymds"),
                          'order_id'    => '',
                          'firstname'   => $user->name,
                          'email'       => $user->email,
                          'phone'       => ($user->phone_number)? $user->phone_number : '45612345678',
                          'productinfo' => ! empty( $invoice->id ) ? $invoice->id : trans('custom.messages.invoice-payment'),
                          'amount'      => $item->total_amount,
                          'surl'        => route('payment.process-payu', [ $token ] ),
                          'furl'        => route('payment.payment-failed', [ $token ] ),
                          
                          'lastname'    => '',
                          'address1'    => '',
                          'address2'    => '',
                          'city'        => '',
                          'state'       => '',
                          'country'     => '',
                          'zipcode'     => '',
                          'curl'        => route('payment.payment-cancelled', [ $token ] ),
                          'udf1'        => $item->id,
                          'udf2'        => '',
                          'udf3'        => '',
                          'udf4'        => '',
                          'udf5'        => '',
                          'pg'        => 'NB',
                       ];
                       
   
                return Payment::make($parameters, function ($then) use( $token) {
                    $then->redirectRoute('payment.process-payu', [$token]);
                });
            }
            elseif ( 'stripe' === $payment_gateway ) {

                      if ( isDemo() ) {
                      return prepareBlockUserMessage( 'info', 'crud_disabled' );
                      }
                
               $currency_code = getDefaultCurrency( 'code' );
                if ( ! in_array( strtolower( $currency_code ), stripeCurrencies() ) ) {
                    flashMessage('danger', 'create', trans('global.orders.stripe-currency-not-supported'));
                    return redirect()->route('admin.orders.checkout');
                }

                $stripe_key = getSetting( 'stripe_key', 'stripe' );
                $stripe_secret = getSetting( 'stripe_secret', 'stripe' );

                $stripe_config = array(
                    'services.stripe.key'    => $stripe_key,
                    'services.stripe.secret' => $stripe_secret,
                );
                config( $stripe_config ); // Write the dynamic values from DB.

                $stripe = new Stripe($stripe_secret);

                $stripe_token = $request->stripeToken;
                if ( empty( $stripe_token ) ) {
                    return view('admin.unpaid-invoices.show', compact('slug', 'module', 'item'));
                }
                $user_email = getContactInfo('', 'email');
                $amount = $item->total_amount;

                $merchant_payment_confirmed = false;
                
                $customer = $stripe->customers()->create(array(
                  "email" => $user_email,
                  "source" => $stripe_token,
                ));

            //Stripe will not accept amount above 999999.99     
            if ( $item->total_amount > 999999.99 ) {
                flashMessage('danger', 'create', trans('global.orders.amount-danger-alert'));
                return back();
            }
        

                if ( $customer ) {
                    $merchant_payment_confirmed = true;

                    $charge = $stripe->charges()->create([
                        'customer' => $customer['id'],
                        'currency' => $currency_code,
                        'amount'   => $amount,
                    ]);
                } else {
                    flashMessage('danger', 'create', trans('global.orders.stripe-token-error'));
                    return redirect()->route('unpaid.invoices');
                }
                
                if ( $merchant_payment_confirmed ) {
                          
                    $payment_record = PaymentHistory::where('slug', '=', $token)->first();

                    if ( ! $payment_record ) {
                        flashMessage('danger', 'not_found', trans('custom.messages.not_found_payment') );
                        return back();
                    }
                    // Payment done
                    if( $this->processPaymentRecord($payment_record) ) {
                        $amount = $charge['amount'] / 100;

                        $payment_record->paymentstatus = PAYMENT_STATUS_SUCCESS;
                        $payment_record->transaction_data = json_encode($charge);
                        $payment_record->transaction_id = $charge['id'];
                        $payment_record->amount = $amount;
                        $payment_record->save();

                        $record = Invoice::find( $payment_record->invoice_id );
                        $record->paymentstatus = 'paid';
                        $record->save();

                        $this->notifyCustomer( $payment_record );
                        
                        flashMessage('success', 'create', trans('global.orders.payments.success'));
                        return redirect()->route('invoice.payment-success', [$token]);
                    } else {
                        flashMessage('danger', 'not_found', trans('global.orders.stripe-payment-failed') );
                        return redirect()->route('admin.orders.payment-now', $token);
                    }
                } else {
                    flashMessage('danger', 'create', trans('global.orders.stripe-token-error'));
                    return redirect()->route('unpaid.invoices');
                }       
            }
        } else {
            flashMessage('danger', 'somethiswentwrong');
            return back();
        }


       } 
       
    
   // End Payment


   //Preserve To Save
    private function preserveBeforeSave( $id , $paymentmethod  ) {
      $user = \App\User::where('id', '=', getContactId())->first();
      $invoice = \App\Invoice::find( $id );
      $payment                   = new PaymentHistory();
      $payment->invoice_id       = $invoice->id;
      $payment->description      = $invoice->description;  
      $payment->paymentmethod    = $paymentmethod;
      $payment->invoice_action   = $invoice->action;
      $payment->slug             = md5(microtime() . $invoice->id . rand());
      $payment->customer_id      = $user->id;
      $payment->paymentstatus    = PAYMENT_STATUS_PENDING;

      $payment->save();
     
      return $payment->slug;
    }
   //End Preserve To Save   

    // Paypal Process Payment
         // Paypal & Stripe Payment Process
    public function processPayment( Request $request, $slug ) {

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
        $response = $request->all();      
        $payment_record = \App\PaymentHistory::where('slug', '=', $slug)->first();

      
            if ( ! $payment_record ) {
                flashMessage('danger', 'not_found', trans('custom.messages.not_found_payment') );
                return back();
            }
            
            if ( ! empty( $request->paymentmethod ) && 'stripe' === $request->paymentmethod ) {

              $currency_code = getCurrency( $payment_record->invoice->currency_id, 'code');

                if ( ! in_array( strtolower( $currency_code ), stripeCurrencies() ) ) {
                    flashMessage('danger', 'create', trans('global.orders.stripe-currency-not-supported'));
                    return back();
                }

                $stripe_key = getSetting( 'stripe_key', 'stripe' );
                $stripe_secret = getSetting( 'stripe_secret', 'stripe' );

                $stripe_config = array(
                    'services.stripe.key'    => $stripe_key,
                    'services.stripe.secret' => $stripe_secret,
                );
                config( $stripe_config ); // Write the dynamic values from DB.

                $stripe = new Stripe($stripe_secret);

                $stripe_token = $request->stripeToken;
                $user_email = getContactInfo('', 'email');
                $amount = $payment_record->amount;
                
                $merchant_payment_confirmed = false;
                
        $token_chk = $stripe->tokens()->find( $stripe_token );
        
        if ( ! $token_chk ) {
          flashMessage('danger', 'create', trans('global.orders.stripe-token-not-found'));
                    return back();
        }
        
        if ( $token_chk['used'] ) {
          flashMessage('danger', 'create', trans('global.orders.stripe-token-error'));
                    return back();
        }
                        
        $customer = $stripe->customers()->create(array(
                  "email" => $user_email,
                  "source" => $stripe_token,
                ));
        
      
                if ( $customer ) {
                    $merchant_payment_confirmed = true;

                    $charge = $stripe->charges()->create([
                        'customer' => $customer['id'],
                        'currency' => $currency_code,
                        'amount'   => $amount,
                    ]);
                } else {
                    flashMessage('danger', 'create', trans('global.orders.stripe-token-error'));
                    return back();
                }
                
        $invoice_id = $payment_record->invoice_id;
        
        $route = 'unpaidinvoice.show';
                
                if ( $merchant_payment_confirmed ) {
                    // Payment done
                    if( $this->processPaymentRecord($payment_record) ) {

                        $amount = $charge['amount'] / 100;

                        $payment_record->transaction_id = ! empty( $charge['id'] ) ? $charge['id'] : null;
                         $payment_record->paymentstatus = PAYMENT_STATUS_SUCCESS;
                         $payment_record->transaction_data = json_encode($charge);
                        $payment_record->amount = $item->total_amount;
                        $payment_record->save();

              
              $payment_record->invoice->paymentstatus = 'paid';
              $payment_record->invoice->save();
             
            

              $invoice = \App\Invoice::find( $invoice_id );
              $route = 'admin.invoices.show';
          

          $this->notifyCustomer(  $payment_record );
                        
            flashMessage('success', 'create', trans('global.orders.payments.success'));
                        
            return redirect()->route($route, $invoice_id);
                    } else {
                        flashMessage('danger', 'not_found', trans('global.orders.stripe-payment-failed') );
                        return redirect()->route($route, $invoice_id);
                    }
                } else {
                    flashMessage('danger', 'create', trans('global.orders.stripe-token-error'));
                    return redirect()->route($route, $invoice_id);
                } 
            } else { 
            // Paypal processing.
                
              if( $this->processPaymentRecord( $payment_record ) ) {
                  $amount = $request->mc_gross;
          
                  $payment_record->transaction_id = $request->txn_id;
                  $payment_record->paymentstatus = PAYMENT_STATUS_SUCCESS;
                  $payment_record->transaction_data = json_encode($response);
                  $payment_record->amount = $amount;
                  $payment_record->save();

      
                  $invoice_id = $payment_record->invoice_id;
                  $invoice = \App\Invoice::find( $invoice_id );
                  $invoice->paymentstatus = 'paid';
                  $invoice->save();
                 
                  $this->notifyCustomer( $payment_record );

                    flashMessage('success', 'create', trans('global.orders.payments.success'));
                        return redirect()->route('invoice.payment-success', [$slug]);
            } else {
                  return back();
              }
          }
        
    }

    //End Paypal Process Payment

    //Process PayU
      public function processPayu( $slug ) {

         if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }


        $payment = Payment::capture();
        // Get the payment status.
        $isdone = $payment->isCaptured(); # Returns boolean - true / false
        
        $payment_record = PaymentHistory::where('slug', '=', $slug)->first();
        if ( ! $payment_record ) {
            flashMessage('danger', 'not_found', trans('custom.messages.not_found_payment') );
            return back();
        }

        if( $this->processPaymentRecord( $payment_record) ) {
           

            if ( $isdone ) {

            $amount = $payment->total_amount;

            $payment_record->paymentstatus = PAYMENT_STATUS_SUCCESS;
            $payment_record->transaction_data = json_encode($payment->getData());
            $payment_record->transaction_id =  $payment->txnid;
            $payment_record->amount = $amount;
            $payment_record->save();

            $record = Invoice::find( $payment_record->invoice_id );
            $record->paymentstatus = 'paid';
            $record->save();


                $this->notifyCustomer( $payment_record );
                

                flashMessage('success', 'create', trans('global.orders.payments.success'));
                return redirect()->route('invoice.payment-success', [$slug]);
            } else {
                flashMessage('danger', 'create', trans('global.orders.payments.failed'));
                return redirect()->route('unpaid.invoices');
            }
        } else {
            return redirect()->route('invoice.paynow', $slug);
        }
    }

    //End Process PayU

       /**
     * This method Process the payment record by validating through 
     * the payment status and the age of the record and returns boolen value
     * @param  Payment $payment_record [description]
     * @return [type]                  [description]
     */
    protected  function processPaymentRecord(PaymentHistory $payment_record)
    {
        
        if(!$this->isValidPaymentRecord($payment_record))
        {
            flashMessage('danger','invalid_record');
            return FALSE;
        }

        if($this->isExpired($payment_record))
        {
            flashMessage('danger','time_out');
            return FALSE;
        }

        return TRUE;
    }
    //End Process Payment Record

    // Validate Record
          /**
     * This method validates the payment record before update the payment status
     * @param  [type]  $payment_record [description]
     * @return boolean                 [description]
     */
    public static function isValidPaymentRecord(PaymentHistory $payment_record)
    {
        $valid = FALSE;
        
        if($payment_record)
        {
            if( empty( $payment_record->paymentstatus ) || $payment_record->paymentstatus == PAYMENT_STATUS_PENDING || $payment_record->paymentmethod=='offline')
                $valid = TRUE;
        }
        return $valid;
    }
    //End Validate Record

        /**
     * This method checks the age of the payment record
     * If the age is > than MAX TIME SPECIFIED (30 MINS), it will update the record to aborted state
     * @param  payment $payment_record [description]
     * @return boolean                 [description]
     */
    public static function isExpired(PaymentHistory $payment_record)
    {

        $is_expired = FALSE;
        if ( $payment_record ) {
            $to_time = strtotime(Carbon\Carbon::now());
            $from_time = strtotime($payment_record->updated_at);
            $difference_time = round(abs($to_time - $from_time) / 60,2);

            $payment_record_max_time_minutes = getSetting('payment-record-max-time-minutes', 'order-settings');
            if( empty( $payment_record_max_time_minutes ) ) {
                $payment_record_max_time_minutes = PAYMENT_RECORD_MAXTIME;
            }

            if($difference_time > $payment_record_max_time_minutes)
            {
                $payment_record->paymentstatus = PAYMENT_STATUS_CANCELLED;
                $payment_record->save();
                 $this->notifyCustomer( $payment_record );
                return $is_expired =  TRUE;
            }
        }
        return $is_expired;
    }

    // Notify Customer
        public function notifyCustomer( PaymentHistory $invoice ) {
          $customer = $invoice->customer()->first();


           if ( $customer ) {
            // Notification to user
            $site_logo = getSetting( 'site_logo', 'site_settings' );
            $country_code = getSetting('country_code','site_settings');
            
            $templatedata = array(
                'client_name' => $customer->name,
                'transaction_id' => $invoice->transaction_id,
                'content' => 'Invoice has been created',
                'status' => $invoice->paymentstatus,
                'paymentmethod' => $invoice->paymentmethod,
                'amount' => $invoice->amount."".getCurrency( $invoice->customer->currency_id, 'symbol'),
                'customer_id' => $invoice->customer_id,

                'site_address' => getSetting( 'site_address', 'site_settings'),
                'site_phone' => getSetting( 'site_phone', 'site_settings'),
                'site_email' => getSetting( 'contact_email', 'site_settings'),                
                'site_title' => getSetting( 'site_title', 'site_settings'),
                'country_code' => $country_code,
                'site_logo' => asset( 'uploads/settings/' . $site_logo ),
                'date' => date('Y-m-d'),
                'site_url' => config('app.url'),
            );

            if ( $invoice->customer->name ) {
                $templatedata['customer_id'] = $invoice->customer->name;
            }
            
           
            $data = [
                "action" => "Created",
                "crud_name" => "User",
                'template' => 'invoice-payment-success',
                'model' => 'App\PaymentHistory',
                'data' => $templatedata,
            ];
            
            $customer->notify(new WL_EmailNotification($data));
        }
    }
    //End Notify Customer


    // Bookings
     public function bookings()
      {
      

       $data = 
      [
      'items'   => Invoice::where('action','booking-initiated')->where('paymentstatus', '!=' , 'partially paid')->get(),
      ]; 

        return view('admin.invoices.bookings.bookings',$data);
      }
  //end Bookings

    //Except unpaid invoices

       public function paidInvoices(Request $request)
      {

        //start
         $invoice_footer_enable = getSetting('invoice-footer-enable', 'invoice-settings');

          $customer_name = $request->customer_name;

          $customer_mobile = $request->customer_mobile;



      if ( ! empty( $customer_name  ) ) {


              $data = 
              [
              'items'      =>  PaymentHistory::
                                join('users', 'payment_history.customer_id', '=', 'users.id')
                                ->where('payment_history.customer_id', $customer_name)
                                ->where('paymentstatus','success')
                                ->get(),
              ]; 

       }

      else if ( ! empty( $customer_mobile  ) ) {


              $data = 
              [
              'items'      =>  PaymentHistory::
                                join('users', 'payment_history.customer_id', '=', 'users.id')
                                ->where('users.mobile','Like', "%$customer_mobile%")
                                ->where('paymentstatus','success')
                                ->get(),
              ]; 

       }


       else
       {
            $data = 
            [
            'items'         => PaymentHistory::latest('updated_at')->where('paymentstatus','success')->get(),
            ]; 
       }


        return view('admin.invoices.payment-history.payment-history',$data);
      }
    //End Except unpaid invoices  

          //Booking Invoice PDF

     public function bookingPDF( $id ) {
        
        $item = Invoice::where('id', $id )->first();
        
        if (! $item) {
            flashMessage( 'danger', 'create', trans('custom.settings.no_records_found'));
            return redirect()->back();
        }

        
        $file_name = $item->id . '.pdf';
        $path = public_path("uploads/booking-initiated-invoices" . $file_name);
        
        PDF::loadView('admin.invoices.bookings.invoice-content', compact('item'))->save( $path , true );

        return response()->download($path);
        
    }
    //End Booking Invoice PDF  

    //Payment Success
       public function paymentSuccess( $slug ) {
        $item = PaymentHistory::where('slug', '=', $slug)->first();
        
        return view('admin.invoices.payments.payment-success', compact('slug','item'));
    }
    //End Payment Success

    //Invoice PDF

     public function invoicePDF( $id ) {

        $item = PaymentHistory::where('id', $id )->first();
        if (! $item) {
            flashMessage( 'danger', 'create', trans('custom.settings.no_records_found'));
            return redirect()->back();
        }

        
        $file_name = time() . '.pdf';
        $path = public_path("uploads/invoices" . $file_name);
        PDF::loadView('admin.invoices.invoice-content', compact('item'))->save( $path , true );

        return response()->download($path);
        
    }
    //End Invoice PDF  


    //Invoice Payment Form
      public function paymentForm( Request $request ){
        if (request()->ajax()) {
       
            $action = request('action');
            $id = request('invoice_id');


            $item = Invoice::findOrFail($id);

            $sub = substr($action, -3);

            if ( 'pay' === $sub ) {
                $action = substr($action, 0, -4);
            }

            if ( 'pay' === $sub ) {
             return view( 'admin.invoices.forms.payment-form', compact('item', 'action', 'sub'));
             }
                       

        }
        
    }
      //End Invoice Payment Form

        //save Payment
    public function savePaymentForm( Request $request ){
     if (request()->ajax()) {

            $post   = request('data');
            
            $sub    = $post['sub'];
            
            $id                  = $post['invoice_id'];
            $action              = $post['action'];

            $response = array('status' => 'danger', 'message' => 'Something went wrong' );

             $item = Invoice::findOrFail($id);

             if( $action == 'invoice-payment')
             { 
                //Payment Details
                $customer_name         = $post['customer_name'];
                $customer_email        = $post['customer_email'];
                $customer_mobile       = $post['customer_mobile'];  
                $company_name          = $post['company_name'];  
                $no_of_seats           = $post['no_of_seats'];  
                $total_amount          = $post['total_amount'];  
                $invoice_action        = $post['invoice_action'];  
                $action                = $post['action'];
                $property_id           = $post['property_id'];
                $amount                = $post['amount'];
                $gstin                 = $post['gstin'];
                $paymentstatus         = 'paid';
               //end Payment Details 

                $item->paymentstatus = $paymentstatus;

                $item->save();


                $payment_history = array(
                    'invoice_id'                => $id,
                    'paymentstatus'             => 'success',
                    'transaction_id'            => $post['transaction_id'],
                    'slug'                      => md5(microtime() . $id . rand()),
                    'invoice_action'            => $invoice_action,
                    'paymentmethod'             => 'offline',
                    'customer_id'               => $item->customer_id,
                    'amount'                    => $item->total_amount,
                );
                \App\PaymentHistory::create( $payment_history ); 
            }
         
         
        elseif( $action == 'update-status' )
            {
                //comments details
                 $update_status         = $post['update_status'];
                 $update_status_user    = $post['update_status_user'];
                 $update_status_created = $post['update_status_created'];
                 $update_status_updated = $post['update_status_updated'];
                //end comments details
                 $item->update_status      = $update_status;
                 if( $item->update_status == 'Requirement Received' ){
                    $item->progress = 25;
                 }elseif($item->update_status == 'Options Sent'){
                    $item->progress = 35;
                 }elseif($item->update_status == 'Visit Scheduled'){
                    $item->progress = 50;
                 }elseif($item->update_status == 'Booking Initiated'){
                    $item->progress = 90;
                 }elseif($item->update_status == 'Deal Completed'){
                    $item->progress = 100;
                 }

                 $item->save(); 
                    
               
                $update_status_log = array(
                    'invoice_id'                => $id,
                    'action'                    => $action,
                    'update_status_user'        => $update_status_user,
                    'update_status_created'     => $update_status_created,
                    'update_status_updated'     => $update_status_updated,
                );
                \App\UpdateStatusLog::create( $update_status_log );   

            } 
             

           return response()->json(['success'=>'Successfully Saved']);   

        }
        
    }
    // end save payment


  // Unpaid Invoices Destroy
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {

      if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
         $record = Invoice::getRecordWithId($id);
        
         $record->delete(); 

         flashMessage( 'success', 'delete' );
         return redirect()->route('unpaid.invoices');
       
    }  
    //end unpaid invoices Destroy
    	
}