@extends( 'layouts.main_two' )

@section( 'main_two_header_links' )
@include( 'home-pages.common.head-links' )
<link rel="stylesheet" href="{{PUBLIC_ASSETS_NEW_ADMIN}}links/css/normalizefive/normalize.min.css">

<link rel="stylesheet" href="{{PUBLIC_ASSETS_NEW_ADMIN}}css/new-css-links/bootstrapvalidator/bootstrapValidator.min.css">

<style>
   .cd-user-modal-container .cd-switcher li {
      width: 48%;
      float: left;
      text-align: center;
      list-style-type:none;
   }

input[type="checkbox"] {
    display: block;

}

.cd-user-modal-container .cd-switcher a.selected {
    background: #FFF !important;
    color: #c1ab77 !important;
    border-bottom: 2px solid #c1ab77 !important;
    text-decoration: none !important;
}

input[type=checkbox], input[type=radio] {
 width: auto;
}
/*New inline styles*/
.sty-mt20{
    margin-top:-20px;
  }
  .sty-cl{
    color:#011935;
  }
  .sty-lstn{
   list-style-type:none;
  }
  .sty-bbs{
    border-bottom: 1px solid #e8e8e8;
  }
 .sty-mb150{
  margin-bottom: 150px;

}
 .sty-mt30{
  
    padding-top:20px; 
 }
 .sty-mt24{
  margin-top: 24px;
 }
 .sty-dn{
  display: none;
 }
   .btn-enquire-solid {
    background: #40c8f4;
    border-color: #40c8f4;
    color: #fff !important;
    border-radius: 3px;
    font-size: 14px;
    margin-top: 25px!important;
}
@media screen and (max-width:640px){
.table > thead > tr > th {
    background-color: #e8e8e8;
    border-bottom: 1px solid #e8e8e8;
    font-size: 12px;
    font-weight: normal;
    padding: 0px 0px !important;
  
  }  /* padding: 10px 15px; */
}
</style>

@endsection 

 @if($record)
@php
  $cover_image       = $record->cover_image;
  $images            = json_decode($record->image,true); 
  $description       = $record->description;
  $property_address  = $record->property_address;
  $records[] = $record;
  $single_page = trans('custom.eforms.yes');
@endphp

@else

     @php
       $cover_image       = null;
       $propertystatus_id = null;
       $property_address  = null;
       
    @endphp

 @endif


