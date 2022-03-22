  <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">@lang('custom.dashboard.recent-properties')</h4>

                   @if( ! empty( $latest_landlord_properties ) )
                     @foreach( $latest_landlord_properties as $latest_landlord_property)
                       @php
                         $cover_image = $latest_landlord_property->cover_image ?? '';
                       @endphp 
                    <div class="media latest-post-item mt-3">
                        @if( $cover_image )
                        <div class="media-left mr-2">
                        <a href="javascript:void(0);"> <img class="media-object dn-img
                        dn-img" alt="64x64" src="{{ url( $cover_image ) }}" > </a>
                        </div>
                        @else
                           <div class="media-left mr-2">
                            <a href="javascript:void(0);"> <img class="media-object dn-img" alt="64x64" src="{{IMAGE_PATH_UPLOAD_SPACE_TYPES }}1.jpg"> </a>
                        </div>  
                        @endif
                        <div class="media-body">
                            <h5 class="media-heading mt-0"><a href="#">{{ $latest_landlord_property->company }}</a> </h5>
                          
                        </div>
                     <div class="text-right">
                        <a href="{{ route('properties.show',$latest_landlord_property->slug) }}" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary" target="_blank">@lang('global.app_view')</a>
                    </div>
                </div>

                      @endforeach  
                    @endif
                </div> <!-- end card-box -->