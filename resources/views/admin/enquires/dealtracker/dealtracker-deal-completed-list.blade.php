    <style>
      .table-collapse{
        border-collapse: collapse; border-spacing: 0; width: 100%;
      }
      .cursor-pointer-hand{
        cursor: pointer;padding-left: 20px;
      }
      .bbc{
        cursor: pointer;
         border:0px;
         background: #3ac9d6 !important;
      }
       .maintainht { 
            width: 430px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dtr-title{
          text-decoration: underline !important;
        }
    table.dataTable>tbody>tr.child ul li {
    border-bottom: 1px solid #efefef;
    padding: 0.5em 0;
    overflow: auto;
    text-align: left!important;
   }
   .greeen {
    color: green;
    padding-right: 5px!important;
    }
    .gradeX button {
    border: none!important;
    background: no-repeat;
    color: #000!important;
}
.actions-seeker a, .table-collapse a {
    color: #ADADAD;
    padding: 0px!important;
}
li.maintainht.text-center {
    text-align: left!important;
}
    </style>
      <div class="">
        <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse table-scroller" id="">
          <thead>
            <tr class="empty-background">
              @if( isAdmin() || isAgent() )
              <th>@lang('custom.inquiries.sno')</th>
              @endif
              <th>@lang('custom.dealtracker.status')</th>
              @if( isAdmin() || isAgent() )
              <th>@lang('custom.dealtracker.assigned-to')</th>
              @endif
              <th>@lang('custom.dealtracker.seeker-details')</th>
              <th>@lang('custom.dealtracker.provider-details')</th>
              <th>@lang('custom.dealtracker.booking-details')</th>
             @if( isAdmin() )
              <th>
                @lang('custom.dealtracker.st-revenue-generated-payment-mode') 
              </th>
              <th>
              	@lang('custom.dealtracker.payment-status-total-amount')
              </th>
              
              <th>@lang('custom.dealtracker.proforma-and-tax')</th>
              
              <th>@lang('global.app_actions')</th>
            @endif
             
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
              @php
                $booking_initiated = json_decode( $item->booking_initiated , true );

                 $booking_property_details = \App\Property::find($booking_initiated["booking_initiated_property_id"] ?? '');

                $property_owner   = \App\User::find($booking_property_details["customer_id"] ?? '');

                 $assigned_to_users = \App\User::find($item->assigned_to);

                $booking_user_details = \App\User::find( $booking_initiated["customer_id"] ?? ''); 
              @endphp
            <tr class="gradeX" id="gradex_{{$item->id}}">
             @if( isAdmin() || isAgent() ) 
              <td>
                <ul>                  
                 
                  <li><label>{{ $item->id }}</label></li>
               </td>
              @endif   
               <td>
                  <li>

                    <li><label>{{ $booking_initiated["action"] ?? ''}}</label></li>
                    <p>
                      <span class="updated-date">
                        @lang('custom.dealtracker.updated-on'): {{ $item->updated_at->format('M d , Y') }}
                      </span>
                    </p>
                  </li>
              </td>
               @if( isAdmin() || isAgent() )
               <td>
                 @if( $item->assigned_to == 0 )
                    <?php
                    $not_assigned = "Not Assigned";
                    ?>
                    {{$not_assigned}}
                  @else
                    {{ $assigned_to_users ? $assigned_to_users->name : $not_assigned }}
                  @endif

                @if( isAdmin() )   
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing edit-row sendBill" data-action="assigned-details-ign" data-enquiry_id="{{$item->id}}">
                  <i class="fas fa-pencil-alt"></i>
                </a>
               @endif 

              </td>
             @endif 
              <td>
                <ul>
                  <li>

                    <p class="text-dark text-left">{{ $booking_user_details ? $booking_user_details->name : '-' }}</p>
                  </li>

                  <li><a href="javascript:void(0);">{{ $booking_user_details ? $booking_user_details->email : '-' }}</a></li>
                  <li>
                    <label>
                      {{ $booking_user_details ? $booking_user_details->company : 'x' }}
                      
                    </label>
                  </li>
                  <li>
                    <p class="font-13 text-muted m-b-0">
                      <span>
                        <i class="fas fa-mobile-alt"></i> {{ $booking_user_details ? $booking_user_details->mobile : '-' }}
                      </span>
                      <span class="actions-seeker">
                        <i class="fab fa-whatsapp greeen"></i>
                      </span>
                    </p>
                  </li>
                  <li>
                    <span class="Added on">
                      @lang('custom.dealtracker.created-on'): {{ $item->created_at->format('M d , Y') }}
                    </span>
                  </li>

                </ul>
              </td>
              <!-- provider details -->

              <td>
                <ul>
                  <li>
                    <p class="text-dark text-left">{{ $booking_property_details ? $booking_property_details->property_manager_name : '-' }}</p>
                  </li>
                  <li><a href="javascript:void(0);">{{ $booking_property_details ? $booking_property_details->property_manager_email : '-' }}</a></li>

                  <li>
                    <p class="font-13 text-muted m-b-0">
                      <span>
                        <i class="fas fa-mobile-alt"></i> {{ $booking_property_details ? $booking_property_details->property_manager_number : '-' }}
                      </span>
                      <span class="actions-seeker">
                        <i class="fab fa-whatsapp greeen"></i>
                      </span>
                    </p>
                  </li>


                </ul>
              </td>

              <!-- end provider details -->
             <!-- booking details --> 
              <td>

                <li class="maintainht text-center" title="{{ $booking_property_details ? $booking_property_details->property_address : '-'}}">
                  <b class="text-dark"> @lang('custom.dealtracker.booking-for'):</b>
                  <span>{{ $booking_property_details ? $booking_property_details->property_address : '-'}}</span>
                </li>

                
                <li>
                  <label>
                    <span class="greeen">@lang('custom.dealtracker.seats'): </span>
                  </label>
                  {{$booking_initiated["no_of_seats"] ?? ''}}
                </li>
                <li>
                  <label>
                    <span class="greeen">@lang('custom.inquiries.booking-amount'): </span>
                  </label>
                  {{$booking_initiated["booking_amount"] ?? ''}}
                </li>
                <li>
                  <span class="actions-seeker">
                    <a href="#" class="on-editing edit-row"></a>
                  </span>  
                </li>
              

                <li>
                  <b class="text-dark">@lang('custom.dealtracker.booking-months'):</b>
                  <span>{{$booking_initiated["booking_months"] ?? ''}}</span>
                </li>
              </td>
              <!-- End booking details -->

             @if( isAdmin() ) 
              <td>
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="sendBill" data-action="bookingstart-date-dat" data-enquiry_id="{{$item->id}}">
                  <button id="start-date-add" class="bbc">
                     @lang('custom.dealtracker.add')
                    <i class="mdi mdi-plus-circle-outline"></i>
                  </button>
                </a>
                <br/>
                <li>
                  <div class="show-line address-part">
                   <b class="text-dark"> @lang('custom.dealtracker.start-date') :</b>
                    {{$item->booking_start_date ? $item->booking_start_date.'(Y-M-D)' : '-'}}</div>
                </li>
                <li>
                  <div class="show-line address-part"><b class="text-dark">@lang('custom.eforms.revenue-generated') :</b> {{$item->revenue_generated ?? '-'}}</div>
                </li>
             
                <li>
                  <div class="show-line address-part"><b class="text-dark">@lang('custom.eforms.payment-mode') :</b> {{$item->payment_mode ?? '-'}}</div>
                </li>
              </td>

              <?php
                if( $item->payment_status == "unpaid"){
                  $payment_status_color = "red";
                }else{
                  $payment_status_color = "greeen";
                } 
              ?>
             <!-- Payment Status --> 
              <td>
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="sendBill" data-action="paymentstatus-totalamount-psa" data-enquiry_id="{{$item->id}}">
                  <button id="start-date-add" class="bbc">
                     @lang('custom.dealtracker.add')
                    <i class="mdi mdi-plus-circle-outline"></i>
                  </button>
                </a>
                
                <li>
                   <label>
                    <b class="text-dark">@lang('custom.dealtracker.payment-status') :</b>
                  <?php
                    $ap = $item->amount_paid;
                    $revenue = $item->revenue_generated;
                  ?>
                   @if( $ap > 0 )
                       <?php
                          $difference = $item->revenue_generated - $item->amount_paid;
                       ?>
                       @if($difference == 0 || $difference < 0)
                          <?php
                            $payment_status = $item->payment_status = 'paid';
                            $payment_status_color = 'greeen';
                          ?>

                           <span class="{{$payment_status_color}}"> 
                            {{ucfirst($payment_status)}}
                          </span>
                          <br/>
                          <b class="text-dark">@lang('custom.eforms.unpaid-amount') :</b> {{ $item->revenue_generated - $item->amount_paid}}
                           @else

                            <?php
                            $payment_status = $item->payment_status = 'unpaid';
                            $payment_status_color = 'red';
                           ?>

                             <span class="{{$payment_status_color}}"> 
                            {{ucfirst($payment_status)}}
                          </span>
                          <br/>
                          <b class="text-dark">@lang('custom.eforms.unpaid-amount') :</b> {{ $item->revenue_generated - $item->amount_paid}} 

                      @endif
                   @else

                    <span class="{{$payment_status_color}}"> 
                      {{ucfirst($item->payment_status)}}
                    </span>
                    <br/>
                    <b class="text-dark">@lang('custom.eforms.unpaid-amount') :</b> {{ $item->revenue_generated - $item->amount_paid}}
                   @endif  
                  </label>
                </li>
               

               <li>
                   <label>
                    <b class="text-dark">@lang('custom.eforms.revenue-generated') / @lang('custom.dealtracker.amount-paid') :</b>
                     <span class="red"> {{$item->revenue_generated ?? '0' }}
                     </span> / 
                     <span class="greeen"> 
                     {{$item->amount_paid ?? '0'}} 
                   </span>
                    
                  </label>
                </li>
               
              </td>
              <!-- End Payment Status -->

              
              <td>
                  <b class="text-dark"><br/>@lang('custom.dealtracker.proforma-sent') :</b> {{ ucfirst($item->raise_proforma_sent)  }}<br/>
                  <b class="text-dark">@lang('custom.dealtracker.tax-invoice-sent') :</b> {{ ucfirst($item->tax_invoice_sent)  }}
              </td>
              
                 <td class="actions">

                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </button>
                  <ul class="dropdown-menu">

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="raise-proforma-invoice-per" data-enquiry_id="{{$item->id}}">@lang('custom.dealtracker.raise-proforma-invoice')</a>
                    </li>

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="raise-tax-invoice-tax" data-enquiry_id="{{$item->id}}">@lang('custom.dealtracker.raise-tax-invoice')</a>
                    </li>

                    <li>
                       {!!Form::open([
                        'method'=>'post',
                        'route' =>['dealtracker.dealspaid','id' => $item->id]

                        ])!!}

                       <button type="submit" class="dropdown-item cursor-pointer-hand">
                          @lang('custom.dealtracker.paid')
                       </button>

                        {!! Form::close() !!}
                    </li>

                        <li>
                       {!!Form::open([
                        'method'=>'post',
                        'route' =>['dealtracker.dealsunpaid','id' => $item->id]

                        ])!!}

                       <button type="submit" class="dropdown-item cursor-pointer-hand">
                          @lang('custom.dealtracker.unpaid')
                       </button>

                        {!! Form::close() !!}
                    </li>
                  </ul>
                </div>
                <!-- end test -->
              </td>
             @endif 
            </tr>
            @endforeach

          </tbody>

        </table>

      </div>
