@extends( 'layouts.main' )

 @section( 'main_header_styles' )
 <style>
   .expertise-margin{
      margin-top:-118px;
   }
   .card-margin{
      margin-top:-50px; 
   }
   .sty-h420{
      height:420px;
   }
  
   select{
    cursor:pointer;
   }
   .sty-17{
    margin-left: -17px;
   }
   .pd_50{
       padding: 10px 95px;
   }
   @media (min-width: 360px) and (max-width: 991px) { 
			   	.respd_50{
			       padding: 10px 120px;
			   }
    }

     @media (min-width: 360px) and (max-width: 480px) { 
				.respd_50 {
				    padding: 1px 44px;
				}
			  .pd_50{
		       padding: 2px 10px;
		      }
    }

 </style>
 @endsection

@section( 'content' )
<?php
   $home_hero_bgimage = getSetting('home_hero_bgimage','home-page-settings');
?>
<main class="main">
   <div class="home-hero__wrap home--height" style="background-image: url({{IMAGE_PATH_SETTINGS.$home_hero_bgimage}}); height:20em;" >
    
   <div class="home-hero__overlay"></div>
         <div class="container">
            <div class="row">
            <div class="col-md-12 col-sm-12">
                  <h1 class="home-hero__title">@lang('custom.postrequirement.title')</h2>
               </div>
            </div>
         </div>
      </div>
   <!-- about -->
  
   <!-- /about -->        
<div class="col-lg-9 col-md-8 col-xs-12">
<div class="panel-body">
 
   @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
  @endif

   @if(session('success_message'))
        <div class="alert alert-success">
          {{ session('success_message') }}
        </div>    
    @endif

   <form action="{{ route('main_page.post-requirement') }}" method="post" name="postRequirementForm" class="postrequirementform pl110" id="post_req_form">
      @csrf
      <div class="row pd_50">
            <div class="col-md-6 col-xs-12">

            <div class="form-group">
              <label for="pr_name">@lang('custom.postrequirement.name')</label>
              <input type="text" class="form-control" name="pr_name" id="pr_name" placeholder="@lang('custom.postrequirement.name')" required>
            </div>
            </div>

            <div class="col-md-6 col-xs-12">
            <div class="form-group">
              <label for="pr_email">@lang('custom.postrequirement.email')</label>
              <input type="email" class="form-control" id="pr_email" name="pr_email" placeholder="@lang('custom.postrequirement.email')" required>
            </div>
             </div>
         
          <div class="col-md-6 col-xs-12">
            <div class="form-group">
              <label for="pr_code">@lang('custom.postrequirement.pr_code')</label>
              <input type="text" class="form-control" name="pr_code" id="pr_code" placeholder="@lang('custom.postrequirement.pr_code')" required>
            </div>
          </div>

            <div class="col-md-6 col-xs-12">

            <div class="form-group">
              <label for="pr_number">@lang('custom.postrequirement.pr_number')</label>
              <input type="number" class="form-control" name="pr_number" id="pr_number" placeholder="@lang('custom.postrequirement.pr_number')" required>
            </div>
            </div>



              <div class="col-md-6 col-xs-12">
               <div class="form-group">
                 <label for="pr_persons">@lang('custom.postrequirement.no_of_persons')</label>
                 <input type="text" class="form-control" name="pr_persons" id="pr_persons" placeholder="@lang('custom.postrequirement.no_of_persons')" required>
               </div>
              </div>


              <div class="col-md-6 col-xs-12">
               <div class="form-group">
                 <label for="pr_company">@lang('custom.postrequirement.company')</label>
                 <input type="text" class="form-control" id="pr_company" name="pr_company" placeholder="@lang('custom.postrequirement.company')">
               </div>
              </div>

               <div class="col-md-6 col-xs-12">
               <div class="form-group">
                 <label for="pr_city">@lang('custom.postrequirement.enter_city')</label>
                 <input type="text" class="form-control" name="pr_city" id="pr_city" placeholder="@lang('custom.postrequirement.enter_city')">
               </div>
            </div>


              <div class="col-md-6 col-xs-12">
               <div class="form-group">
                 <label for="pr_startdate">@lang('custom.postrequirement.start_date') </label>
                <select id="pr_startdate" name="pr_startdate" class="form-control" required>
                      <option value="" disabled selected>@lang('custom.postrequirement.please_select')</option>
                      <option value="Within 1 week">@lang('custom.postrequirement.with_in_one_week')</option>
                      <option value="Within 1 month">@lang('custom.postrequirement.with_in_one_month')</option>
                      <option value="Within 3 months">@lang('custom.postrequirement.with_in_three_months')</option>
                      <option value="Between 3-6 months">@lang('custom.postrequirement.between_three_six')</option>
                      <option value="More than 6 months">@lang('custom.postrequirement.more_than_six_months')</option>
                      <option value="Not Sure">@lang('custom.postrequirement.not_sure')</option>
                    </select>
                  </div>
               </div>



             <div class="col-md-6 col-xs-12">
               <div class="form-group">
                <label for="pr_prefferedtime">@lang('custom.postrequirement.preffered_time_to_connect') </label>
                <select id="pr_prefferedtime" name="pr_prefferedtime" class="form-control">
                      <option value="" disabled selected>@lang('custom.postrequirement.please_select')</option>
                      <option value="9:00 - 12:00">@lang('custom.postrequirement.nine_twelve')</option>
                      <option value="12:00 - 4:00">@lang('custom.postrequirement.twelve_four')</option>
                      <option value="4:00 - 8:00">@lang('custom.postrequirement.four_eight')</option>
                      <option value="After 8:00">@lang('custom.postrequirement.after_eight')</option>
                    </select>
                  </div>
             </div>


             <div class="col-md-6 col-xs-12">
               <div class="form-group">
                 <label for="pr_prefferedconnect">@lang('custom.postrequirement.preffered_mode_to_connect')</label>
                <select id="pr_prefferedconnect" name="pr_prefferedconnect" class="form-control">
                      <option value="" disabled selected>@lang('custom.postrequirement.please_select')</option>
                      <option value="Watsapp">@lang('custom.postrequirement.connect_whatsapp')</option>
                      <option value="Email">@lang('custom.postrequirement.connect_email')</option>
                      <option value="Call">@lang('custom.postrequirement.connect_call')</option>
                    </select>
                  </div>
             </div>

             <div class="col-md-6 col-xs-12">
                <div class="form-group">
                   <label for="pr_information">@lang('custom.postrequirement.from_where')</label>
                    <select id="pr_information" name="pr_information" class="form-control">
                          <option value="" disabled selected>@lang('custom.postrequirement.preffered_mode_to_connect')</option>
                          <option value="Facebook">@lang('custom.postrequirement.facebook')</option>
                          <option value="Google">@lang('custom.postrequirement.google')</option>
                        </select>
                      </div>
             </div>

              @php
                    $items = \App\SpaceType::getSpaceTypes(0);
              @endphp
                               

              <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                    <label for="pr_spacetypes">@lang('custom.postrequirement.select_workspace_type')</label>
                      <select id="pr_spacetypes" name="pr_spacetypes" class="form-control">
                             <option value="" disabled selected>@lang('custom.postrequirement.please_select')</option>
                             @foreach( $items as $item )
                              <option value="{{$item->id}}">{{ $item->name }}</option>
                             @endforeach
                          </select>
                        </div>
                  </div>  



           <div class="col-md-12 col-xs-12">
            <div class="form-group">
              <label for="pr_message">@lang('custom.postrequirement.your_message')</label>
              <textarea id="pr_message" name="pr_message" class="form-control"></textarea>
            </div>
             </div>


        <div class="col-md-4 col-xs-12">
        <div class="form-group">
        <input type="submit" value="Submit" class="btn btn-primary btn-lg btn-block">
        </div>
        </div>
      </div>
  </form>
 