@section( 'content_two' )




   <div id="content" class="mob-max">
      <div class="singleTop">
         <div id="carouselFull" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
               @if (is_array($images) || is_object($images))
               @foreach ($images as $image)
               <li data-target="#carouselFull" data-slide-to="{{$loop->index}}" class="@if($loop->first) active @endif"></li>
               @endforeach
               @endif
            </ol>
            @if($images)
            <div class="carousel-inner">
          @if($record)
          
            @if(is_array($images) && !empty($images))
            @foreach ($images as $image)
            <?php
              $image_path = PREFIX1 . 'thumb/' . $image;
            ?>
               <div class="item @if($loop->first) active @endif">
                  <img src="{{ url( $image_path ) }}"/>
                  <div class="container">
                     <div class="carousel-caption">
                     </div>
                  </div>
               </div>
             @endforeach 
          @endif
            </div>
           @endif 
            <a class="left carousel-control" href="#carouselFull" role="button" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
            <a class="right carousel-control" href="#carouselFull" role="button" data-slide="next"><span class="fa fa-chevron-right"></span></a>
         </div>
            
            @endif
         <div class="summary">
            <div class="row">
                   <?php
                     $agents = \App\User::find($record->agent_id);
                     if( ! empty($agents) ){
                     $agent_image = IMAGE_PATH_UPLOAD_USERS.$agents->image;
                    }
                   ?>

               <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                  @if( !empty( $agents ) )
                  <div class="agentAvatar summaryItem">
                     <div class="clearfix"></div>
                    
                 
                  @if( ! empty( $agents->name ) )
                     <a href="{{ route('prop.agent',[$record->slug,$record->agent_id]) }}">
                      @if( $agents->image )  
                     <img class="avatar agentAvatarImg" src="{{ $agent_image  }}" alt="avatar">
                     @else
                        <img class="avatar agentAvatarImg" src="{{PREFIX1}}uploads/space-types/1.jpg" alt="avatar">
                     @endif
                     </a>
                  @endif
                 
                     <div class="agentName">{{ $agents->name ? $agents->name : '-'}}</div>
                     <a data-toggle="modal" href="#contactAgent" class="btn btn-enquire">@lang('custom.mplocations.contact-host')</a>
                    
                  </div>
                  @endif
               </div>

               <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                  <div class="summaryItem">
                     <h1 class="pageTitle stycl" >{{ $record->company }}</h1>
                     <div class="address"><span class="icon-pointer"></span> {{ $record->property_address }}</div>
             
                   
          
                     <div class="clearfix"></div>
                     <div class="description">
                     <h3>@lang('custom.mplocations.description')</h3>
                     <p>{{ $record->description }}</p>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </div>

            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="share">
         <h3>@lang('custom.mplocations.membership-fees')</h3>
         <div class="row">
            <div class="col-md-12">
               <!-- Nav tabs -->
               <div class="card">

                  <?php
                  $space_type = \App\SpaceType::getSpaceTypes(0);
                  ?>

                  <ul class="nav nav-tabs" role="tablist">
                     
                      @foreach($space_type as $count => $space_types)
                     <li role="presentation" @if($loop->index == 0) class="active" @endif ><a href="#tab-{{$space_types->id}}" aria-controls="#tab-{{$space_types->id}}" role="tab" data-toggle="tab"><span><b>{{ $space_types->name }}</b></span></a></li>
                     @endforeach
                     
                   
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                     @foreach($space_type as $space_types)
                     
                     <div role="tabpanel" class="tab-pane @if ($loop->index == 0) active @endif" id="tab-{{$space_types->id}}">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th class="txt-center"><b> @lang('custom.mplocations.people')</b></th>
                                 <th class="txt-center"><b> @lang('custom.mplocations.duration')</b></th>
                                 <th class="txt-center"><b> @lang('custom.mplocations.price')</b></th>
                                 <th class="txt-center"><b> <!-- @lang('custom.mplocations.discounted-price') -->
                                 </b>
                               </th>
                                 <th class="txt-center"><b> @lang('custom.mplocations.avaliability')</b></th>
                              </tr>
                           </thead>
                           <tbody class="txt-center">
                            @forelse($space_types->space_type_membership_fees as $membership)
                              <?php
                              $membership_details = \App\MembershipFee::find( $membership->membership_fee_id );
                              
                              ?>
                              <tr>
                                 <td>{{$membership_details->people}}</td>
                                 <td>{{$membership_details->duration}}</td>
                                 <td>{{$membership_details->price}}</td>
                    
                             @if(Auth::check())
                             <td class="btn_PromoSz">
                            
                             </td>
                             <td><a href="javascript:void(0);" onclick="openModal('membership-fees')" class="btn btn-lg btn-enquire">@lang('custom.mplocations.claim-enquire')</a></td>
                            @else

                            <td class="togglelogin btn_PromoSz" >
                             </td>
                             <td class="togglelogin"><a href="javascript:void(0);" onclick="openExplorePage();" class="btn btn-lg btn-enquire">@lang('custom.mplocations.enquire')</a></td>

                            @endif 

                              </tr>
                              @empty
                              @endforelse
                           </tbody>
                        </table>
                     </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- opening Hours -->
      <div class="share sty-mt20">
         <h3>@lang('custom.mplocations.open-hours')</h3>
         <div class="col-md-12">
            <div class="row card">
               <div class="col-sm-3"></div>
               <div class="col-sm-6">
                  <?php
                  $days_names = [];
                  $days_collection = \App\Day::get();
                  foreach ($days_collection as $day_name) {
                     $days_names[ $day_name->id ] = $day_name->name;
                  }
                  ?>
                  <div class="business-hours">
                     <ul class="list-unstyled opening-hours">
                        <li class="sty-bbs"><b>@lang('custom.eforms.weekdays')</b><span class="pull-right" ><b>@lang('custom.listings.fields.from') &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @lang('custom.listings.fields.to')</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
                        @foreach ($record->property_timings as $property_time)
                        <li>{{$days_names[ $property_time->day_id ] }} 
                        <span class="pull-right">{{$property_time->time_from}} - {{$property_time->time_to}}
                        </span>
                        </li>
                        @endforeach
                     
                     </ul>
                  </div>
               </div>
               <div class="col-sm-3"></div>
            </div>
         </div>
      </div>
      <!-- /Opening Hours -->
      
      <div class="amenities">
         <h3>@lang('custom.mplocations.amenities')</h3>
         <div class="col-md-12">
            <div class="row card">

            @foreach ($record->property_amenities as $property_amenity)
               <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem">
                  <span class="{{ $property_amenity->icon->name }}"></span> 
                  {{ $property_amenity->name }}
               </div>
            @endforeach
            </div>

         </div>
      </div>
      <div class="comments sty-mb150">
      </div>
   </div>
   <div class="commentsFormWrapper">
      <div class="amenities">
         <div class="col-md-12 col-sm-12">
            <div class="row card row-card">
               <form class="form-inline">
                  <div class='col-xs-12 col-sm-3'>
                     <div class="form-group">
                        <div class="sty-mt30"><h5 > <b>@lang('custom.mplocations.avail')</b></h5></div>
                     </div>
                  </div>
                  <div class='col-xs-12 col-sm-3'>
                     <div class="form-group">
                        <label><b>@lang('custom.mplocations.date')</b></label>
                        <div class='input-group date' id='datepicker'>
                           <input type="text" name="enquire_date" id="enquire-date" class="form-control" placeholder="@lang('custom.invoicepdf.date')" />
                           <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                        </div>
                     </div>
                  </div>

                  <div class='col-xs-12 col-sm-3'>
                     <div class="form-group">
                        <label><b>@lang('custom.mplocations.months')</b></label>
                        <div class='input-group'>
                           <input type='number' name="enquire_month" id="enquire-month" class="form-control" min="0" placeholder="@lang('custom.eforms.enter-months')" />
                          
                        </div>
                     </div>
                  </div>

       
                  <div class='col-xs-12 col-sm-2'>
                     <div class="form-group">
                      
                        @if( Auth::check() )
                        <a href="javascript:void(0);" onclick="openModal('booknow')" class="btn btn-enquire-solid" id="book-now">@lang('custom.mplocations.book-now')</a>
                        @else
                        <li class="togglelogin"  class="sty-lstn">
                           <a href="javascript:void(0);" onclick="openExplorePage();" class="btn btn-enquire-solid" id="book-now"> @lang('custom.mplocations.book-now')</a>
                        </li>
                        @endif
                          
                     </li>
                        
                     </div>
                  </div>
               </form>
            </div>
         </div>
 
      </div>
      <!-- /booking -->
      <div class="clearfix"></div>
   </div>
   <div class="clearfix"></div>


   <div class="modal fade" id="contactAgent" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="contactLabel">@lang('custom.mplocations.contact-host')</h4>
         </div>

               <div class="alert alert-danger print-error-msg-contact sty-dn">
               <ul></ul>
               </div>


         <div class="modal-body">
            <form class="contactForm"
            role="form"
            method="POST" 
            id="contactForm"
            action = "{{ route( 'properties.send' , [$record->slug] ) }}"
            >
            @csrf
               <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cfItem">
                     <input type="text" name="name" value="{{ old('name') }}" id="contact-name" placeholder="@lang('custom.eforms.name')" class="form-control" required>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cfItem">
                     <input type="email" name="email" value="{{ old('name') }}" id="contact-email" placeholder="@lang('custom.eforms.email')" class="form-control" required>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cfItem">
                     <input type="text" name="subject" value="{{ old('subject') }}" id="contact-subject" placeholder="@lang('custom.templates.subject')" class="form-control">
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cfItem">
                     <textarea placeholder="@lang('custom.eforms.msg')" name="message" value="{{ old('message') }}" id="contact-message" rows="3" class="form-control"></textarea>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
            
            <button class="btn btn-green isThemeBtn" type="submit">@lang('custom.mplocations.send-message')</button>
            
         </div>
          <div id="loading"></div>
            </form>
      </div>


   </div>
