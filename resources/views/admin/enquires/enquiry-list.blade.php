      <style>
        .table-collapse {
        border-collapse: collapse; border-spacing: 0; width: 100%;
        }
        .cursor-pointer-hand{
        cursor: pointer;padding-left: 20px;
        }
        .modal-margin-sty{
        margin-top:200px;
        }
        .md-sty-inline{
        display: inline;
        }
        .form-enquiry-margin{
        margin-left: 60px;
        }
        .maintainht { 
            width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .junkleadsty{
          padding: 6px 20px !important;
          color: #333 !important;
          border: none !important;
        }
      </style>
    

    <div class="">
        <table class="table double table-striped table-bordered dt-responsive nowrap td_m table-collapse table-scroller table-responsive" id="" >
          <thead>
            <tr class="empty-background">
              <th> @lang('custom.inquiries.sno')</th>
              <th> @lang('custom.inquiries.status')</th>
              <th> @lang('custom.inquiries.seeker-details')</th>
              <th> @lang('custom.inquiries.requirement-details')</th>
              <th> @lang('custom.inquiries.updated-status')</th>
              <th> @lang('custom.inquiries.visit-details')</th>
              <th> @lang('custom.inquiries.remarks-comments')</th>
              <th> @lang('custom.inquiries.assigned-to')</th>
              <th> @lang('global.app_actions')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
              @php
               $item_flag_color = $item->flag_color;
               $property_id = $item->property_id ?? '';
                $property = \App\Property::find( $property_id );
                $property_sub_space_types = $property->property_sub_space_types ?? '';
                $assigned_to_users = \App\User::find($item->assigned_to);
                $agents = \App\User::find($property->agent_id);
              @endphp
            <tr class="gradeX" id="gradex_{{$item->id}}" style="background: @if($item_flag_color == 'lightgreen' ) lightgreen @else '' @endif">
              <td>{{$item->id}}<br>
                <a href="javascript:void(0)" id="checkered_{{$item->id}}" class="flag-select-sno">
                  <i class="far fa-flag"></i>
                 
                </a>
              </td>
              <td>
                <ul>

                  <?php
                        $update_status = $item->update_status;
                        $progress      = $item->progress;

                        if( $progress == 25 )
                        {
                           $bar_color = 'danger';
                           $bar_value = 25;

                        }elseif($progress == 35){
                           $bar_color = 'success';
                           $bar_value = 35;
                        }elseif($progress == 50){
                           $bar_color = 'orange';
                           $bar_value = 50;
                        }elseif($progress == 90){
                           $bar_color = 'primary';
                           $bar_value = 90;
                        }elseif($progress == 100){
                           $bar_color = 'success';
                           $bar_value = 100;
                        }

                     ?>

                  <li>
                    <div class="progress progress-md">
                      <div class="progress-bar bg-{{$bar_color}}-bars" role="progressbar" aria-valuenow="{{$bar_value}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$bar_value}}%;">
                        {{$bar_value}}%
                      </div>
                    </div>
                  </li>
                  <li><label>{{ $update_status }}</label></li>

                  <li>
                    <p>
                      <span class="updated-date">
                         @lang('custom.inquiries.updated-on'): {{ $item->created_at->format('M d , Y') }}
                      </span>
                    </p>
                  </li>
                 
              </td>
             <td>
                <ul>
                  <li>
                    <span class="actions-seeker">

                      <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing send-row sendBill" data-action="mail-message-mai" data-enquiry_id="{{$item->id}}">
                        <i class="fa fa-envelope"></i>
                      </a>

                      <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing edit-row sendBill" data-action="seeker-details-ema" data-enquiry_id="{{$item->id}}">
                        <i class="fas fa-pencil-alt"></i>
                      </a>


                      @if($item->shortlisted_properties)
                      <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing send-row sendBill" data-action="properties-shared-sha" data-enquiry_id="{{$item->id}}">
                        <i class="fa fa-share-alt"></i>
                      </a>
                      @endif

                    </span>
                    <p class="text-dark text-left">{{ $item->name }}</p>
                  </li>

                  <li><a href="javascript:void(0);">{{ $item->email }}</a></li>
                  <li>
                    <label>
                      {{ $item->company ? $item->company : trans('custom.cross_mark') }}
                    </label>
                  </li>
                  <li>
                    <p class="font-13 text-muted m-b-0">
                      <span>
                        <i class="fas fa-mobile-alt"></i> {{ $item->phone_number }}
                      </span>
                      <span class="actions-seeker">
                        <i class="fab fa-whatsapp greeen"></i>
                      </span>
                    </p>
                  </li>
                  <li>
                    <span class="Added on">
                      @lang('custom.inquiries.created-on'): {{ $item->created_at->format('M d , Y') }}
                    </span>
                  </li>

                </ul>
              </td>
                <td>
                  <ul>
                <li>
                  <span class="actions-seeker">
                    <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing edit-row sendBill" data-action="requirement-details-req" data-enquiry_id="{{$item->id}}">
                      <i class="fas fa-pencil-alt"></i></a>
                  </span>
            
                  
                
                <li class="maintainht" title="{{$item->address ?? '-' }}">
                  <b class="text-dark"> @lang('custom.inquiries.inquired-for'):</b>
                  <span>{{ $item->address ?? '-' }}</span>
                </li>
               
                  
                  <li>
                    <span class="Added on">
                     <b class="text-dark">@lang('custom.inquiries.inquired-property-name'):</b> {{ $property ? $property->name : '-' }}
                    </span>
                  </li>

                   <li>
                    <span class="Added on">
                     <b class="text-dark">@lang('custom.inquiries.property-company'):</b> {{ $property ? $property->company : '-' }}
                    </span>
                  </li>

                   @if( $property_sub_space_types )
                   <li>
                    <span class="Added on">
                     <b class="text-dark">@lang('custom.spacetypes.space-types'):</b> @foreach( $property_sub_space_types as $property_sub_space_type)
                        <?php
                          $property_space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                        ?>
                           <span class="badge">{{ $property_space_types ? $property_space_types->name : ''}}</span>

                      @endforeach
                    </span>
                  </li> 
                  @endif

                    <li>
                    <span class="Added on">
                     <b class="text-dark">@lang('custom.inquiries.seats'):</b> {{ $item->capacity_id ?? '-'}}
                    </span>
                  </li>  

                   <li>
                    <span class="Added on">
                     <b class="text-dark">@lang('custom.listings.fields.agent'):</b> {{ $agents ? $agents->name : '-' }}
                    </span>
                  </li> 

                    <li>
                    <span class="Added on">
                     <b class="text-dark">@lang('custom.inquiries.booking-date'):</b> {{ $item->enquire_date ?? '-'}}
                    </span>
                  </li> 

                    <li>
                    <span class="Added on">
                     <b class="text-dark">@lang('custom.inquiries.booking-months'):</b> {{ $item->enquire_month ?? '-' }}
                    </span>
                  </li>     

                  <li>
                    <span class="Added on">
                     <b class="text-dark">@lang('custom.inquiries.inquiry-from'): </b>{{ $item->enquire_from ?? '-' }}
                    </span>
                  </li>     
                  <!-- End -->
                </li>

              </ul>
              </td>

           <td>
                <ul>
                  <?php
                  $status_update_log = \App\UpdateStatusLog::where('enquiry_id',$item->id)->get();
                  ?>

                  @foreach( $status_update_log->slice(0,3) as $log )
                    <li class="show-line">{{ $log->update_status_user }} on {{ $log->updated_at->format('M d , Y h:i:s A') }}</li>
                  @endforeach

                </ul>
                <br>

                <button href="javascript:void(0);" data-toggle="modal" data-target="#modalContactForm_{{$item->id}}" id="view_all"> @lang('custom.inquiries.view-all')</button>


              </td>
              <td>
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="sendBill" data-action="visit-details-sit" data-enquiry_id="{{$item->id}}">
                  <button id="add">
                    @lang('custom.inquiries.add')
                    <i class="mdi mdi-plus-circle-outline"></i>
                  </button>
                </a>
                <br>
                <li class="maintainht" title="{{$item->visit_details ?? '-' }}">
                  <div class="show-line address-part">{{ $item->visit_details ?? '-' }}</div>
                </li>
              </td>
               <td>
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="sendBill" data-action="comments-details-com" data-enquiry_id="{{$item->id}}">
                  <button id="add">
                    @lang('custom.inquiries.add')
                    <i class="mdi mdi-plus-circle-outline"></i>
                  </button>
                </a>
                <br>
                <li  class="maintainht" title="{{$item->comments ?? '-' }}">
                  <div class="show-line address-part">{{ $item->comments ?? '-' }}</div>
                </li>
              </td>

              <!-- assigned to -->
            <td>
                @if( $item->assigned_to == 0 )
                    <?php
                    $not_assigned = trans('custom.not-assigned');
                    ?>
                    {{$not_assigned}}
                  @else
                    {{ $assigned_to_users ? $assigned_to_users->name : $not_assigned }}
                  @endif
               @if( isAdmin() )   
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing edit-row sendBill" data-action="assigned-details-ign" data-enquiry_id="{{$item->id}}">
                  <i class="fas fa-pencil-alt"></i>
                </a>
               @endif 

              </td>
              <!--end assigned to -->
                <td class="actions">
                
                @if( isAdmin() )
                <a href="javascript:void(0);">
                  {!!Form::open([
                  'method'=>'delete',
                  'route' =>['enquire.destroy',$item->id],
                  'onclick'=>'return checkDelete();'
                  ])!!}

                  <button type="submit" class="on-default remove-row">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  {!!Form::close()!!}
                </a>
                @endif
                <br />
                <br />
                <!-- test -->

                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle-1"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </button>
                  <ul class="dropdown-menu">

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="deal-lost-del" data-enquiry_id="{{$item->id}}">@lang('custom.inquiries.deal-lost')</a>
                    </li>


                    <li>
                      
                         {!!Form::open([
                        'method'=>'post',
                        'route' =>['enquiries.junklead','id' => $item->id,'junk_lead'=>'yes']

                        ])!!}

                     <button type="submit" class="dropdown-item cursor-pointer-hand junkleadsty" >
                        @lang('custom.inquiries.junk-lead')
                    </button>
                        
                        {!! Form::close() !!}
                      
                    </li>

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="booking-initiated-boo" data-enquiry_id="{{$item->id}}"> @lang('custom.inquiries.initiate-booking')</a>
                    </li>

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="update-status-sta" data-enquiry_id="{{$item->id}}"> @lang('custom.inquiries.update-status')</a>
                    </li>


                  </ul>
                </div>

                <!-- end test -->

              </td>
            </tr>
            @endforeach



          </tbody>



        </table>
        @include('admin.common.delete-script',['enquire.destroy'] )
      </div>


    
      @if( ! empty( $items ) )
      @foreach( $items as $item )
      <!-- Option Sent/Shortlisted -->
      <div class="modal fade" id="modalContactForm_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-margin-sty">
            <div class="modal-header text-center">
              <h4 class="modal-alternative-title w-100 font-weight-bold">
                @lang('custom.inquiries.updated-status')
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                  &times;
                </span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form md-sty-inline">
                <?php
                 $status_update_log = \App\UpdateStatusLog::where('enquiry_id',$item->id)->get();
              ?>

                @foreach( $status_update_log as $log )
	                <label data-error="wrong" data-success="right" for="form34" class="form-enquiry-margin">
	                  {{ $log->update_status_user }} @lang('custom.inquiries.on') {{ $log->updated_at->format('M d , Y h:i:s A') }}
	                </label>
                @endforeach
              </div>
            </div>

          </div>
        </div>
      </div>

      @endforeach

      @endif

     
  

