@extends( 'layouts.home_page_agent_layout' )
@include( 'home-pages.common.head-links' )

@section( 'content_two' )

<style>
  .sty-w85{
   float:right !important; width: 50% !important;overflow-y:hidden;height:700px !important;
  }
  .sty-ww{
    float:left !important; width: 50% !important; overflow-y:scroll !important; overflow: visible; height: 600px !important;
  }
  .sty-color{
   display:none;
  }
  .sty-color1{
    color: #c1ab77;
  }
  .sty-color2{
    color:#011935;
  }
  .sty-h500{
    height: 500px !important;
  }
  .sty-red{
    color:red;
  }
  .no-touch .figure img{
    height: 33%;
  }

  .btn-bookspace {
    background: #fff;
    border: .2rem solid #40c8f4;
    color: #40c8f4;
    font-size: 17px;
    font-weight: bold;
    padding: 0.6rem 1.6rem;
    border-radius: 5px;
    margin-top: 37px;
  }
 @media (max-width: 640px){
    .price-size {
    font-size: 14px;
    font-weight: 600;
    line-height: 1.3;
}
.btn-bookspace {
    background: #fff;
    border: .2rem solid #40c8f4;
    color: #40c8f4;
    font-size: 17px;
    font-weight: bold;
    padding: 0.6rem 1.6rem;
    border-radius: 5px;
    margin-top: 57px;
}
.figType {
    background-color: #011935;
    font-size: 10px;
    line-height: 11px;
    color: #fff;
    padding: 5px 16px;
    border-radius: 2px;
    position: absolute;
    right: 10px;
    bottom: 0px;
    /* text-transform: uppercase; */
    z-index: 3;
    opacity: .8;
}
  }
</style>

