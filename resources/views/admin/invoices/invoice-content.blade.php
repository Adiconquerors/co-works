<div class="ibox-content">
<div class="invoice" id="invoice_pdf">  
@include('admin.common.invoice-stylesheet')
    <style>
.footer {
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  color: #333;
    background-color: white;
  text-align: center;
}
.inv-tar{
    text-align: right;
}
.main-header .navbar .nav > li > a > .label{
    padding: 2px 3px 11px 2px !important;
}

    </style>

        <header><br/>
            <h1>@lang('custom.invoicepdf.invoice')</h1>

            <?php
                    $invoices  = \App\Invoice::find( $item->invoice_id );
                    $customers = \App\User::find( $invoices->customer_id );
                    $inquiries = \App\Enquire::find( $invoices->property_id );
                    $booking_initiated = json_decode($inquiries->booking_initiated, true);
                    $properties = \App\Property::find( $booking_initiated["booking_initiated_property_id"] );
            ?>

            <address>
                <h4 class="red"><strong>@lang('custom.invoicepdf.invoice-number'): {{ $invoices ? $invoices->invoice_id : '' }}</strong></h4>
              
            </address>
                <?php
                    $logo = getSetting('Invoice-Logo', 'invoice-settings');
                    if ( empty( $logo ) ) {
                    $logo = getSetting('site_logo', 'site_settings');
                    }
                ?>
            <table class="meta">
            <tr>
                <td class="beta2">
                <img alt="" src="{{ asset( PREFIX1 . 'uploads/settings/' . $logo ) }}" height="56" width="180">
              </td>
            </tr> 
                <tr><td class="beta3"></td></tr>
                <tr><td class="beta2"><strong>{{getSetting('Company_Name_On_Invoice', 'invoice-settings', trans('global.global_title'))}}</strong></td></tr>
                <tr><td class="beta2">{{getSetting('Company-Address', 'invoice-settings')}}</td></tr>
            </table>
            <address>
                <p><strong>@lang('custom.invoicepdf.invoice-to')</strong></p>
                 
                <p><strong>@lang('custom.invoicepdf.company-name')</strong>{{ $inquiries ? $inquiries->company : '-' }}</p>

                <p><strong>@lang('custom.invoicepdf.customer-name')</strong>&nbsp;{{ $customers ? $customers->name : '' }}</p>

                <p><strong>@lang('custom.invoicepdf.company-address')</strong>{{ $inquiries ? $inquiries->address : '-' }}</p>
                
                <p><strong>@lang('custom.invoicepdf.phone')</strong>{{ $customers ? $customers->mobile : '' }} </p>

                
                <p><strong>@lang('custom.invoicepdf.email')</strong> {{ $customers ? $customers->email : ''}}</p>
                
                <br/>
            </address>
        </header>
        <article>
            <table class="balance">
             
                <tr>
                    <th><span>@lang('custom.invoicepdf.date-of-issue')</span></th>
                    <td><span>{{ $invoices ? $invoices->created_at : '-' }}</span></td>
                </tr>
                
                <tr>
                    <th><span>@lang('custom.invoicepdf.total-amount')</span></th>
                    <td><span>{{ digiCurrency($item->amount , $item->currency_id) }}</span></td>
                </tr>
                
            </table>
           
            <table class="inventory invoice-items">
                <thead>
                    <tr>
                        <th><span>@lang('custom.invoicepdf.no-of-seats')</span></th>
                        <th><span>@lang('custom.invoicepdf.booking-months')</span></th>
                        <th><span>@lang('custom.invoicepdf.total-amount')</span></th>
 
                    </tr>
                </thead>
               
                <tbody>
                    <tr class="" >
                        <td class="inv-tar"><span>{{ $invoices ? $invoices->no_of_seats : '' }}</span></td>
                        <td><span>{{ $booking_initiated['booking_months'] ?? ''}}</span></td>
                        <td><span>{{ digiCurrency($item->amount , $item->currency_id) }}</span></td>
                    </tr>
                        
                </tbody>
            </table>
           
        </article>
        
            
            <address>

                 <p>@lang('custom.invoicepdf.paymentmethod') :  {{ $item->paymentmethod ?? '' }}</p>

                 <?php
                    $invoice_settings_invoice_notes = getSetting('predefined_clientnote_invoice', 'invoice-settings');
                    $invoice_settings_admin_notes = getSetting('predefined_adminnote_invoice', 'invoice-settings');
                    $invoice_settings_terms_conditions = getSetting('predefined_terms_invoice', 'invoice-settings');
                    $invoice_footer_enable = getSetting('invoice-footer-enable', 'invoice-settings');
                 ?>

             </address>
                  <article>
               @if( $invoice_settings_invoice_notes )     
                <table class="beta4">
                     <tr><td class="beta4"><b>@lang('custom.invoicepdf.client-notes')</b></td></tr>
                     <tr><td><code>{{$invoice_settings_invoice_notes ?? ''}} </code></td></tr>
                 </table>
                @endif 

                 <table class="beta4"> 
                   @if($invoice_settings_admin_notes)
                     <tr><td class="beta4"><b>@lang('custom.invoicepdf.admin-notes')</b></td></tr>
                     <tr><td><code>{{$invoice_settings_admin_notes ?? ''}} </code></td></tr>
                    @endif
                     
                     @if($invoice_settings_terms_conditions)
                     <tr><td class="beta4"><b>@lang('custom.invoicepdf.terms-conditions')</b></td></tr>
                     <tr><td><code>{{$invoice_settings_terms_conditions ?? ''}}</code></td></tr>
                     @endif
                 </table>
           </article>

                
                @if( "Yes" === $invoice_footer_enable )
                    @include('admin.invoices.invoice.invoice-content-footer')
                @endif

    </div>

</div>