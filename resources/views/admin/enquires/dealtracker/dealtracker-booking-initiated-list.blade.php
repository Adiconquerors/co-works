    <style>
      .table-collapse{
        border-collapse: collapse; border-spacing: 0; width: 100%;
      }
      .cursor-pointer-hand{
        cursor: pointer;padding-left: 20px;
      }
      .table.dataTable{
        width:100% !important;
      }
      .actions-seeker a, .table-collapse a {
       color: #ADADAD;
       padding: 0px!important;
      }
      .actions-seeker{
        padding-right: 6px;
      }
    </style>
      <div class="">
        <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse" id="">
          <thead>
            <tr class="empty-background">
              <th>@lang('custom.inquiries.sno')</th>
              <th>@lang('custom.dealtracker.status')</th>
              <th>@lang('custom.dealtracker.seeker-details')</th>
              <th>@lang('custom.dealtracker.provider-details')</th>
              <th>@lang('custom.dealtracker.booking-details')</th>
              <th>@lang('custom.inquiries.visit-details')</th>
              <th>@lang('custom.inquiries.comments')</th>
              <th>@lang('global.app_actions')</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
              @php
                $booking_initiated = json_decode( $item->booking_initiated , true );
                $booking_property_details = \App\Property::find($booking_initiated["booking_initiated_property_id"] ?? '');
                $booking_user_details = \App\User::find( $booking_initiated["customer_id"] ?? '' ); 
              @endphp
            <tr class="gradeX" id="gradex_{{$item->id}}">

               <td>
                <ul>                  
                 
                  <li><label>{{ $item->id }}</label></li>
              </td>

              <td>
                <ul>                  
                 
                  <li><label>{{ $booking_initiated["action"] ?? '' }}</label></li>

                  <li>
                    <p>
                      <span class="updated-date">
                        @lang('custom.dealtracker.updated-on') {{ $item->updated_at->format('M d , Y') }}
                      </span>
                    </p>
                  </li>
                 
              </td>
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
                      @lang('custom.dealtracker.created-on') {{ $item->created_at->format('M d , Y') }}
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
              <td>
                <li class="text-left">
                  <p class="text-dark ">@lang('custom.dealtracker.booking-for')</p>
                  <div class="address-part">{{ $booking_property_details ? $booking_property_details->property_address : '-'}}</div>
                </li>
                <li>
                  <label>
                    <span class="greeen">@lang('custom.dealtracker.seats') </span>
                  </label>
                  {{$booking_initiated["no_of_seats"] ?? '' }}
                </li>
                 <li>
                  <label>
                    <span class="greeen">@lang('custom.dealtracker.booking-amount') </span>
                  </label>
                  {{$booking_initiated["booking_amount"] ?? '' }}
                </li>
                <li>
                  <span class="actions-seeker">
                    <a href="#" class="on-editing edit-row"></a>
                  </span>
                  <p class="text-dark">@lang('custom.dealtracker.booking-date')</p>
                  <div class="address-part">{{$booking_initiated["booking_date"] ?? ''}}</div>
                </li>
                <li>
                  <span class="actions-seeker">
                    <a href="javascript:void(0);" class="on-editing edit-row"></a>
                  </span>
                  <p class="text-dark">@lang('custom.dealtracker.booking-months')</p>
                  <div class="address-part">{{$booking_initiated["booking_months"] ?? ''}}</div>
                </li>

              </td>
              <td>
                {{$item->visit_details ?? ''}}
              </td>
             <td>
              {{ $item->comments ?? '-' }}
             </td>

                <!--end assigned to -->
              <td class="actions">

                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </button>
                  <ul class="dropdown-menu">

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="deal-lost-del" data-enquiry_id="{{$item->id}}">@lang('custom.inquiries.deal-lost')</a>
                    </li>

                    <li>
                       {!!Form::open([
                        'method'=>'post',
                        'route' =>['enquiries.dealcompleted','id' => $item->id]

                        ])!!}

                       <button type="submit" class="dropdown-item cursor-pointer-hand">
                        @lang('custom.dealtracker.deal-completed')
                       </button>

                        {!! Form::close() !!}
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