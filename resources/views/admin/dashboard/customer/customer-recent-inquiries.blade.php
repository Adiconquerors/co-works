 <tbody>
       @if( ! empty( $customer_latest_inquiries ) )
            @foreach( $customer_latest_inquiries as $inquiry)
              <?php
                    $properties = \App\Property::find( $inquiry->property_id );              
                    $cover_image = $properties ? $properties->cover_image : '';
              ?>

          <tr>

                <td>
                    <a class="user" href="javascript:void(0);">
                        @if($cover_image)
                         <img src="{{ $cover_image }}" alt="" class="rounded-circle img-thumbnail thumb-md">
                        @else
                          <img src="{{ PUBLIC_ASSETS.'images/default-imgs/1.jpg' }}" alt="" class="rounded-circle img-thumbnail thumb-md">
                        @endif 
                    </a>
                 </td>
             
              <td class="hide-phone">
                  <h5 class="m-0">{{ $properties ? $properties->company : '' }} </h5>
                 
              </td>
              <td class="text-right">
                  <a href="{{ route('properties.show',$properties->slug) }}" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary">@lang('global.app_view')</a>
                 
              </td>
          </tr>
          @endforeach
      @endif

       </tbody>