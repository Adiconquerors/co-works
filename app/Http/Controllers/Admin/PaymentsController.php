<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;


use App\Paypal;
use Tzsk\Payu\Facade\Payment;
use Cartalyst\Stripe\Stripe;

use Carbon;

class PaymentsController extends Controller
{
    public function payNow($module, $id, $paymethod )
    {
        
        
        if ( in_array( $module, array( 'invoice', 'recurring_invoices' ) ) ) {
            if ( 'invoice' === $module ) {
                $invoice = \App\Invoice::find( $id );
            } elseif ( 'recurring_invoices' === $module ) {
                $invoice = \Modules\RecurringInvoices\Entities\RecurringInvoice::find( $id );
            }
            

            if ( ! $invoice ) {
                flashMessage('danger', 'not_found' );
                return back();
            }

            $user = \App\User::where('id', '=', getContactId())->first();
            
         

            $amount_payable = $invoice->total_amount;
           
            if ( $amount_payable <= 0 ) {                
                flashMessage('danger', 'create', trans('custom.messages.amount-should-greater-than-zero'));
                return back();                
            }
            
            $token = $this->preserveBeforeSave( $module, $id, $paymethod, $invoice );
            

            
            if ( 'paypal' === $paymethod ) {
                $paypal = new Paypal();
                $paypal->config['return']        = route('payment.process-payment', [ $token, $module ] );
                $paypal->config['cancel_return'] = route('payment.payment-failed', [ $token, $module ] );
                $paypal->config['invoice'] = $token;
                $paypal->config['first_name'] = $user->name;
                
                
               
                
                $invoice_no = $invoice->invoice_no;
                $paypal->add($invoice->id, $amount_payable, $invoice_no); //ADD  item
                
                return $paypal->pay(); //Proccess the payment
            } elseif ( 'payu' === $paymethod ) {
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
                          'firstname'   => $user->first_name,
                          'email'       => $user->email,
                          'phone'       => ($user->phone1)? $user->phone1 : '45612345678',
                          'productinfo' => ! empty( $invoice->title ) ? $invoice->title : trans('custom.messages.invoice-payment'),
                          'amount'      => $amount_payable,
                          'surl'        => route('admin.payment.process-payu', [ $token, $module ] ),
                          'furl'        => route('admin.payment.payment-failed', [ $token, $module ] ),
                          
                          'lastname'    => $user->last_name,
                          'address1'    => $user->address,
                          'address2'    => '',
                          'city'        => $user->city,
                          'state'       => $user->state_region,
                          'country'     => $user->country->title,
                          'zipcode'     => $user->zip_postal_code,
                          'curl'        => route('admin.payment.payment-cancelled', [ $token, $module ] ),
                          'udf1'        => $id,
                          'udf2'        => '',
                          'udf3'        => '',
                          'udf4'        => '',
                          'udf5'        => '',
                          'pg'        => 'NB',
                       ];
   
                
                return Payment::make($parameters, function ($then) use( $token, $module) {
                    $then->redirectRoute('admin.payment.process-payu', [$token, $module]);
                });
            } elseif ( 'stripe' === $paymethod ) {
                    $invoice = \App\Invoice::findOrFail($id);
                    return view('admin.invoices.stripe-payment', compact('invoice', 'token')); 
            }
        }
    }


    private function preserveBeforeSave( $module, $id, $paymethod, $predata ) {
         
        if ( 'invoice' === $module ) {
            $invoice = \App\Invoice::find( $id );
        } elseif ( 'recurring_invoices' === $module ) {
            $invoice = \Modules\RecurringInvoices\Entities\RecurringInvoice::find( $id );
        }   
       
        $amount         = $predata->total_amount;
        $invoice_action = $predata->invoice_action;
        $invoice_id     = $predata->id;
        
         if ( $amount <= 0 ) {                
                flashMessage('danger', 'create', trans('custom.messages.amount-should-greater-than-zero'));
                return back();                
            }

        $data = array(
            
            'amount' => $amount,
            'transaction_id' => '',
            'invoice_action' => $invoice_action,
            'invoice_id'     => $invoice_id,
            'paymentmethod' => $paymethod,
            'slug' => md5(microtime() . $id . rand()),
            'paymentstatus' => PAYMENT_STATUS_PENDING,
        );
        
        if ( 'invoice' === $module ) {
            $data['description'] = 'Payment for invoice #' . $predata->invoice_no;
            $data['invoice_id'] = $id;
            $paymetn_id = \App\PaymentHistory::create( $data );
        } elseif ( 'recurring_invoices' === $module ) {
            $data['description'] = 'Payment for recurring invocie #' . $predata->invoice_no;
            $data['invoice_id'] = $id;
            $paymetn_id = \Modules\InvoicePayments\Entities\InvoicePayment::create( $data );
        }
        return $data['slug'];
    }

    // Paypal & Stripe Payment Process
    public function processPayment( Request $request, $slug, $module ) {
        
        $response = $request->all();
        
        if ( in_array( $module, array( 'invoice', 'recurring_invoices' ) ) ) {
            if ( 'invoice' === $module ) {
                $payment_record = \App\PaymentHistory::where('slug', '=', $slug)->first();
            } elseif ( 'recurring_invoices' === $module ) {
                $payment_record = \Modules\RecurringInvoices\Entities\RecurringInvoicePayment::where('slug', '=', $slug)->first();
            }
            
            if ( ! $payment_record ) {
                flashMessage('danger', 'not_found', trans('custom.messages.not_found_payment') );
                return back();
            }
            
            if ( ! empty( $request->paymethod ) && 'stripe' === $request->paymethod ) {
                
                

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
                    flashMessage('danger', 'create', trans('orders::global.orders.stripe-token-not-found'));
                    return back();
                }
                
                if ( $token_chk['used'] ) {
                    flashMessage('danger', 'create', trans('orders::global.orders.stripe-token-error'));
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
                        
                        'amount'   => $amount,
                    ]);
                } else {
                    flashMessage('danger', 'create', trans('orders::global.orders.stripe-token-error'));
                    return back();
                }
                
                $invoice_id = $payment_record->invoice_id;
                if ( 'recurring_invoices' === $module ) {
                    $invoice_id = $payment_record->invoice_id;
                }
                $route = 'unpaidinvoices.show';
                if ( 'recurring_invoices' === $module ) {
                  $route = 'admin.recurring_invoices.show';  
                }
                if ( $merchant_payment_confirmed ) {
                    // Payment done
                    if( $this->processPaymentRecord($slug, $module, $payment_record) ) {
                        $amount = $charge['amount'] / 100;

                        $payment_record->transaction_id = ! empty( $charge['id'] ) ? $charge['id'] : null;
                        $payment_record->paymentstatus = PAYMENT_STATUS_SUCCESS;
                        $payment_record->transaction_data = json_encode($charge);
                        $payment_record->amount = $amount;
                        $payment_record->save();

                        if ( 'invoice' === $module ) {
                            $payment_record->invoice->paymentstatus = 'paid';
                            $payment_record->invoice->save();
                        } elseif ( 'recurring_invoices' === $module ) {
                            $payment_record->invoice->paymentstatus = 'paid';
                            $payment_record->invoice->save();
                        }
                        
                        if ( 'invoice' === $module ) {
                            $invoice = \App\Invoice::find( $invoice_id );
                            $route = 'admin.invoices.show';
                        } elseif ( 'recurring_invoices' === $module ) {
                            $invoice = \Modules\RecurringInvoices\Entities\RecurringInvoice::find( $invoice_id );
                            $route = 'admin.recurring_invoices.show';
                        }
                        
                
                        
                        flashMessage('success', 'create', trans('orders::global.orders.payments.success'));
                        
                        return redirect()->route($route, $invoice_id);
                    } else {
                        flashMessage('danger', 'not_found', trans('orders::global.orders.stripe-payment-failed') );
                        return redirect()->route($route, $invoice_id);
                    }
                } else {
                    flashMessage('danger', 'create', trans('orders::global.orders.stripe-token-error'));
                    return redirect()->route($route, $invoice_id);
                } 
            } else { // Paypal processing.
                
                if( $this->processPaymentRecord($slug, $module, $payment_record) ) {
                    $amount = $request->mc_gross;
                    
                    $payment_record->transaction_id = $request->txn_id;
                    $payment_record->paymentstatus = PAYMENT_STATUS_SUCCESS;
                    $payment_record->transaction_data = json_encode($response);
                    $payment_record->amount = $amount;
                    $payment_record->save();

                    if ( 'recurring_invoices' === $module ) {
                        $invoice_id = $payment_record->invoice_id;
                        $invoice = \Modules\RecurringInvoices\Entities\RecurringInvoice::find( $invoice_id );
                        $invoice->paymentstatus = 'paid';
                        $invoice->save();
                    } elseif ( 'invoice' === $module ) {
                        $invoice_id = $payment_record->invoice_id;
                        $invoice = \App\Invoice::find( $invoice_id );
                        $invoice->paymentstatus = 'paid';
                        $invoice->save();
                    }               

             

                    $this->notifyCustomer( $module, $invoice_id, $invoice );

                   
                    if ( 'recurring_invoices' === $module ) {
                        return redirect()->route('admin.recurring_invoices.show', $payment_record->invoice_id);
                    } else { // Defaults to Invoices
                        return redirect()->route('admin.invoices.show', $payment_record->invoice_id);
                    }
                } else {
                    return back();
                }
            }
        }
    }

    public function processPayu( $slug, $module ) {
        
        $payment = Payment::capture();
        
        // Get the payment status.
        $isdone = $payment->isCaptured(); # Returns boolean - true / false
        
        if ( 'recurring_invoices' === $module ) {
            $payment_record = \Modules\InvoicePayments\Entities\InvoicePayment::where('slug', '=', $slug)->first();
        } elseif ( 'invoice' === $module ) {
            $payment_record = \Modules\InvoicePayments\Entities\InvoicePayment::where('slug', '=', $slug)->first();
        }
        if ( ! $payment_record ) {
            flashMessage('danger', 'not_found', trans('custom.messages.not_found_payment') );
            return redirect()->route('admin.invoices.index');
        }

        if( $this->processPaymentRecord($slug, $module, $payment_record) ) {
            $amount = $payment->amount;

            if ( $isdone ) {
                $payment_record->payment_status = PAYMENT_STATUS_SUCCESS;
            }
            $payment_record->transaction_data = json_encode($payment->getData());
            $payment_record->amount = $amount;
            $payment_record->save();

            if ( $isdone ) {
                
                if ( 'recurring_invoices' === $module ) {
                    $invoice_id = $payment_record->invoice_id;
                    $invoice = \Modules\RecurringInvoices\Entities\RecurringInvoice::find( $invoice_id );
                    $invoice->paymentstatus = 'paid';
                    $invoice->save();
                } elseif ( 'invoice' === $module ) {
                    $invoice_id = $payment_record->invoice_id;
                    $invoice = \App\Invoice::find( $invoice_id );
                    $invoice->paymentstatus = 'paid';
                    $invoice->save();
                }
                
                
                $add_to_income = getSetting('add-to-income', 'invoice-settings', 'no');
                if ( 'invoice' === $module ) {
                            $add_to_income = getSetting('add-to-income-invoice', 'invoice-settings', 'no');
                        }
                if ( 'yes' === $add_to_income ) {
                    // Let us add this amount to the default account.
                    if ( ! empty( $payment_record->account_id ) && $invoice ) {
                        $basecurrency = \App\Currency::where('is_default', 'yes')->first();                
                        if ( $basecurrency ) {
                            $amount = ( $amount / $invoice->currency->rate ) * $basecurrency->rate;
                        }
                        \App\Account::find($payment_record->account_id)->increment('initial_balance',$amount);
                    }
                    
                    $this->addToIncome( $invoice, $payment_record, $module, $amount );
                }

                $this->notifyCustomer( $module, $invoice_id, $invoice );                

                flashMessage('success', 'create', trans('orders::global.orders.payments.success'));
                if ( 'recurring_invoices' === $module ) {
                    return redirect()->route('admin.recurring_invoices.show', $payment_record->invoice_id);
                } elseif ( 'invoice' === $module ) {
                    return redirect()->route('admin.invoices.show', $payment_record->invoice_id);
                }
            } else {
                flashMessage('danger', 'create', trans('orders::global.orders.payments.failed'));
                if ( 'recurring_invoices' === $module ) {
                    return redirect()->route('admin.recurring_invoices.show', $payment_record->invoice_id);
                } else {
                    return redirect()->route('admin.invoices.show', $payment_record->invoice_id);
                }
            }
        } else {
            if ( 'recurring_invoices' === $module ) {
                return redirect()->route('admin.recurring_invoices.show', $payment_record->invoice_id);
            } else {
                return redirect()->route('admin.invoices.show', $payment_record->invoice_id);
            }
        }
    }

    /**
     * This method Process the payment record by validating through 
     * the payment status and the age of the record and returns boolen value
     * @param  Payment $payment_record [description]
     * @return [type]                  [description]
     */
    protected  function processPaymentRecord($slug, $module, $payment_record)
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

    /**
     * This method validates the payment record before update the payment status
     * @param  [type]  $payment_record [description]
     * @return boolean                 [description]
     */
    public static function isValidPaymentRecord($payment_record)
    {
        $valid = FALSE;
        
        if($payment_record)
        {
            if( empty( $payment_record->payment_status ) || $payment_record->payment_status == PAYMENT_STATUS_PENDING || $payment_record->paymentmethod=='offline')
                $valid = TRUE;
        }
        return $valid;
    }

    /**
     * This method checks the age of the payment record
     * If the age is > than MAX TIME SPECIFIED (30 MINS), it will update the record to aborted state
     * @param  payment $payment_record [description]
     * @return boolean                 [description]
     */
    public static function isExpired($payment_record)
    {

        $is_expired = FALSE;
        $to_time = strtotime(Carbon\Carbon::now());
        $from_time = strtotime($payment_record->updated_at);
        $difference_time = round(abs($to_time - $from_time) / 60,2);

        $payment_record_max_time_minutes = getSetting('payment-record-max-time-minutes', 'order-settings');
        if( empty( $payment_record_max_time_minutes ) ) {
            $payment_record_max_time_minutes = PAYMENT_RECORD_MAXTIME;
        }

        if($difference_time > $payment_record_max_time_minutes)
        {
            $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
            $payment_record->save();
            return $is_expired =  TRUE;
        }
        return $is_expired;
    }
    
    public function paymentFailed( $slug, $module ) {
        
        if ( 'invoice' === $module ) {
            $payment_record = \Modules\InvoicePayments\Entities\InvoicePayment::where('slug', '=', $slug)->first();
            
            if ( ! $payment_record ) {
                flashMessage('danger', 'not_found', trans('custom.messages.not_found_payment') );
                return redirect()->route('admin.invoices.index');
            }
            
            $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
            $payment_record->save();
            
            flashMessage('danger', 'create', trans('orders::global.orders.payments.failed'));
            return redirect()->route('admin.invoices.show', $payment_record->invoice_id);
            
        } elseif ( 'recurring_invoices' === $module ) {
            $payment_record = \Modules\InvoicePayments\Entities\InvoicePayment::where('slug', '=', $slug)->first();
            
            if ( ! $payment_record ) {
                flashMessage('danger', 'not_found', trans('custom.messages.not_found_payment') );
                return redirect()->route('admin.invoices.index');
            }
            
            $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
            $payment_record->save();
            
            flashMessage('danger', 'create', trans('orders::global.orders.payments.failed'));
            return redirect()->route('admin.recurring_invoices.show', $payment_record->invoice_id);
            
        }
    }
    
    /**
     * $record - Invoice/Recurring Invoice
     * $payment_record - Payment Record
     * $module - Module name
     * $amount - Converted amount
     */
    public function addToIncome( $record, $payment_record, $module, $amount = '' ) {
                
        $pay_method = getSetting('default_payment_gateway', 'site_settings', 0);
        
        $paymentmethod = null;
        if ( ! empty( $pay_method ) ) {             
            $paymentmethod = $pay_method;
        }
        
        if ( 'recurring_invoices' === $module ) {
            $account_id = getSetting('default-account', 'invoice-settings', 0);
            $income_category_id = getSetting('default-category-recurring', 'invoice-settings', '');
        } else {
            $account_id = getSetting('default-account', 'invoice-settings', 0);
            $income_category_id = getSetting('default-category', 'invoice-settings', '');
        }
        
        if ( empty( $amount ) ) {
            $amount = $payment_record->amount;
        }
        // As this is the Invoice/Recurring invoice payment, so it was Income, lets add it in income.

        $pay_method = $payment_record->paymentmethod;
        $pay_method_id = null;
        if ( $pay_method ) {
            $pay_method_id = \App\PaymentGateway::where('key', '=', $pay_method )->first()->id;
        }
        
        $original_currency_id = getDefaultCurrency('id');
        if ( $record->currency_id ) {
            $original_currency_id = $record->currency_id;
        }
        
        $income = array(
            'slug' => md5(microtime() . rand()),
            'entry_date' => date('Y-m-d', time()),
            'amount' => $amount,
            'original_amount' => $payment_record->amount,
            'original_currency_id' => $original_currency_id,
            'description' => trans('others.orders.payment-for') . $record->id,
            'ref_no' => $record->id,
            'account_id' => $account_id,
            'payer_id' => $record->customer_id,
            'pay_method_id' => $pay_method_id,
            'income_category_id' => $income_category_id,
        );          
        \App\Income::create( $income ); 
    }
}