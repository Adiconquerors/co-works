@extends( 'layouts.main_two' )
@include( 'home-pages.common.head-links' )
<link href="{{ PUBLIC_ASSETS }}css-maps/24hrs-time.css" rel="stylesheet" id="app">
<style>
   .prop{
      font-weight: bold;
   }
   .new-checkbox{
    display: inline-flex;

   }
   .new-checkbox2{
     display: inline-flex;
        padding: 3px;
        width: 200px;
   }
   .check-box-slash:before{
    content: "\002F";
    padding-left:10px;
    }
    .sty-dn{
      display: none;
    }.sty-cfs18{
      color:#c1ab77; font-size: 18px;
    }.sty-tc{
      text-align: center;
    }

</style>
@section( 'content_two' )
<div id="content" class="mob-max">
   <div class="rightContainer">
      <h1><b>@lang('custom.properties.list-a-new-property')</b></h1>

  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
  @endif

  @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>    
        @endif


   {!! Form::open(['method' => 'POST', 'route' => ['properties.store'], 'files' => true,'name'=>'formPropertyType','id'=>'prevent_enter_property_form']) !!}
    
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

            {!! Form::label('name',trans('custom.listings.fields.property-name').'*', ['class'=>'prop']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.property-name'),

               ]) !!}
                  
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

               {!! Form::label('cotact_person_name',trans('custom.listings.fields.full-name-of-contact-person').'*',['class'=>'prop'] ) !!}

                  {!! Form::text('cotact_person_name', old('cotact_person_name'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.full-name-of-contact-person'),
               
               ]) !!}
              
               </div>
            </div>
         </div>

           <div class="form-group">
                  <label for="description"><b>@lang('custom.properties.description')</b></label>

                   <input type="text" placeholder="@lang('custom.listings.fields.description')" name="description" class="form-control" value="{{ old('description') }}">
              </div>

           <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                     {!! Form::label('phone_number',trans('custom.listings.fields.phone-number').'*',['class'=>'prop'] ) !!}
                    

                 {!! Form::number('phone_number', old('phone_number'), ['class' => 'form-control',
                 'placeholder'=>trans('custom.listings.fields.phone-number'),'min'=>'0','required'=>'true'

                 ]) !!}
                 
                 </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                  {!! Form::label('email',trans('custom.listings.fields.email-id').'*',['class'=>'prop'] ) !!}

                  {!! Form::email('email', old('email'), ['class' => 'form-control',
                 'placeholder'=>trans('custom.listings.fields.email-id'),
                 
                 ]) !!}


                 </div>
              </div>
           </div>
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">
                  {!! Form::label('alter_cotact_person_number',trans('custom.listings.fields.alternate-contact-number'),['class'=>'prop'] ) !!}

                  {!! Form::number('alter_cotact_person_number', old('alter_cotact_person_number'), ['class' => 'form-control','min'=>'0',
               'placeholder'=>trans('custom.listings.fields.alternate-contact-number'),

               
               ]) !!}
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <!-- price -->
            
               <!-- /price -->
               <div class="form-group">
                  {!! Form::label('alter_email',trans('custom.listings.fields.alternate-email-id'),['class'=>'prop'] ) !!}
                  
                  {!! Form::email('alter_email', old('alter_email'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.alternate-email-id'),

               ]) !!}
               </div>
            </div>
         </div>

         <div class="row">
          
               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

               {!! Form::label('alter_cotact_person_name',trans('custom.listings.fields.alternate-contact-person-name'),['class'=>'prop'] ) !!}

                  {!! Form::text('alter_cotact_person_name', old('alter_cotact_person_name'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.alternate-contact-person-name'),
               
               ]) !!}
              
               </div>
            </div> 

         </div>

           <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="area"><b>{{ trans('custom.listings.fields.area') }}</b></label>
                        <input type="number" placeholder="@lang('custom.listings.fields.area')" name="area" class="form-control" min="0" value="{{ old('area') }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="capacity"><b>{{ trans('custom.listings.fields.capacity') }}</b></label>
                        <input type="number" placeholder="@lang('custom.listings.fields.capacity')" name="capacity"class="form-control" min="0" value="{{ old('capacity') }}"> 
                    </div>
                </div>

                
            </div>
 
    

            @if( isAdmin() )

            <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

            {!! Form::label('is_approved',trans('custom.listings.fields.is-approved')) !!}

             <?php
                    $verified = array(
                        trans('custom.eforms.no') => trans('custom.eforms.no'),
                        trans('custom.eforms.yes') => trans('custom.eforms.yes'),
                    );
                    ?>  

            {!! Form::select('is_approved', $verified, old('is_approved'),['class' => 'form-control'

               ]) !!}
                  
               </div>
            </div>
         

             
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
             <div class="form-group">

            {!! Form::label('agent_id',trans('custom.listings.fields.assigned-to').'*') !!}

            {!! Form::select('agent_id', $agents, old('agent_id'),['class' => 'form-control','placeholder'=>trans('custom.listings.fields.assigned-to')

             ]) !!}
                
             </div>
            </div>
            </div>



            @endif
         
       
         <div class="form-group">
            <label for="property_address"><b>{{ trans('custom.listings.fields.property-address').'*' }}</b>
               <span id="property_address_latitude_span" class="label label-default"></span> 
               <span id="property_address_longitude_span" class="label label-default"></span></label>
            <input class="form-control" type="text" id="property_address" onClick="initialize(this.id);" onFocus="initialize(this.id);" name="property_address" placeholder="@lang('custom.eforms.enter-location')" autocomplete="off" value="{{old('property_address')}}">
            <input type="hidden" name="property_address_latitude" id="property_address_latitude" value="">
            <input type="hidden" name="property_address_longitude" id="property_address_longitude" value="">
            
            <input type="hidden" name="property_address_street_number" id="property_address_street_number" value="">
            <input type="hidden" name="property_address_city" id="property_address_city" value="">
            <input type="hidden" name="property_address_state" id="property_address_state" value="">
            <input type="hidden" name="property_address_country" id="property_address_country" value="">
            <input type="hidden" name="property_address_postal_code" id="property_addrress_postal_code" value="">

            
            <p class="help-block">{{ trans('custom.listings.fields.drag-marker') }}</p>
         </div>

         <div class="form-group">
            <label for="near_by_landmark"><b>{{ trans('custom.listings.fields.nearby-landmarks').'*' }} </b>
               <span id="near_by_landmark_latitude_span" class="label label-default"></span> 
               <span id="near_by_landmark_longitude_span" class="label label-default"></span> 
               <span id="longitude" class="label label-default"></span></label>
            <input class="form-control" type="text" name="near_by_landmark" id="near_by_landmark" placeholder="@lang('custom.listings.fields.nearby-landmarks')" autocomplete="off" onClick="initialize(this.id);" onFocus="initialize(this.id);" value="{{old('near_by_landmark')}}"> 

            <input type="hidden" name="near_by_landmark_latitude" id="near_by_landmark_latitude" value="">
            <input type="hidden" name="near_by_landmark_longitude" id="near_by_landmark_longitude" value="">
         </div>
         <div class="row">
          
      <?php
       $space_types = \App\SpaceType::getSpaceTypes(0);
      ?>
           
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

               <div class="form-group">
                  <label for="space_type_id"><b>{{ trans('custom.listings.fields.workspace-avaliable-in-office') }}</b></label>

                  @foreach( $space_types as $space_type)

                  <div class="checkbox custom-checkbox new-checkbox">
                   
                  <?php
                  $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);

                  $sub_space_type_old = old('sub_space_type_id');
                  
                  ?>
                  @foreach($subtypes as $sub )
                  <?php
                  $type_subtype = $sub->parent_id . '_' . $sub->id;
                  $selected = false;
                  if ( ! empty( $sub_space_type_old ) && in_array( $type_subtype, $sub_space_type_old)) {
                    $selected = true;
                  }
                  ?>
                  <label>
                      <input type="checkbox"  name="sub_space_type_id[]" value="{{$type_subtype}}" class="subtype" data-space_type_id="{{$sub->parent_id}}" data-sub_space_type_id="{{$sub->id}}" @if($selected) checked @endif>
                     <span class="fa fa-check"> </span> {{$sub->name}}&nbsp;

                  </label>

                @endforeach

                    </div>
                 @endforeach

               </div>
                 
            </div>
                        
         </div>
        
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_workstation"><b>{{ trans('custom.listings.fields.no-of-workstation') }}</b></label>
                  <input type="number" min="0" name="no_of_workstation" class="form-control" placeholder="@lang('custom.listings.fields.no-of-workstation')" value="{{old('no_of_workstation')}}">
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_private_office"><b>{{ trans('custom.listings.fields.no-of-private-office') }}</b></label>
                  <input type="number" min="0" name="no_of_private_office" class="form-control"  placeholder="@lang('custom.listings.fields.no-of-private-office')" value="{{old('no_of_private_office')}}">
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_meeting_office"><b>{{ trans('custom.listings.fields.no-of-meeting-rooms') }}</b></label>
                  <input type="number" min="0" name="no_of_meeting_office" class="form-control"   placeholder="@lang('custom.listings.fields.no-of-meeting-rooms')" value="{{old('no_of_meeting_office')}}">
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_training_office"><b>{{ trans('custom.listings.fields.no-of-training-office') }}</b></label>
                  <input type="number" min="0" name="no_of_training_office" class="form-control"   placeholder="@lang('custom.listings.fields.no-of-training-office')" value="{{old('no_of_training_office')}}">
               </div>
            </div>
         </div>

         @foreach($space_types as $space_type )

           <?php
            $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);
            ?>
            @foreach($subtypes as $sub )
              @if( SUBSPACE_TYPE_VIRTUAL == $sub->id)

                <?php
              $type_subtype = $sub->parent_id . '_' . $sub->id;
              $selected = false;

              $vo_reg_no = $vo_mailing_address  = null;
            
              
              ?>

              <!-- virtual offices -->
               <div class="row sty-dn" id="hd_hidden_fields_{{$sub->id}}" >
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group">
                        <label for="vo_reg_no[{{$sub->id}}]"><b>{{ trans('custom.listings.fields.vo-with-bussiness-reg-no') }}</b></label>
                        <input type="text" name="vo_reg_no[{{$sub->id}}]" id="vo_reg_no" class="form-control" placeholder="@lang('custom.listings.fields.vo-with-bussiness-reg-no')">
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group">
                        <label for="vo_mailing_address[{{$sub->id}}]"><b>{{ trans('custom.listings.fields.vo-with-mailing-address') }}</b></label>
                        <input type="text" min="0" name="vo_mailing_address[{{$sub->id}}]" placeholder="@lang('custom.listings.fields.vo-with-mailing-address')" class="form-control">
                     </div>
                  </div>
               </div>
               <!-- end virtual offices -->
              @else 

              <?php
             $type_subtype = $sub->parent_id . '_' . $sub->id;
            $selected = false;
      
            $avaliable_seats = $price_per_day = $price_per_month = null;
           
             ?>

            
             <div class="row" id="hd_hidden_fields_{{$sub->id}}" style="display: @if($selected) block @else none @endif;">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                   <div class="form-group">
                      <label for="avaliable_seats[{{$sub->id}}]"><b>{{ trans('custom.listings.fields.avaliable-seats-for') }} {{$sub->name}} *</b></label>
                      <input type="number" min="0" name="avaliable_seats[{{$sub->id}}]" class="form-control"   placeholder="@lang('custom.listings.fields.avaliable-seats-for') {{$sub->name}}">
                   </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                   <div class="form-group">
                      <label for="ws_per_day"><b>{{$sub->name}} {{ trans('custom.listings.fields.price-per-day') }}</b></label>
                      <div class="input-group">
                         <div class="input-group-addon">₹</div>
                         <input class="form-control" name="price_per_day[{{$sub->id}}]" step=0.01 type="number" placeholder="{{$sub->name}} @lang('custom.listings.fields.price-per-day')">
                      </div>
                   </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                   <div class="form-group">
                      <label for="ws_per_month"><b>{{$sub->name}} {{ trans('custom.listings.fields.price-per-month') }}</b></label>
                      <div class="input-group">
                         <div class="input-group-addon">₹</div>
                         <input class="form-control" step=0.01 name="price_per_month[{{$sub->id}}]" type="number" placeholder="{{$sub->name}} @lang('custom.listings.fields.price-per-month')">
                      </div>
                   </div>
                </div>
             </div>
             @endif
             @endforeach
         
         @endforeach
   
