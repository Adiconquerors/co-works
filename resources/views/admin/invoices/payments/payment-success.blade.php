@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
@include( 'partials.newadmin.common.datatables.datatables-head-links' ) 
<style>
.pymesucess ul {
    padding: 0;
    margin: 25px 0 0;
}
.pymesucess li {
    list-style: none;
    float: left;
    width: 50%;
    text-align: left;
    padding: 5px;
}
.pymesucess li span {
    color: #333;
    font-weight: bold;
    padding-left: 10px;
}
</style>
@endsection

@section( 'new_content' )
    <h3 class="page-title">@lang('global.orders.payments.title')</h3>
    
    <div class="panel-body packages">
        <div class="row">
         
          <div class="col-xl-10 col-12 offset-xl-1"> 
          <div class="card pymesucess">
          <div class="card-body">
            <i class="fa fa-thumbs-up fa-5x" aria-hidden="true"></i>
            
            <h1> @lang('custom.payments.success') </h1>

            <?php
                $invoices = \App\Invoice::find( $item->invoice_id );        
            ?>

            <ul>
                <li>
                     <i class="fa fa-check" aria-hidden="true"></i>   @lang('global.eforms.transactionid') <span> {{ $item->transaction_id  }}</span>
                </li>
                <li>
                       <i class="fa fa-check" aria-hidden="true"></i> @lang('global.eforms.invoice-number') <span> {{ $invoices ? $invoices->invoice_id : '' }}</span>
                </li>
                   
                  <li>
                      <i class="fa fa-check" aria-hidden="true"></i>  @lang('global.eforms.currency') <span> {{ digiCurrency( $item->amount ) }}</span>
                </li>
                
                <li>
                      <i class="fa fa-check" aria-hidden="true"></i>  @lang('global.eforms.payment-method') <span> {{ $item->paymentmethod ?? '' }}</span>
                </li>

                <li>
                       <i class="fa fa-check" aria-hidden="true"></i> @lang('global.eforms.payment-status')<span> {{ $item->paymentstatus }}</span>
                </li>   

            </ul>

           
</div></div>
          </div>

        

        </div>
   
               
    </div>
@stop