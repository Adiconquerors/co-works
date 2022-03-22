      <?php 
        if( count( $items ) > 0 ) {
      ?>
      @foreach( $items as $item )
      <div class="property-card property-horizontal bg-white">
        <div class="row">
          @php
            $property_sub_space_types = $item->property_sub_space_types;
            $property_amenities = $item->property_amenities;
            $property_timings = $item->property_timings;
            $cover_image = $item->cover_image;
            $agents = \App\User::find($item->agent_id);
            $item_heart_color = $item->heart_color;
            $item_schedule_visit = $item->schedule_visit;
            
          @endphp

          <style>
            .sty-w{
                width:130px;
            }
            .sty-pw{
                padding: 5px 26px;
            }
          </style>
 
        <div class="col-sm-2">
          @if( $cover_image )
            <div class="property-image" style="background: url('{{ url( $cover_image ) }}') center center / cover no-repeat;">
              @if( isAdmin() )      
                <span class="property-label badge badge-darkblue">
                  <input id="toggle-heart" type="checkbox" />
                  <label for="toggle-heart" id="property-toggle-heart">

                    <i class="fa fa-heart" id="property-heart_{{$item->id}}" style="color: @if($item_heart_color == 'red' ) red @else white @endif"></i>
                  </label>
                </span>
               @endif

              @if( 'yes' === $item->is_approved )
                <span class="property-label-bottom badge badge-success">
                  @lang('custom.explore.avaliable')
                </span>
               @else
                <span class="property-label-bottom badge badge-danger">
                  @lang('custom.explore.not-avaliable')
                </span>
              @endif 
            </div>
          @else
             <div class="property-image" style="background: url('{{ url( PUBLIC_ASSETS . 'images/default-imgs/1.jpg' ) }}') center center / cover no-repeat;">
              @if( isAdmin() )      
                <span class="property-label badge badge-darkblue">
                  <input id="toggle-heart" type="checkbox" />
                  <label for="toggle-heart" id="property-toggle-heart">

                    <i class="fa fa-heart" id="property-heart_{{$item->id}}" style="color: @if($item_heart_color == 'red' ) red @else white @endif"></i>
                  </label>
                </span>
               @endif

              @if( 'yes' === $item->is_approved )
                <span class="property-label-bottom badge badge-success">
                  @lang('custom.explore.avaliable')
                </span>
               @else
                <span class="property-label-bottom badge badge-danger">
                  @lang('custom.explore.not-avaliable')
                </span>
              @endif 
            </div>
         @endif  

          </div>

          <!-- /col 4 -->
          <div class="col-sm-4 col-12">
 
              <div class="listingInfo">
                <div class="">
                  <h4><a href="javascript:void(0);" class="text-dark property-lab">{{ $item->company }}</a>
                  </h4>
                  <p  >{{ $item->property_address }} </p>
                  <p  ><span class="badge badge-pill badge-secondary">{{ getSetting('invoice-prefix', 'invoice-settings') }} - {{ $item->id }} </span></p>
    

                  <div class="vew-prp">
                    <a href="{{ route('properties.show',$item->slug) }}" target="_blank" class="btn btn-purple waves-effect waves-light">
                      @lang('custom.explore.view-property')
                    </a>
                  
                  </div>

              </div>
              
            

            </div>
          </div>
          <!-- /col 8 -->
          <!-- /col 4 -->
          <div class="col-sm-3 col-12" >
            <div class="property-content">
              <div class="listingInfo">
        
                    <p href="javascript:void(0);" class="badge badge-pill badge-secondary" >
                      @foreach( $property_sub_space_types as $property_sub_space_type)
                      <?php
                              $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                               $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);
                              if( $space_types ){
                              $property_space_type_name = $space_types->name;
                              }else{
                              $property_space_type_name = '-';
                              }
                              ?>

                      {{ $space_types ? $space_types->name : '-' }} ( {{ $sub_space_types->name }} )
                      @endforeach
                    </p>
               
                  
                  <div class="detilphon">
                    <p > <i class="fab fa-whatsapp" id="all-watsapp"></i><span>&nbsp; <b>{{ $item->phone_number }}</b></span></p>

                    <p><a href="javascript:void(0);" class="btn btn-outline-secondary " data-toggle="modal" data-target="#modalContactForm_{{$item->id}}"> @lang('custom.explore.alter')</a>  </p>
                <p>  <span class="updated-date">@lang('custom.inquiries.updated-on'): {{ $item->updated_at->format('M d , Y') }}</span></p>
                    <input type="hidden" name="heart_property_id" id="heart_property_id" value="{{ $item->id }}">

                  </div>
             
              </div>
            </div>
          </div>
          <!-- /col 8 -->
          <!-- /col 4 -->

          <div class="col-sm-3 col-12">
            <div class="property-content">

               @if( isAdmin() )
       
                {!!Form::open([
                'method'=>'delete',
                'route' =>['properties.destroy', $item->slug],
                'onclick'=>'return checkDelete();'
                ])!!}
              <p class="sty-w">
                <button type="submit" class="btn btn-danger sty-mb10">
                  @lang('custom.explore.delete-property')
                </button>
             </p>
                {!! Form::close() !!}
            
              @endif
              
               @include('admin.common.delete-script',['properties.destroy'] ) 
              
              @if( isAdmin() || isLandlord() )
             <p>   <div class="btn-group sty-w">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   class="sty-pw">
                    <i class="fa fa-angle-double-down" aria-hidden="true" ></i>&nbsp;@lang('custom.explore.action')&nbsp;<span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                   @if( isAdmin() )
                    <li>
                        {!!Form::open([
                        'method'=>'post',
                        'route' =>['properties.availability','slug' => $item->slug,'is_approved'=>'no']

                        ])!!}

                       
                     <button type="submit" class="dropdown-item">
                        @lang('custom.explore.not-avaliable')
                    </button>
                        
                        {!! Form::close() !!}
                      
                    </li>



                    <li>
                        {!!Form::open([
                        'method'=>'post',
                        'route' =>['properties.availability','slug' => $item->slug,'is_approved'=>'yes']

                        ])!!}

                       
                     <button type="submit" class="dropdown-item">
                         @lang('custom.explore.avaliable')
                    </button>
                        
                        {!! Form::close() !!}
                      
                    </li>
                   @endif 

                    <li>
                     
                        <a href="{{ route('prop.edit',$item->slug) }}" class="dropdown-item">
                       @lang('custom.explore.update-property')
                       </a>
                     
                    </li>

                  </ul>
                </div> </p>
              @endif

            @if( isAdmin() )    
              <p  class="sty-w">
           <a href="javascript:void(0);" class="btn btn-medium-dark  mmt-10" id="schedule-visit_{{$item->id}}" style="display: @if($item_schedule_visit == 'no' ) none @else block @endif">@lang('custom.svisit')</a>
           </p>
          @endif 
 
                

            </div>
          </div>
          <!-- /col 8 -->
        </div>
        <!-- /inner row -->
      </div>
      @endforeach
      <!-- End property item -->
      <div>


           <ul class="pagination pagination-split justify-content-end">
                {{ $items->links() }}
       
        </ul>


      </div>

      <?php
       } else {
      ?>
      <h4 class="sty-tc">@lang('custom.explore.no-records')</h4>
      <?php 
        }
     ?>

      <!-- /Alternative Contact Modal -->