</div>
   <!-- property review -->
   <div class="modal fade" id="propertyReview" role="dialog" aria-labelledby="propertyLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="propertyLabel">@lang('custom.mplocations.property-review')</h4>
         </div>


        <div class="alert alert-danger print-error-msg-review sty-dn">
      <ul></ul>
      </div>
         
         <div class="modal-body">
            <form class="propertyFormReview"
            role="form"
            method="POST" 
            id="propertyFormReview"
            action = "{{ route( 'properties.review') }}"
            >
            @csrf
               <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cfItem">
                  <?php
                     $rating = array(
                     '1' => 1,
                     '2' => 2,
                     '3' => 3,
                     '4' => 4,
                     '5' => 5,

                     );
                  ?>  

                  {!! Form::select('rating', $rating, old('rating'),['class' => 'select2 form-control','id'=>'review-rating','placeholder'=>'please select your rating',

                  ]) !!}
               </div>
            </div>
               <br/>
               <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cfItem">
                     <input type="text" name="name" value="{{ old('review-message') }}" id="review-name" placeholder="@lang('custom.eforms.name')" class="form-control">
                  </div>

               </div>
               <br/>
                 <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cfItem">
                     <textarea placeholder="@lang('custom.eforms.msg')" name="message" value="{{ old('review-message') }}" id="review-message" rows="3" class="form-control" required></textarea>
                  </div>
               </div>


         </div>
         <div class="modal-footer">
           
            <button class="btn btn-green isThemeBtn" type="submit">@lang('custom.mplocations.submit-review')</button>
            
         </div>
            </form>
      </div>
   </div>
