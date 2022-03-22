@extends('layouts.new_admin_layout')
@section( 'new_admin_head_links' )
@include( 'partials.newadmin.common.datatables.datatables-head-links' )
@endsection

@section( 'new_content' )

  <div class="row">

          @if(isCustomer())


          {!! Form::model($invoice, ['method' => 'POST', 'route' => ['payment.process-payment', $token, 'invoice'], 'id' => 'paymentform', 'style' => 'display:none']) !!}
                <input type="hidden" id="stripeToken" name="stripeToken" value="" />
                <input type="hidden" id="stripeEmail" name="stripeEmail" value="" />
                <input type="hidden" id="paymethod" name="paymethod" value="stripe" />
         {!! Form::close() !!}



         @endif


    {!! Form::close() !!}
  </div>
@stop

@section( 'new_admin_js_scripts' )
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

   $stripe_popup_image = asset( 'uploads/settings/' . getSetting( 'stripe_checkout_popup_image', 'stripe' ) );
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
</script>

 @endsection