<div class="row">
   <?php
       $amenities = \App\Amenity::get();
       $amenity_old = old('amenity_id');
    ?> <!-- >Open hours -->
   
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <div class="form-group">
            <label><b>{{ trans('custom.listings.fields.amenities') }}</b></label>
            @foreach( $amenities as $amenity)
             <?php
            $type_amenity = $amenity->id;
            $selected = false;
            if ( ! empty( $amenity_old ) && in_array( $type_amenity, $amenity_old)) {
              $selected = true;
            }
            ?>
            <div class="checkbox custom-checkbox new-checkbox2"><label><input type="checkbox" name="amenity_id[]" value="{{ $amenity->id }}" @if($selected) checked @endif><span class="fa fa-check"></span> {{ $amenity->name }}</label></div>
         @endforeach
            
        </div>
        
    </div>

</div>
   
 
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label class="sty-cfs18"><b>{{ trans('custom.listings.fields.offer-details') }}</b></label>

                <div class="form-group">
                <label for="offer_title"><b>{{ trans('custom.listings.fields.offer-title') }}</b></label>
                <input type="text" name="offer_title" placeholder="@lang('custom.listings.fields.offer-title')" class="form-control" value="{{ old('offer_title') }}">
            </div>
        
             

                
            </div>
        </div>
    </div>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="form-group">
        <div class="row">
        <div class='col-sm-4'>
        <label class="sty-tc"><b>{{ trans('custom.listings.fields.open-hours') }}</b></label></div>
        <div class='col-sm-4'>
        <label for="time_from"><b>{{ trans('custom.listings.fields.from') }}</b></label></div>
        <div class='col-sm-4'>
        <label for="time_to"><b>{{ trans('custom.listings.fields.to') }}</b></label></div>
        </div>


   <?php
       $days = \App\Day::get();
       $day_old = old('day_id');
    ?> <!-- >Open hours -->


  <label for="days"><b>{{ trans('custom.listings.fields.days') }}</b></label>
  @foreach( $days as $day)

      <?php
      $type_day = $day->id;
      $selected = false;
      if ( ! empty( $day_old ) && in_array( $type_day, $day_old)) {
      $selected = true;
      }
      ?>
   <div class='col-sm-4'>   
      <div class="form-group">

        <div class='checkbox custom-checkbox'>
          <label><input type="checkbox" name="day_id[]" value="{{ $day->id }}" data-day_id="{{$day->id}}" @if($selected) checked @endif>
          <span class="fa fa-check"></span> {{ $day->name }}</label>
        </div>
      </div>
    </div>
        <div class='col-sm-4'>
           <div class="form-group">
            <?php
            $time_from = ! empty($record->time_from) ?  $record->time_from  : '';
            ?>
                  
                  <div class='input-group date' id='datetimepicker{{ $day->id }}from'>
                    <input type="text" name="time_from[]" class="form-control" placeholder="@lang('custom.listings.fields.from')" value="{{$time_from}}"/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class="form-group">
             <?php
            $time_to = ! empty($record->time_to) ?  $record->time_to  : '';
            ?>
                 
                  <div class='input-group date' id='datetimepicker{{ $day->id }}to'>
                    <input type="text" name="time_to[]"class="form-control" placeholder="@lang('custom.listings.fields.to')" value="{{$time_to}}"/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
              </div>
            @endforeach              

      
  </div>
