      <style>
        .table-collapse{
          border-collapse: collapse; border-spacing: 0; width: 100%;
        }
      </style>
      <div class="">
        <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse" id="datatable">
          <thead>
            <tr class="empty-background">
              <th>@lang('custom.invoicepdf.company-name')</th>
              <th>@lang('custom.clients.occupant-details')</th>
              <th>@lang('custom.dealtracker.provider-details')</th>
              <th>@lang('custom.invoicepdf.no-of-seats')</th>
              <th>@lang('custom.clients.duration-months-booking-amount')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
              @php
                $booking_initiated = json_decode( $item->booking_initiated , true );

                 $booking_property_details = \App\Property::find($booking_initiated["booking_initiated_property_id"] ?? '');

                $property_owner   = \App\User::find($booking_property_details["customer_id"] ?? '');

                $booking_user_details = \App\User::find( $booking_initiated["customer_id"] ?? ''); 
              @endphp
            <tr class="gradeX" id="gradex">
              <td>
                {{ $item->company ?? '' }}
              </td>

              <!-- occupant details -->
          <td>
                <ul>
                  <li>

                    <p class="text-dark text-left">{{ $booking_user_details ? $booking_user_details->name : '-' }}</p>
                  </li>

                  <li><a href="javascript:void(0);">{{ $booking_user_details ? $booking_user_details->email : '-' }}</a></li>
                  <li>
                    <label>
                      {{ $booking_user_details ? $booking_user_details->company : trans('custom.cross_mark') }}
                      
                    </label>
                  </li>
                  <li>
                    <p class="font-13 text-muted m-b-0">
                      <span>
                        <i class="fa fa-mobile-alt"></i> {{ $booking_user_details ? $booking_user_details->mobile : '-' }}
                      </span>
                      <span class="actions-seeker">
                        <i class="fab fa-whatsapp greeen"></i>
                      </span>
                    </p>
                  </li>
                  <li>
                    <span class="Added on">
                      @lang('custom.clients.created-on') {{ $item->created_at->format('M d , Y') }}
                    </span>
                  </li>

                </ul>
              </td>
              <!-- end occupant details -->
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
                        <i class="fa fa-mobile-alt"></i> {{ $booking_property_details ? $booking_property_details->property_manager_number : '-' }}
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
                  {{$booking_initiated["no_of_seats"] ?? ''}}
              </td>
              <!-- end details -->
              <td>
                  @lang('custom.clients.start-date') {{$item->booking_start_date ?? ''}}<br/>
                   @lang('custom.clients.booking-months')
                  {{$booking_initiated["booking_months"] ?? ''}}<br/>
                  @lang('custom.clients.booking-amt') {{$booking_initiated["booking_amount"] ?? ''}}
              </td>

         
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>