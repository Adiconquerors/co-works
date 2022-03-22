<style>
  .table-collapse{
    border-collapse: collapse; border-spacing: 0; width: 100%;
  }
 
</style>  
<div class="" >
   <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse" id="datatable" >
      <thead>
         <tr class="empty-background">
          <th>@lang('custom.bookings.id')</th>
          <th>@lang('custom.bookings.action')</th>
          <th>@lang('custom.bookings.customer-name')</th>
          <th>@lang('custom.bookings.no-of-seats')</th>
          <th>@lang('custom.bookings.booking-months') * @lang('custom.bookings.amount')</th>
          

          <th>@lang('custom.bookings.gstin') + @lang('custom.bookings.amount')</th>
          <th>@lang('custom.bookings.payment-status')</th>
            
            <th>@lang('custom.bookings.actions')</th>
         </tr>
      </thead>
      <tbody>
         @foreach( $items as $item )
          @php
            $customer = \App\User::find( $item->customer_id );
            $property = \App\Property::find( $item->property_id );

            $image = $property->cover_image;
          @endphp
         <tr>
              

             <td>
                {{ $item->id }}
            </td>
        

            <td>
                {{ $item->action  }}
            </td>

             <td>
                {{ $item->customer_name }}
            </td>


             <td>
                {{ $item->no_of_seats }}
            </td>

           
            @if( $item->action == 'booking-initiated' )
             <?php
               if( $item->booking_months == "" || $item->booking_months == 0 ){
                 $item->booking_months = 1;
               }
             ?>
             <td>
              {{$item->booking_months }} * {{  $item->amount }} 
            </td>
              @else
                <?php
               if( $item->booking_months == "" || $item->booking_months == 0 ){
                 $item->booking_months = 1;
               }
             ?>
               <td>
              {{$item->booking_months }} * {{  $item->amount }} 
              </td>
           @endif 


           @if( $item->gstin == null || $item->gstin == 0 )   
            <td>
             {{ $item->amount }} 
            </td>
            @else
            <td>
             {{ $item->gstin }}% + {{ $item->booking_months * $item->amount }} = {{ $item->total_amount }}
            </td>
           @endif

            <td>
                {{ $item->paymentstatus }}

            </td>



        
    <td class="actions">
               
      <div class="btn-group">
         <button type="button" class="btn btn-info dropdown-toggle-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fa fa-bars" aria-hidden="true">&nbsp; &nbsp;</i> 
         </button>
         <ul class="dropdown-menu">


       @if( $item->paymentstatus == 'unpaid' )   
        <li>
          <a href="#loadingModal" data-toggle="modal" data-remote="false"  class="dropdown-item sendBill" data-action="invoice-payment-pay" data-invoice_id="{{$item->id}}">@lang('custom.bookings.pay-rs'). {{ $item->total_amount }}</a>
        </li>
       @endif 

        <li>
          <a href="{{ route('invoices.bookinginvoicepdf',$item->id) }}"  class="dropdown-item" > @lang('custom.bookings.download-invoice')</a>
        </li>
        
         </ul>
       </div>

      <!-- end test -->
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
 
</div>