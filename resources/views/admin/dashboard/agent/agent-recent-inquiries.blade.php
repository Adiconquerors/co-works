
 <tbody>
       @if( ! empty( $latest_agent_assigned_leads ) )
            @foreach( $latest_agent_assigned_leads as $inquiry)
              @php
                    $leads = \App\User::find( $inquiry->customer_id ); 
                    $cover_image = $leads ? $leads->image : '';                   
              @endphp

          <tr>
             
                 <td>
                    <a class="user" href="javascript:void(0);">
                        <img src="{{ getDefaultimgagepath($cover_image,'users','') }}" alt="" class="rounded-circle img-thumbnail thumb-md">
                    </a>
                 </td>

              <td class="hide-phone">
                  <h5 class="m-0">{{ $leads ? $leads->name : '' }} </h5>
                 
              </td>
              <td class="text-right">
                  <a href="{{ route( 'leads.show',$inquiry->id ) }}" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary">@lang('global.app_view')</a>
                 
              </td>
          </tr>
          @endforeach
      @endif

       </tbody>