</div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      
        <div class="form-group">
                   
            <label for="cover_image"><b>{{ trans('custom.listings.fields.cover-image') }}</b></label>
            
            <input type="file" class="file file-upload"  data-show-upload="false" data-show-caption="false" data-show-remove="false" name="cover_image"accept="image/jpeg,image/png" files="true" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images">     
            </div>

        </div>
   

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="image"><b>{{ trans('custom.listings.fields.image-gallery') }}</b></label>
            <input type="file" class="file" multiple data-show-upload="false" data-show-caption="false" data-show-remove="false" name="image[]"accept="image/jpeg,image/png" files="true" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images">
            <p class="help-block">{{ trans('custom.listings.fields.multilple-imgs-at-once') }}<</p>
        </div>
    </div>
</div>
 <!-- new section 2-->

<!-- >Contact section -->
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="sty-cfs18"><b>{{ trans('custom.listings.fields.contact-details') }}</b></label>

                        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="property_manager_name"><b>{{ trans('custom.listings.fields.property-manager-name').'*' }}</b></label>
                        <input type="text" name="property_manager_name" placeholder="@lang('custom.listings.fields.property-manager-name')" class="form-control" value="{{ old('property_manager_name') }}"> 
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="property_manager_email"><b>{{ trans('custom.listings.fields.property-manager-email').'*' }}</b></label>
                            <input class="form-control" placeholder="@lang('custom.listings.fields.property-manager-email')" name="property_manager_email"type="email" value="{{ old('property_manager_email') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="property_manager_number"><b>{{ trans('custom.listings.fields.property-manager-phone').'*' }}</b></label>
                        <input type="number" placeholder="@lang('custom.listings.fields.property-manager-phone')" name="property_manager_number"class="form-control" value="{{ old('property_manager_number') }}">
                    </div>
                </div>
                
            </div>

           
                     
  
                        
                    </div>
                </div>
            </div>
        

   <!-- >Invoice Related Details -->
          <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                 <div class="form-group">
                     <label class="sty-cfs18"><b>{{ trans('custom.listings.fields.invoice-related-details') }}</b></label>

                     <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                     <label for="company"><b>{{ trans('custom.listings.fields.company-name') }}</b></label>
                     <input type="text" name="company" placeholder="@lang('custom.listings.fields.company-name')" class="form-control" value="{{ old('company') }}">
                 </div>
             </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="pan_no"><b>{{ trans('custom.listings.fields.pan-no') }}</b></label>
                          <input class="form-control" placeholder="@lang('custom.listings.fields.pan-no')" name="pan_no"type="text" value="{{ old('pan_no') }}">
                       </div>
                   </div>
         
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                     <label for="cin_no"><b>{{ trans('custom.listings.fields.cin-no') }}</b></label>
                     <input type="text" placeholder="@lang('custom.listings.fields.cin-no')" name="cin_no" class="form-control" value="{{ old('cin_no') }}">
                 </div>
             </div>

             
             
         
       <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
           <div class="form-group">
               <label for="gst"><b>{{ trans('custom.listings.fields.gst') }}</b></label>
               <input type="number" min="0" placeholder="@lang('custom.listings.fields.gst')" name="gst"class="form-control" value="{{ old('gst') }}">
           </div>
       </div>
       
   </div>

         <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
             <label for="billing_address"><b>{{ trans('custom.listings.fields.billing-address') }}</b></label>

             <input type="text" placeholder="@lang('custom.listings.fields.billing-address')" name="billing_address" class="form-control" value="{{ old('billing_address') }}"> 

         </div>

             </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
             <label for="registered_address"><b>{{ trans('custom.listings.fields.registered-address') }}</b></label>

              <input type="text" placeholder="@lang('custom.listings.fields.registered-address')" name="registered_address" class="form-control" value="{{ old('registered_address') }}"> 

           
         </div>
         
             </div>
             
         </div>
                  

                     
                 </div>
             </div>
         </div>
                <!-- new section 4-->

                    <!-- new section 4-->
                <!-- >Bank Details -->
                <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="form-group">
                           <label class="sty-cfs18"><b>{{ trans('custom.listings.fields.bank-details') }}</b></label>

                  <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="bank_name"><b>{{ trans('custom.listings.fields.bank-name') }}</b></label>
                           <input type="text" placeholder="@lang('custom.listings.fields.bank-name')" name="bank_name" class="form-control" value="{{ old('bank_name') }}">
                       </div>
                   </div>

                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="account_holder_name"><b>{{ trans('custom.listings.fields.account-holder-name') }}</b></label>
                           <input type="text" placeholder="@lang('custom.listings.fields.account-holder-name')" name="account_holder_name" class="form-control" value="{{ old('account_holder_name') }}"> 
                       </div>
                   </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="account_number"><b>{{ trans('custom.listings.fields.account-number') }}</b></label>
                           <input type="text" placeholder="@lang('custom.listings.fields.account-number')" name="account_number" class="form-control" value="{{ old('account_number') }}">
                       </div>
                   </div>

                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="ifsc_code"><b>{{ trans('custom.listings.fields.ifsc-code') }}</b></label>
                           <input type="text" placeholder="@lang('custom.listings.fields.ifsc-code')" name="ifsc_code" class="form-control" value="{{ old('ifsc_code') }}">
                       </div>
                   </div>


                  </div>

                           
                       </div>
                   </div>
               </div>


<div class="form-group">
   <button type="submit" name="send" class="btn btn-green btn-lg isThemeBtn">{{ trans('custom.listings.fields.add-property') }}</button>
</div>
 {!! Form::close() !!}   
</div>
</div>
<div class="clearfix"></div>

<script src="{{ PUBLIC_ASSETS }}js/jquery/3.4.1/jquery.min.js"></script> 

<script>

$('.subtype').on("click", function() {
  var sub_space_type_id = $(this).data('sub_space_type_id');
  var checked = $(this).is(':checked');

  if ( checked ) {
    $('#hd_hidden_fields_' + sub_space_type_id).slideDown();
  } else {
    $('#hd_hidden_fields_' + sub_space_type_id).slideUp();
  }
});

</script>

<script>
  $('#prevent_enter_property_form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
</script>

<script src="{{PUBLIC_ASSETS}}js-maps/fileinput.min.js"></script>

@stop
