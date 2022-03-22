    <style>
      .table-collapse{
        border-collapse: collapse; border-spacing: 0; width: 100%;
      }
    </style>
      <div class="">
        <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse" id="datatable">
          <thead>
            <tr class="empty-background">
              <th>@lang('custom.dealtracker.status')</th>
              <th>@lang('custom.dealtracker.seeker-details')</th>
              <th>@lang('custom.dealtracker.provider-details')</th>
              <th>@lang('custom.dealtracker.booking-details')</th>
              <th>@lang('custom.dealtracker.payment-status')</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
              @php
                $booking_property_details = \App\Property::find($item->property_id);
                $property_owner   = \App\User::find($booking_property_details->customer_id);

                $booking_user_details = \App\User::find( $item->customer_id );
              @endphp
            <tr class="gradeX" id="gradex_{{$item->id}}">
              <td>
                <ul>                  
                 
                  <li><label>{{$item->action}}</label></li>

                  <li>
                    <p>
                      <span class="updated-date">
                        @lang('custom.dealtracker.updated-on'): {{ $item->updated_at->format('M d , Y') }}
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
                        <i class="fa fa-mobile"></i> {{ $booking_user_details ? $booking_user_details->mobile : '-' }}
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
                    <p class="text-dark text-left">{{ $property_owner ? $property_owner->name : '-' }}</p>
                  </li>
                  <li><a href="javascript:void(0);">{{ $property_owner ? $property_owner->email : '-' }}</a></li>

                  <li>
                    <p class="font-13 text-muted m-b-0">
                      <span>
                        <i class="fa fa-mobile"></i> {{ $property_owner ? $property_owner->mobile : '-' }}
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
                <li>
                  <p class="text-dark">@lang('custom.dealtracker.booking-for'):</p>
                  <div class="address-part">{{ $booking_property_details ? $booking_property_details->property_address : '-'}}</div>
                </li>
                <li>
                  <label>
                    <span class="greeen">@lang('custom.dealtracker.seats'): </span>
                  </label>
                  {{$item->no_of_seats ?? '-'}}
                </li>
                <li>
                  <span class="actions-seeker">
                    <a href="#" class="on-editing edit-row"></a>
                  </span>
                  <p class="text-dark">@lang('custom.dealtracker.booking-date') :</p>
                  <div class="address-part">{{ $item->booking_date ?? '-' }}</div>
                </li>
                <li>
                  <span class="actions-seeker">
                    <a href="javascript:void(0);" class="on-editing edit-row"></a>
                  </span>
                  <p class="text-dark">@lang('custom.dealtracker.booking-months'):</p>
                  <div class="address-part">{{ $item->booking_months ?? '-'}}</div>
                </li>

              </td>

              <td>
                {{$item->paymentstatus}}
              </td>
            </tr>
            @endforeach

          </tbody>

        </table>

      </div>