@extends('layouts.new_admin_layout')
@section( 'new_admin_head_links' )
@include( 'partials.newadmin.common.datatables.datatables-head-links' )
@endsection

@section( 'new_content' )

	<div class="row checlout">
		 {!! Form::model($item, ['method' => 'POST', 'route' => ['invoice.paynow', $item->id, 'invoice'], 'id' => 'paymentform']) !!}

         	@if(isCustomer())
                  <?php

                    $customers = \App\User::find( $item->customer_id );
                    $inquiries = \App\Enquire::find( $item->property_id );
                  ?>

				<div class="col-lg-12">

                <div class="card">
                <div class="card-body">

         <p><i class="fa fa-check" aria-hidden="true"></i>
   @lang('custom.eforms.invoice-number')  <span>  {{ $item->invoice_id ?? ''}}</span></p>

			   	  <p><i class="fa fa-check" aria-hidden="true"></i>
	@lang('custom.paymenthistory.customer-name')
                     <span>  {{ $customers ? $customers->name : '' }}  </span>

                        </p>

                        <p><i class="fa fa-check" aria-hidden="true"></i>
	@lang('custom.paymenthistory.customer-number')
                        <span>  {{ $customers ? $customers->mobile : '' }} </span> </p>

                        <p>	<i class="fa fa-check" aria-hidden="true"></i>

			   	 	@lang('custom.paymenthistory.no-of-seats')
                        <span>   {{ $item->no_of_seats }}
                        </span> </p>
                        <p>	<i class="fa fa-check" aria-hidden="true"></i>

			   	 	 @lang('custom.eforms.company')  <span>
			   	 	{{ $inquiries ?  $inquiries->company : '-'}}  </span></p>


			   	 	<h4> {{ digiCurrency($item->total_amount , $item->currency_id) }} (@lang('custom.paymenthistory.tax-incl').)</h4>

						<h2 class="headingTop text-center">
					 Select Your Payment Method
						</h2>

			@php
				$payment_gateways = \App\Settings::where('moduletype', '=', 'payment')->where('status', '=', 'Active')->get()->pluck('module', 'key');
				$default = getSetting('default_payment_gateway', 'site_settings', 'offline');
			@endphp
            @foreach( $payment_gateways as $key => $title )
            <div class="middle">
            <div class="btn-group" >
               {{ Form::radio('payment_gateway', $key, ( $key == $default ), ['id' => $key] ) }} <label for="{{$key}}" class="paymentMethod" name="options">{{$title}}</label>
               <p class="help-block"></p>
               @if($errors->has('payment_gateway'))
               <p class="help-block">
                  {{ $errors->first('payment_gateway') }}
               </p>
               @endif
            </div> </div>

            @endforeach
            <input type="hidden" id="stripeToken" name="stripeToken" value="" />
            <input type="hidden" id="stripeEmail" name="stripeEmail" value="" />

            {!! Form::submit(trans('custom.paymenthistory.pay-now'), ['class' => 'btn btn-info', 'name' => 'btnsavemanage', 'id' => 'payment-button', 'value' => 'savemanage']) !!}



            </div>
            </div>
			    </div>
         @endif


		{!! Form::close() !!}
	</div>
@stop

@section( 'new_admin_js_scripts' )

@php
$currency_code = getDefaultCurrency( 'code' );
if ( in_array( strtolower( $currency_code ), stripeCurrencies() ) ) {
@endphp

<script type="text/javascript" src="//checkout.stripe.com/checkout.js"></script>
<?php
   $jQuery_selector = "#stripe-button, #simontaxi-purchase-button";
   $stripe_options = array(
       'stripe_checkout_popup_title' => getSetting( 'stripe_checkout_popup_title', 'stripe', 'Stripe' ),
       'name' => getSetting( 'site_title', 'site-settings', 'Stripe' ),
       'stripe_checkout_popup_description' => getSetting( 'stripe_checkout_popup_description', 'stripe', 'Stripe' ),
   );
   $remember_me_box = $use_billing_address = $use_shipping_address = 0;

   $remember_me_box = ( getSetting( 'hide_stripe_remember_me_box', 'stripe', 'yes' ) == 'yes' ) ? 1 : 0;
   $use_billing_address = ( getSetting( 'require_billing_address', 'stripe', 'yes' ) == 'yes' ) ? 1 : 0;

   $email = getContactInfo('', 'email');
   $amount_payable = $item->total_amount;

   $stripe_popup_image = asset( PREFIX1 . 'uploads/settings/' . getSetting( 'stripe_checkout_popup_image', 'stripe' ) );

   
      

   ?>
<script>
   var pop_checkout = true;
   var handler = StripeCheckout.configure(
   {
       key: '<?php echo getSetting( 'stripe_key', 'stripe' ); ?>',
       token: function(token, args)
       {

           jQuery( '#stripeToken' ).val( token.id );
           jQuery( '#stripeEmail' ).val( token.email );
           document.getElementById( 'paymentform' ).submit();
       }
   });


   jQuery( '#payment-button' ).unbind( 'click' );
   jQuery( '#payment-button' ).on( 'click', function(e)
   {

       e.preventDefault();

       var gateway = $('input[name="payment_gateway"]:checked').val();


       if ( 'stripe' == gateway ) {


           pop_checkout = true;

           if(pop_checkout)
           {
               // Open Checkout with further options
               handler.open({
                 
                 image: '<?php echo $stripe_popup_image; ?>',
                 name: '<?php echo ( isset( $stripe_options['stripe_checkout_popup_title']) AND $stripe_options['stripe_checkout_popup_title'] != '' ) ? str_replace("'","\'", stripslashes( $stripe_options['stripe_checkout_popup_title'])) : str_replace("'","\'", stripslashes($stripe_options['name'])); ?>',
                 description: '<?php if( isset( $stripe_options['stripe_checkout_popup_description'] ) ) echo str_replace("'","\'", stripslashes( $stripe_options['stripe_checkout_popup_description'])); ?>',
                 currency: '<?php echo $currency_code; ?>',
                 allowRememberMe: '<?php echo $remember_me_box; ?>',
                 billingAddress: '<?php echo $use_billing_address; ?>',
                 shippingAddress: '<?php echo $use_shipping_address; ?>',
                 email: '<?php echo $email; ?>',
                 amount:'<?php echo $amount_payable * 100; ?>'
               });
           }
       } else {
           document.getElementById( 'paymentform' ).submit();
       }

   });

 <?php
}
?>
</script>

 @endsection