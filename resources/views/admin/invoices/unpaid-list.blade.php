<style>
  .sty-p{
    padding: 0px 150px 0px 150px;
  }
  .sty-bsp{
    border:1px solid #dcdcdc; padding: 10px;
  }
  .sty-tc{
    text-align: center;
  }
</style>
<div class="row">
 @foreach( $items as $item )
    @php

      $inquiries = \App\Enquire::find( $item->property_id );
      $booking_initiated = json_decode($inquiries->booking_initiated, true);
      
      
      $customer = \App\User::find( $booking_initiated['customer_id'] ?? '');

      $property = \App\Property::find( $booking_initiated['booking_initiated_property_id'] ?? '' );

      $property_sub_space_types = $property->property_sub_space_types;

     $image = $property ? $property->cover_image : url( PUBLIC_ASSETS . 'images/default-imgs/1.jpg' );
    @endphp

    <div class="col-lg-12 btongrid" >
        <div class="row">
             <div class="col-sm-3">
                <p>  @lang('custom.paymenthistory.customer-name') <text> {{ $customer ? $customer->name : '' }} </text> </p> 
             </div>
              <div class="col-sm-3">
                  <p>  @lang('custom.paymenthistory.customer-number') <text>  {{ $customer ? $customer->mobile : '' }} </text> </p>
              </div>
                <div class="col-sm-2">
                    <p>  @lang('custom.paymenthistory.no-of-seats') <text> {{ $booking_initiated['no_of_seats'] ?? '' }} </text> </p>
                </div>
                  <div class="col-sm-4">
                    <p>  @lang('custom.paymenthistory.booking-months') <text> {{ $booking_initiated['booking_months'] ?? '' }} </text> </p>
                </div>
                  
              </div>
    </div>
    <br><br>
    
     <div class="col-lg-12 " >
        <div class="property-card property-horizontal bg-white sty-bsp">
            <div class="row">
                <div class="col-sm-3 sty-tc" >
                    <div class="property-image" style="background: url('{{$image}}') center center / cover no-repeat;">
                         
                    </div>
                
                </div>
                <!-- /col 4 -->
                <div class="col-sm-5">
                    <div class="property-content">
                        <div class="listingInfo">
                            <div class="">
                             
                               <h4>
                                    <a href="javascript:void(0);" class="text-dark property-lab">
                                      @if($property->property_address)
                                        {{ $booking_initiated['description'] ?? '' }} in {{ $property ? $property->property_address : ''}} 
                                        @endif
                                    </a>


                                </h4>
                                <h4>
                                    <a href="javascript:void(0);" class="text-dark property-lab">
                                         {{ $property ?  $property->company : '-'}}
                                    </a>


                                </h4>
                                  <h4>
                                    <a href="javascript:void(0);" class="text-dark property-lab">
                                         {{ $property ?  $property->property_manager_name : '-'}}
                                    </a>


                                </h4>
                                <p class="font-13 text-muted">
                                  @if($inquiries->booking_start_date)  
                                   @lang('custom.postrequirement.start_date') {{ $inquiries->booking_start_date ?? '' }}
                                  @endif
                                </p>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- /col 8 -->
               
                <!-- /col 4 -->
                <div class="col-sm-4">
                    <div class="property-content">
                    
                      @if( isAdmin() )

                        <a href="#loadingModal" data-toggle="modal" data-remote="false"  data-action="invoice-payment-pay" data-invoice_id="{{$item->id}}" class="btn btn-medium-dark mmt-10 sendBill">
                            {{ digiCurrency($item->total_amount , $item->currency_id) }} (@lang('custom.paymenthistory.tax-incl').)
                        </a>
                        @elseif( isCustomer() )
                            <a href="{{ route('unpaidinvoice.show',$item->id) }}" class="btn btn-medium-dark mmt-10">
                            {{ digiCurrency($item->total_amount , $item->currency_id) }} (@lang('custom.paymenthistory.tax-incl').)
                        </a>
                        @endif
                       

                        @if( isAdmin() )
                         <a href="javascript:void(0);" class="mmt-10">
                            {!!Form::open([
                            'method'=>'delete',
                            'route' =>['unpaid-invoices.destroy', $item->id],
                            'onclick'=>'return checkDelete();'
                            ])!!}
                            <button type="submit" class="btn btn-medium-dark">
                            @lang('custom.paymenthistory.remove-invoice')
                            </button>
                             {!! Form::close() !!}
                        </a>
                        @endif
                        
                    </div>
                </div>
                <!-- /col 8 -->
            </div>
            <!-- /inner row -->
        </div>
        <!-- End property item -->


       
       
    </div>
    <!--END MAIN COL-8 -->
    @endforeach
</div>
<!-- end row -->

@include('admin.common.delete-script',['unpaid-invoices.destroy'] ) 

        <div>
            <ul class="pagination pagination-split justify-content-end">
               {{ $items->links() }}
            </ul>
        </div>