</div>


@include( 'home-pages.common.login-modal' )
   <!-- end property review -->
@include( 'home-pages.common.enquire-modal' , compact('record'))


@stop
@section( 'main_two_javascripts_links' )


<script src="{{ PUBLIC_ASSETS }}js-maps/enquire.js"></script>
<script src="{{ PUBLIC_ASSETS_NEW_ADMIN }}links/bootstrap-validator/bootstrapvalidator.min.js"></script> 

<script type="text/javascript">
   function openLogin() {
      $('#redirect_url').val('{{route("properties.edit",  [ "slug" => $record->slug, "sub_space_type_id" =>$record->sub_space_type_id ] )}}')
      $('#login-modal').modal('toggle');
   }
</script>
   
<script type="text/javascript">
  $('#myTabs a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
</script>

<?php
  $loader = LOADER;
?>

<script type="text/javascript">
    $(document).ready(function() {
      "use strict";
        $(document).on('submit', '#contactForm', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            
               var _token   = $("input[name='_token']").val();
               var name     = $("#contact-name").val();
               var email    = $("#contact-email").val();
               var subject  = $("#contact-subject").val();
               var message  = $("#contact-message").val();
               var image = "{{ $loader }}"; 

               $('#loading').html("<img src='"+image+"' />");

            $.ajax({
                url: $(this).attr('action'),
                type:'POST',
                data: {_token:_token, name:name, email:email, subject:subject, message:message},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                    $('#loading').html("").hide();
                     alert(data.success);
                     location.reload();
                      
                    }else{
                      $('#loading').html("").hide();
                      printErrorMsg(data.error, 'print-error-msg-contact');

                    }
                }
            });
        }); 


      
        function printErrorMsg (msg, divclass) {
            
            $(".print-error-msg-contact").css("display", 'none');

            $("." + divclass).find("ul").html('');
            $("." + divclass).css('display','block');
            $.each( msg, function( key, value ) {
                $("." + divclass).find("ul").append('<li>'+value+'</li>');
            });
        }
    });


</script>

<!--Property review -->
<script type="text/javascript">
    $(document).ready(function() {
        "use strict";
          $(document).on('submit', '#propertyFormReview', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            
               var _token   = $("input[name='_token']").val();
               var name     = $("#review-name").val();
               var message  = $("#review-message").val();
               var rating  = $("#review-rating").val();
               

            $.ajax({
                url: $(this).attr('action'),
                type:'POST',
                data: {_token:_token, name:name, message:message,property_id: '{{$record->id}}',rating },
                success: function(data) {
                     
                    if($.isEmptyObject(data.error)){
                     alert(data.success + "-" + data.success_rating);
                   $("#propertyFormReview").trigger('reset');
                    }else{
                        printErrorMsg(data.error, 'print-error-msg-review');
                    }
                }
            });
        }); 

      
        function printErrorMsg (msg, divclass) {
            
            $(".print-error-msg-review").css("display", 'none');

            $("." + divclass).find("ul").html('');
            $("." + divclass).css('display','block');
            $.each( msg, function( key, value ) {
                $("." + divclass).find("ul").append('<li>'+value+'</li>');
            });
        }

        
    });
</script>
<!-- end review -->

<script>

     $(document).on('click', '#heart', function(e) { 
            
            var _token   = $("input[name='_token']").val();

            $.ajax({
                url: $(this).data('action'),
                type:'POST',
                data: {_token:_token, property_id: '{{$record->id}}'},
                success: function(data) {                  
                    var output = $.parseJSON( data );
                    if(output.status == 'success'){
                     $('#likes_count').html( output.count );
                    }else{
                        if(output.status == 'Error')
                           alert(output.status + "," + output.message);
                     
                    }
                }
            });
        }); 

        function openModal( from ) {
         $('#myModal').modal('toggle');
         $('#enquire_from').val( from );
        }  

</script>


 <script type="text/javascript">
   function openExplorePage() {
     $('#redirect_url').val('{{route("properties.edit",[$record->slug,$record->id])}}')
      $('#login-modal').modal('toggle');
      
   }
</script>
@endsection