<div id="content" class="mob-max sty-w85">
   <div class="singleTop whiteBg">
      <div class="row mb20">
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pb20">
            <div class="row">
               <div class="col-xs-3">
                  <div class="pc-email sty-color"><a href="#" class="btn btn-icon btn-round btn-o btn-magenta btn-sm"><span class="fa fa-envelope-o"></span></a></div>
               </div>
               <div class="col-xs-6">

                     <?php
                     $agents = \App\User::find($record->agent_id);

                     $agent_image = IMAGE_PATH_UPLOAD_USERS.$agents->image;

                     ?>

                  <div class="profile-card">
                     <div class="pc-avatar">
                      @if( $agents->image )
                      <img src="{{ $agent_image }}" alt="avatar" class="agent-im-height">
                      @else
                      <img src="{{ url(PUBLIC_ASSETS . 'images/default-imgs/1.jpg') }}" class="agent-im-height">
                      @endif

                    </div>
                     <div class="pc-name">{{ $agents ? $agents->name : '-' }}</div>
                  </div>
               </div>
               <div class="col-xs-3">
                  <div class="pc-fav sty-color" ><a href="#" class="btn btn-icon btn-round btn-o btn-red btn-sm"><span class="fa fa-heart-o"></span></a></div>
               </div>
            </div>

            <div class="clearfix"></div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pb20">
            <div class="pc-title osLight">@lang('custom.profile.contact-info')</div>

            <div class="row pb10">
               <div class="col-xs-4"><strong>@lang('custom.profile.mobile')</strong></div>
               <div class="col-xs-8 align-center">{{ $agents ? $agents->mobile : '-' }}</div>
            </div>
            <div class="row pb10">
               <div class="col-xs-4"><strong>@lang('custom.profile.email')</strong></div>
               <div class="col-xs-8 align-center"><a href="mailto:#" class="text-green isThemeText">{{ $agents ? $agents->email : '-' }}</a></div>
            </div>


         </div>
      </div>
      <div class="row sty-h500">
         <div class="col-md-6 pb20">
            <div class="pc-about osLight">@lang('custom.profile.about-me')</div>
            <div class="pb20">{{ $agents ? $agents->description : '-' }}</div>

         </div>
         <div class="col-md-6">
            <div class="pc-title osLight">@lang('custom.profile.send-me-a-message')</div>
            <form class="contactForm"
            role="form"
            method="POST"
            id="contactForm"
            action = "{{ route( 'properties.send' , [$record->slug] ) }}"
            >
               <div class="alert alert-danger print-error-msg-contact sty-color" >
               <ul></ul>
               </div>

               <div class="form-group">
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="contact-name" placeholder="@lang('custom.eforms.name')" required>
               </div>
               <div class="form-group">
                  <input type="email" class="form-control" value="{{ old('email') }}" id="contact-email"  placeholder="@lang('custom.eforms.email')" required>
               </div>
                <div class="form-group">
                  <input type="text" class="form-control" value="{{ old('subject') }}" id="contact-subject"  placeholder="@lang('custom.templates.subject')">
               </div>
               <div class="form-group">
                  <textarea class="form-control" name="message" value="{{ old('message') }}" id="contact-message"  rows="3" placeholder="@lang('custom.templates.type-message')"></textarea>
               </div>
               <button class="btn btn-green isThemeBtn" type="submit"> @lang('custom.profile.send-message')</button>
               <div id="loading"></div>

       </form>
         </div>
      </div>
   </div>
  </div>


  <div id="content" class="mob-max sty-ww">
     <div class="singleTop whiteBg">
      <div class="row mb20">
      <h3> @lang('custom.profile.properties-under') <span class="sty-red" >{{ $agents ? $agents->name : '-' }}</span></h3>

         <?php
         $agent_properties = \App\Property::where('agent_id',$record->agent_id)->paginate(AGENT_PROPERTIES_PER_PAGE);
         ?>


         @if( count($agent_properties) > 0 )



        @foreach( $agent_properties as $agent_property )
        <?php
         $property_sub_space_types = $agent_property->property_sub_space_types;
         $cover_image = $agent_property->cover_image;

            $price_per_day = 'NA';
            $price_per_month = 'NA';
            if ( ! empty( $property_sub_space_types ) ) {
            foreach( $property_sub_space_types as $details ) {
            if ( 'NA' === $price_per_day && ! empty( $details->price_per_day ) ) {
            $price_per_day = $details->price_per_day;
            break; // Let us take first value as default.
            }
            }
            }

            //price per month

             if ( ! empty( $property_sub_space_types ) ) {
            foreach( $property_sub_space_types as $details ) {
            if ( 'NA' === $price_per_month && ! empty( $details->price_per_month ) ) {
            $price_per_month = $details->price_per_month;
            break; // Let us take first value as default.
            }
            }
            }

        ?>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <a href="{{ route('properties.edit',[$agent_property->slug,$agent_property->id]) }}" class="card">
               <div class="figure">

                  @if( $cover_image )
                  <img src="{{ url( $cover_image ) }}" alt="image">
                  @else
                  <img src="{{ url(PUBLIC_ASSETS . 'images/default-imgs/1.jpg') }}" alt="image">
                  @endif

                  <div class="figType">
                     <i class="fa fa-inr"></i>
                     <span class="price-size">{{ $price_per_month }} /month</span>
                  </div>
               </div>
               <h2 class="sty-color2">{{ $agent_property->company }}</h2>
               <div class="cardAddress"><span class="icon-pointer"></span> {{ $agent_property->property_address }}</div>

          
               <ul class="cardFeat">
                  <li><span class="fa fa-check-circle sty-color1"></span> @lang('custom.profile.verified')</li>
               </ul>
               <ul class="cardFeat-right">
                  <li><button class="btn btn-bookspace" id="">
                     <span class="booking">@lang('custom.profile.book')</span><br><b>@lang('custom.profile.space')</b>
                     </button>
                  </li>
               </ul>
               <div class="clearfix"></div>
            </a>
         </div>

       @endforeach

      <ul class="pagination">
         {{ $agent_properties->links() }}

      </ul>
   </div>

               @else
               <h4 >@lang('custom.profile.no-properties-are-avaliable')</h4>
               @endif

</div>
</div>
</div>

<script src="{{ PUBLIC_ASSETS }}js/jquery/3.4.1/jquery.min.js"></script>
<?php
  $loader = LOADER;
?>
 <script type="text/javascript">
    $(document).ready(function() {
      "use strict";

        $('#contactForm').submit(function( e ) {
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

@stop