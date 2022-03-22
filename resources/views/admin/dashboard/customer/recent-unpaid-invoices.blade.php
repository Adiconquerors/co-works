  
  <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">@lang('others.recent-unpaid-invoices')</h4>

                   @if( ! empty( $customer_latest_unpaid_invoices ) )
                     @foreach( $customer_latest_unpaid_invoices as $latest_invoice)
                       <?php
                            $properties = \App\Property::find( $latest_invoice->property_id );              
                             $cover_image = $properties ? $properties->cover_image : '';
                        ?>
                    <div class="media latest-post-item mt-3">
                        @if( $cover_image )
                        <div class="media-left mr-2">
                        <a href="javascript:void(0);"> <img class="media-object dn-img
                        dn-img" alt="64x64" src="{{ url( $cover_image ) }}" > </a>
                        </div>
                        @else
                           <div class="media-left mr-2">
                            <a href="javascript:void(0);"> <img class="media-object dn-img" alt="64x64" src="{{PUBLIC_ASSETS }}images/default-imgs/1.jpg"> </a>
                        </div>  
                        @endif
                        <div class="media-body">
                            <h5 class="media-heading mt-0"><a href="#">{{ $properties ? $properties->company : '' }}</a> </h5>
                           
                        </div>
                     <div class="text-right">
                        <a href="{{ route('unpaidinvoice.show',$latest_invoice->id) }}" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary" target="_blank">@lang('custom.dashboard.pay')</a>
                    </div>
                </div>

                      @endforeach  
                    @endif
                </div> <!-- end card-box -->