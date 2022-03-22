  <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">@lang('custom.dashboard.recent-properties')</h4>
                   @if( ! empty( $latest_properties ) )
                     @foreach( $latest_properties as $latest_property)
                       @php
                         $cover_image = $latest_property->cover_image ?? '';
                         $property_created_by = \App\User::find( $latest_property->customer_id );
                       @endphp 
                    <div class="media latest-post-item mt-3">
                        @if( $cover_image )
                        <div class="media-left mr-2">
                        <a href="javascript:void(0);"> <img class="media-object dn-img
                        dn-img" alt="64x64" src="{{ url( $cover_image ) }}" > </a>
                        </div>
                        @else
                           <div class="media-left mr-2">
                            <a href="javascript:void(0);"> <img class="media-object dn-img" alt="64x64" src="{{PUBLIC_ASSETS}}images/default-imgs/1.jpg"> </a>
                        </div>  
                        @endif
                        <div class="media-body">
                            <h5 class="media-heading mt-0"><a href="#">{{ $latest_property->name }}</a> </h5>
                            <p class="font-13 text-muted">
                                {{$latest_property->created_at->format('M d , Y') }} | {{ $property_created_by ? $property_created_by->name : '-' }}
                            </p>
                        </div>
                     <div class="text-right">
                        <a href="{{ route('properties.show',$latest_property->slug) }}" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary" target="_blank">@lang('global.app_view')</a>
                    </div>
                </div>

                      @endforeach  
                    @endif
                </div> <!-- end card-box -->