</div>
</div>
<?php
   $country_code = getSetting('country_code','site_settings');
   $site_phone = getSetting('site_phone','site_settings');
   $contact_email = getSetting('contact_email','site_settings');
   $skype_email = getSetting('skype_email','site_settings');
   $whatsapp = getSetting('whatsapp','site_settings');   
?>
     <div class="col-lg-3 col-md-4 col-xs-12">
      <div class="panel-body respd_50">
			      
			<div class="form-group">
			 <label><i class="fa fa-envelope-o" aria-hidden="true"></i>  @lang('custom.postrequirement.contact_email')</label>
			 <p>{{ $contact_email }}</p>
			</div>

			<div class="form-group">
			<label><i class="fa fa-phone" aria-hidden="true"></i> @lang('custom.postrequirement.contact_no')</label>
			 <p>{{ $country_code }} {{ $site_phone }}</p>
			</div>

			<div class="form-group">
			 <label><i class="fa fa-skype" aria-hidden="true"></i> @lang('custom.postrequirement.skype_email')</label>
			 <p>{{ $skype_email }}</p>
			</div>

			<div class="form-group">
			<label><i class="fa fa-whatsapp" aria-hidden="true"></i> @lang('custom.postrequirement.contact_whatsapp_no')</label>
			 <p>{{ $country_code }} {{ $whatsapp }}</p>
			</div>
      <?php
        $facebook_link = getSetting('facebook_link','post-requirement-settings');
        $twitter_link = getSetting('twitter_link','post-requirement-settings');
      ?>
			<div class="form-group">
			<label><i class="fa fa-envelope-o" aria-hidden="true"></i>   @lang('custom.postrequirement.social_media')</label>
			<a href="{{$facebook_link}}" class="btn btn-primary btn-lg btn-block" target="_blank">@lang('custom.postrequirement.setting_facebook')</a>
			<a href="{{$twitter_link}}" class="btn btn-primary btn-lg btn-block" target="_blank">@lang('custom.postrequirement.setting_twitter')</a>
			</div>


	</div>
 </div>
</div>
			      
     
 
</main>

<!-- footer -->
@include ( 'partials.footer' )
<!-- end footer -->
      
@stop