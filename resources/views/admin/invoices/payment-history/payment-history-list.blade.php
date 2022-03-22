    <style>
        .phmt{
            margin-top:-30px;
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
            $invoices = \App\Invoice::find( $item->invoice_id );
            $customers = \App\User::find( $invoices->customer_id );
            $inquiries = \App\Enquire::find( $invoices->property_id );
            $booking_initiated = json_decode($inquiries->booking_initiated, true);
            
            $properties = \App\Property::find( $booking_initiated["booking_initiated_property_id"] );

            $image = $properties ? $properties->cover_image : url( PUBLIC_ASSETS . 'images/default-imgs/1.jpg' );
          @endphp
                <div class="col-lg-12 sty-bsp">
                    <div class="row">
                  
                         <div class="col-sm-3">
                            <label> <b>@lang('custom.paymenthistory.customer-name'):</b> {{  $customers ? $customers->name : '' }}</label> 
                         </div>
                          <div class="col-sm-3">
                              <label> <b>@lang('custom.paymenthistory.customer-number'):</b>  {{ $customers ? $customers->mobile : ''}}</label>
                          </div>
                            <div class="col-sm-3">
                                <label> <b>@lang('custom.paymenthistory.no-of-seats'):</b> {{ $invoices ? $invoices->no_of_seats : '' }}</label>
                            </div>
                           <div class="col-sm-3">
                                <label> <b>@lang('custom.paymenthistory.booking-months'):</b> {{ $booking_initiated['booking_months'] ?? '' }}</label>
                            </div>
                              
                          </div>
                    </div>
                   
                    
                     <div class="col-lg-12 sty-bsp">

                        <div class="property-card property-horizontal bg-white sty-bsp">
                            <div class="row">

                                <div class="col-sm-3 sty-tc">
                                    <div class="property-image" style="background: url('{{$image}}') center center / cover no-repeat; height:100%;">
                                         
                                    </div>
                                    <!-- <label> Virtual Office</label> --> 
                                </div>
                                <!-- /col 4 -->
                                <div class="col-sm-5 phmt">
                                    <div class="property">
                                        <div class="listingInfo">
                                            <ul>
                                             <li>  
                                               
                                             <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                   @lang('custom.eforms.invoiceid') :  <span> {{$invoices->invoice_id}} </span>
                                              </li>
                                              

                                              <li>  <i class="fa fa-angle-right" aria-hidden="true"></i>

                                                @lang('custom.eforms.transactionid') :  <span> {{ $item->transaction_id ?? '' }}</span>
                                                </li>

                                                <li>  <i class="fa fa-angle-right" aria-hidden="true"></i>

                                                @if($properties->property_address)
                                                  @lang('custom.leads.address'): <b> {{ $booking_initiated['description'] ?? '' }} in {{ $properties ? $properties->property_address : ''}}</b> 
                                                @endif  </li>

                                                <li>  
                                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                        @lang('custom.eforms.company') :   <b>{{ $properties ?  $properties->company : '-'}}</b>
                                                 </li>

                                                  <li>  
                                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                        @lang('custom.eforms.currency') :  <b>{{ $item->customer ? $item->customer->currency->name : ''}}</b>
                                                 </li>
                                   
                                                 <li>  

                                           @if($inquiries->booking_start_date)
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>    
                                            @lang('custom.eforms.startdate') :  <span> {{ $inquiries->booking_start_date ?? '' }}</span>
                                            @endif
                                            </li>

                                            <li>  <i class="fa fa-angle-right" aria-hidden="true"></i>

                                            @lang('custom.eforms.payment-method') :  <span> {{$item->paymentmethod}}</span>
                                            </li>

                                            <li>  <i class="fa fa-angle-right" aria-hidden="true"></i>

                                            @lang('custom.eforms.payment-status') : <span> {{$item->paymentstatus}}</span>
                                            </li>

                                            </ul>
                                                
                                            </div>
                                        </div>
                                    </div>
                                 
                                <!-- /col 8 -->
                               
                                <!-- /col 4 -->
                                <div class="col-sm-4">
                                    <div class="property-content">
                                   

                                  <?php
                                    $amount = $item->amount;
                                  ?>

                                        <a href="javascript:void(0);" class="btn btn-medium-dark group-width mmt-10">
                                            {{ digiCurrency($amount , $item->currency_id) }}
                                        </a>
                                         <a href="{{ route('invoices.invoicepdf', $item->id) }}" class="btn invo-btn group-width mmt-10">
                                            <i class="fa fa-download" aria-hidden="true"></i> @lang('custom.paymenthistory.download-invoice')
                                        </a>
                                        
                                    </div>
                                </div>

                                <!-- /col 8 -->
                            </div>

                            </div>
                            <!-- /inner row -->
                        </div>
                        <!-- End property item -->


                    @endforeach
                       
                       
                    </div>
               
                <!-- end row -->