 <tbody>
       @if( ! empty( $latest_registered_users ) )
            @foreach( $latest_registered_users as $registered_user)
            @php
                $image = $registered_user->image;
            @endphp

          <tr>

              <td>
                  <a class="user" href="javascript:void(0);">
                      <img src="{{ getDefaultimgagepath($image,'users','') }}" alt="" class="rounded-circle img-thumbnail thumb-md">
                  </a>
              </td>

              <td class="hide-phone">
                  <h5 class="m-0">{{ $registered_user->name }} </h5>
                 
              </td>
              <td class="text-right">
                  <a href="{{ route( 'users.edit',$registered_user->id ) }}" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary">@lang('global.app_edit')</a>
                 
              </td>
          </tr>
          @endforeach
      @endif

       </tbody>