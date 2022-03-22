@inject('request', 'Illuminate\Http\Request')

@extends( 'layouts.main' )

@section( 'main_head_links' )
  <link href="{{ PUBLIC_ASSETS }}css/OwlCarousel2/owl.carousel.min.css" rel="stylesheet">
  <link href="{{ PUBLIC_ASSETS }}css/OwlCarousel2/owl.theme.default.css" rel="stylesheet">
@endsection

@section( 'main_header_scripts' )
  <script src="{{ PUBLIC_ASSETS }}js/aos.js"></script>
@endsection

@section( 'content' )

<style>
    .span-search{
        color:#fff;
    }
    .sty-br{
        border-radius: 10px;
    }
    .sty-backgroundcr{
      background-color: #f2f1f1;
    }
    .sty-wh{
      color: #fff;
    }
    .sty-newcr{
      color:#c1ab77;
    }
    .st-image {
    padding: 0px !important;
    border-radius: 0px !important;
    width: 250px !important;
    margin-top: 5px !important;
    }
    .heading4-color{
        color: #40c8f4;
    }
    .pergr{
      font-size: 20px;
    }
    .pbch{
          height: 320px;
    }

  .tebb_dn{
          border: none;
        }
        .tewd_80{
          width: 80px;
        }
        .client-immg{
          max-width: 200px;
          max-height: 250px;
        }

    /*cards design css*/

    .product-card {
    width: auto;
    position: relative;
    box-shadow: 0 2px 7px #dfdfdf;
    margin: 20px auto;
    background: #fafafa;
    cursor: pointer;
  }

  .product-card:hover{
     -webkit-transform: scale(1.1);
    -ms-transition: all 300ms ease-in;
    -ms-transform: scale(1.1);
    -moz-transition: all 300ms ease-in;
    -moz-transform: scale(1.1);
    transition: all 300ms ease-in;
    transform: scale(1.1);
}


.product-tumb {
    display: flex;
    align-items: center;
    justify-content: center;
    height: auto;
    padding: 10px;
    background: #f0f0f0;
}

.product-tumb img {
    max-width: 100%;
    height: 160px;
}

.product-details {
    padding: 15px;
}

.product-catagory {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #ccc;
    margin-bottom: 18px;
}

.product-details h4 {
    font-weight: 500;
    display: block;
    margin-bottom: 18px;
    text-transform: uppercase;
    color: #40c8f4;
    text-decoration: none;
    transition: 0.3s;
}

.product-details h4:hover {
    color: #363636;
}

.product-details p {
    font-size: 15px;
    line-height: 22px;
    margin-bottom: 18px;
    color: #333;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 6;
    -webkit-box-orient: vertical;
    text-align: justify;
}

.product-bottom-details {
    overflow: hidden;
}

.product-bottom-details div {
    float: left;
    width: 100%;
}

.product-price {
    font-size: 18px;
    color: #fbb72c;
    font-weight: 600;
}

.product-price small {
    font-size: 80%;
    font-weight: 400;
    text-decoration: line-through;
    display: inline-block;
    margin-right: 5px;
}
/*end cards design*/


/*amenities*/

/* Main Section Code Below */
div#services {
    background: #f7f6f6;
    text-align: center;
    font-family: 'Metal Mania';
    padding: 25px;
    overflow: hidden;
}
.ServiceInner h2 {
    font-size: 35px;
    color: #000000;
}

.ServiceInner p {
    font-size: 25px;
    padding: 20px;
    color: #313d4a;
    margin-bottom: 20px;
}

div#serviceMainBlock {text-align: center;margin: auto;display: inline-flex;}

.ServiceBox {
    float: left;
    display: inline-block;
}
/* Graphic */
.ServiceBox.graphic i {
    color: white;
    background: #40c8f4;
    text-align: center;
    border-radius: 50%;
    padding: 18px;
    margin: 15px;
}

.ServiceBox.graphic {
    background: white;
    padding: 10px 10px;
    border-radius: 20px;
    width: 180px;
    margin-bottom: 20px;
}

.ServiceBox.graphic h4 {
    color: #40c8f4;
}
.ServiceBox.graphic:hover{
    box-shadow: -3px 3px 6px #40c8f4;
    cursor: pointer;
}
.ServiceBox {
    box-shadow: 4px 4px 10px #afafaf;
    transition-duration: 0.6s;
}

.ServiceBox .fa {
    font-size: 30px;
}

/*car start*/

.owl-dots{
  text-align: center;
}

.owl-dot {
  display: inline-block;
  height: 15px !important;
  width: 15px !important;
  background-color: #222222 !important;
  opacity: 0.8;
  border-radius: 50%;
  margin: 0 5px;
}

.owl-dot.active {
  background-color: #FF170F !important;
}
/*car end*/
</style>

   <?php
        $home_hero_bgimage = getSetting('home_hero_bgimage','home-page-settings');
         $default_bgimg = getDefaultimgagepath('','settings',$home_hero_bgimage);
        $hero_header_heading = getSetting('hero_header_heading','home-page-settings');
        $hero_header_heading_caption = getSetting('hero_header_heading_caption','home-page-settings');
        $home_page_section_container = getSetting('home_page_section_container','home-page-settings');
        $home_page_section_container_caption = getSetting('home_page_section_container_caption','home-page-settings');

        $home_page_section_container_card_one_heading = getSetting('home_page_section_container_card_one_heading','home-page-settings');
        $home_page_section_container_card_two_heading = getSetting('home_page_section_container_card_two_heading','home-page-settings');
        $home_page_section_container_card_three_heading = getSetting('home_page_section_container_card_three_heading','home-page-settings');
        $home_page_section_container_card_four_heading = getSetting('home_page_section_container_card_four_heading','home-page-settings');

        $home_page_section_container_card_one = getSetting('home_page_section_container_card_one','home-page-settings');
        $home_page_section_container_card_two = getSetting('home_page_section_container_card_two','home-page-settings');
        $home_page_section_container_card_three = getSetting('home_page_section_container_card_three','home-page-settings');
        $home_page_section_container_card_four = getSetting('home_page_section_container_card_four','home-page-settings');

        $home_hero_ourclients_bgimage = getSetting('home_hero_ourclients_bgimage','home-page-settings');

      ?>

   <main class="main">

            <div class="home-hero home home-bnere inblk" style="background-image: url({{$default_bgimg}});">


    <div class="home-hero__wrap home--height">

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">

<div class="serch-sle">
                    <h2 class="home-hero__title">{{ $hero_header_heading }}</h2>
                    <p class="home-hero__subtitle">{{ $hero_header_heading_caption }}</p>
              <form class="home-hero__form" action="{{ route('properties.list') }}">

                        <div class="home-hero__input-wrap">
                            <input class="home-hero__input" name="location" id="search" type="text"  placeholder="@lang('others.search-by')" autocomplete="off" onclick="initialize_top('search')">
                        </div>
                        @php
                          $items = \App\SpaceType::getSpaceTypes(0);
                        @endphp
                        <div class="visible-lg visible-md ">
                          <select class="form-control minimal" id="sel1" name="wstype">

                            @foreach( $items as $item )
                            <option value="{{$item->id}}">{{ $item->name }}</option>
                            @endforeach

                          </select>
                        </div>


                        <button class="btn btn--orange search" type="submit">
                            <span class="fa fa-search" id="span-search"></span>
                        </button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="why-choose">
<div class="container">
<div class="row">

<div class="col-lg-12">
<h1 class="heding">{{ $home_page_section_container }}</h1>
<p class="pergr"> {{ $home_page_section_container_caption }}</p>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="panel panel-default">
  <div class="panel-body pbch">
  <img src="{{ PUBLIC_ASSETS }}images/icon1.png" alt="{{getSetting('site_title','site_settings')}}">
    <h3>{{ $home_page_section_container_card_one_heading }}</h3>
    <p>{{ $home_page_section_container_card_one }}</p>
  </div>
</div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="panel panel-default">
  <div class="panel-body pbch">
  <img src="{{ PUBLIC_ASSETS }}images/icon2.png" alt="{{getSetting('site_title','site_settings')}}">
    <h3>{{ $home_page_section_container_card_two_heading }}</h3>
    <p>{{ $home_page_section_container_card_two }}</p>
  </div>
</div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="panel panel-default">
  <div class="panel-body pbch">
  <img src="{{ PUBLIC_ASSETS }}images/icon3.png" alt="{{getSetting('site_title','site_settings')}}">
    <h3>{{ $home_page_section_container_card_three_heading }}</h3>
    <p>{{ $home_page_section_container_card_three }}</p>
  </div>
</div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="panel panel-default">
  <div class="panel-body pbch">
  <img src="{{ PUBLIC_ASSETS }}images/icon4.png" alt="{{getSetting('site_title','site_settings')}}">
    <h3>{{ $home_page_section_container_card_four_heading }}</h3>
    <p>{{ $home_page_section_container_card_four }}</p>
  </div>
</div>
</div>

</div>
</div>
</section>


    <?php
          $home_page_our_workspaces_heading = getSetting('home_page_our_workspaces_heading','home-page-settings');
          $home_page_our_workspaces_caption = getSetting('home_page_our_workspaces_caption','home-page-settings');
          $home_page_amenities_heading = getSetting('home_page_amenities_heading','home-page-settings');
          $home_page_amenities_caption = getSetting('home_page_amenities_caption','home-page-settings');
          $our_clients_heading = getSetting('our_clients_heading','home-page-settings');
          $our_clients_caption = getSetting('our_clients_caption','home-page-settings');

           if( $home_hero_ourclients_bgimage && file_exists(public_path("/uploads/settings/".$home_hero_ourclients_bgimage)))
          {
              $default_workspace_path = IMAGE_PATH_SETTINGS.$home_hero_ourclients_bgimage;
          }else{
              $default_workspace_path = PUBLIC_ASSETS."images/default-imgs/wokspacesbg-img.jpg";
          }

    ?>

    <!-- new cards -->
    <section class="Workspaces section-New " style="background-image: url({{$default_workspace_path}}) ;background-repeat: no-repeat;background-position: center; background-size: cover;">

<div class="container">
<div class="row">
<div class="col-md-12">
<h1 class="heding">{{ $home_page_our_workspaces_heading }}</h1>
<p class="pergr">{{ $home_page_our_workspaces_caption }}</p>
</div>

<div class="row">
  @foreach( $items as $item )
  @php
    $sub_space_types = \App\SpaceType::getSpaceTypes($item->id);
  @endphp
@foreach( $sub_space_types as $sub_space_type )
  <div class="col-sm-4 col-xs-12">
     @php
      $image = $sub_space_type->image;
      $default_path = getDefaultimgagepath($image,'space-types','');
    @endphp
<div class="product-card">
    <div class="product-tumb">
      <img src="{{ $default_path }}" alt="">
    </div>
    <div class="product-details">
      <h4><b>{{ $sub_space_type->name }}</b></h4>
      <p title="{{$sub_space_type->des_one}}">{{ $sub_space_type->des_one }}</p>
      <div class="product-bottom-details">
        <div class="product-price">
      <?php
        $space_sub_loc = "location=&wstype=".$item->id."&subtype=".$sub_space_type->id;
      ?>
          <a href="{{ route('properties.list',$space_sub_loc) }}" class="btn btn-primary">@lang('custom.mplocations.explore')</a>
      </div>
    </div>
  </div>
</div>
</div>
@endforeach
@endforeach


</div>
</div>


</section>
    <!-- end new cards  -->




<section class="why-choose amenities">
  <?php
      $amenities = \App\Amenity::get();
  ?>
<div class="container">
<div class="row">
<div class="col-lg-12">
  <h1 class="heding">{{ $home_page_amenities_heading }}</h1>
  <p class="pergr">{{ $home_page_amenities_caption }}
</p>
</div>
<div class="col-md-12">
<div class="row">
  @foreach( $amenities as $amenity )
    <div class="col-md-2 col-sm-4 col-xs-12">
        <div id="serviceMainBlock">
          <div class="ServiceBox graphic">
            <i class="{{ $amenity->icon->name }}" aria-hidden="true"></i>
            <h4> {{ $amenity->name ?? ''}} </h4>
          </div>
        </div>
      </div>
  @endforeach
</div>
</div>
</div>
</div>
</section>

 @php
   $testimonials = \App\Testimonial::get();
   $our_clients = \App\OurClient::get();
  @endphp

<!-- logo carousal -->

@if($our_clients)
<section class="home-section home-section__test clients"  id="testimonial" style="background-image: url({{IMAGE_PATH_SETTINGS.$home_hero_ourclients_bgimage}}) ;background-repeat: no-repeat;background-position: center; background-size: cover;">
<div class="container" >
<div class="row">
<div class="col-lg-12">
<h1 class="heding"> {{ $our_clients_heading }} </h1>
<p class="pergr">  {{ $our_clients_caption }} </p>
</div>
<div class="col-lg-12 col-xl-12">
  <!-- car -->

  <div class="brand-carousel section-padding owl-carousel">
     @foreach($our_clients as $value)
    	@php
          $our_client_image = $value->image;
        @endphp
  <div class="single-logo">
     <img src="{{ getDefaultimgagepath($our_client_image,'ourclients','') }}"  alt="">
  </div>
 @endforeach
</div>
  <!-- end car -->

</div>

</div>
</div>
</section>
@endif
<!-- end logo carousal -->



<!-- testimonial start New-->
@if($testimonials)

<div class="tesimonils">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <section id="testim" class="testim">
                    <div class="wrap">
                        <span id="right-arrow" class="arrow right fa fa-chevron-right">
                        </span>
                        <span id="left-arrow" class="arrow left fa fa-chevron-left ">
                        </span>
                        <ul id="testim-dots" class="dots">
                          @foreach( $testimonials as $testimonial )

                            <li class="dot active">
                            </li>
                         @endforeach
                        </ul>
                        <div id="testim-content" class="cont">
                          @foreach( $testimonials as $testimonial )
                            <div class="active">
                                <?php
                                  $testimonial_image = $testimonial->image;
                                  if( $testimonial_image && file_exists(public_path("/uploads/testimonials/".$testimonial_image)))
                                  {
                                  $default_path = UPLOADS."testimonials/".$testimonial_image;
                                  }else{
                                  $default_path = PUBLIC_ASSETS."images/default-imgs/1.jpg";
                                  }

                               ?>
                                 
                                  <img src="{{ $default_path }}" class="client-immg" alt="">
                                  
                                <h2>
                                   {{ $testimonial->name ? $testimonial->name : '' }}
                                </h2>
                                <p>
                                    {!! $testimonial->description ? $testimonial->description : ''!!}
                                </p>
                            </div>
                             @endforeach
                        </div>

                    </div>

                </section>
            </div>
        </div>
    </div>
</div>
@endif
<!-- testimonial start end-->
</main>

<!-- footer -->
@include ( 'partials.footer' )
<!-- end footer -->

 @include( 'home-pages.common.validate-email-mobile' )
@stop



@section( 'main_javascripts' )
<script src="{{PUBLIC_ASSETS}}js/OwlCarousel2/owl.carousel.min.js"></script>
<style type="text/css">
  .inblk {
    display: inline-block;
  }
</style>

<script>
    // vars
'use strict'
var testim = document.getElementById("testim"),
    testimDots = Array.prototype.slice.call(document.getElementById("testim-dots").children),
    testimContent = Array.prototype.slice.call(document.getElementById("testim-content").children),
    testimLeftArrow = document.getElementById("left-arrow"),
    testimRightArrow = document.getElementById("right-arrow"),
    testimSpeed = 4500,
    currentSlide = 0,
    currentActive = 0,
    testimTimer,
        touchStartPos,
        touchEndPos,
        touchPosDiff,
        ignoreTouch = 30;
;

window.onload = function() {

    // Testim Script
    function playSlide(slide) {
        for (var k = 0; k < testimDots.length; k++) {
            testimContent[k].classList.remove("active");
            testimContent[k].classList.remove("inactive");
            testimDots[k].classList.remove("active");
        }

        if (slide < 0) {
            slide = currentSlide = testimContent.length-1;
        }

        if (slide > testimContent.length - 1) {
            slide = currentSlide = 0;
        }

        if (currentActive != currentSlide) {
            testimContent[currentActive].classList.add("inactive");
        }
        testimContent[slide].classList.add("active");
        testimDots[slide].classList.add("active");

        currentActive = currentSlide;

        clearTimeout(testimTimer);
        testimTimer = setTimeout(function() {
            playSlide(currentSlide += 1);
        }, testimSpeed)
    }

    testimLeftArrow.addEventListener("click", function() {
        playSlide(currentSlide -= 1);
    })

    testimRightArrow.addEventListener("click", function() {
        playSlide(currentSlide += 1);
    })

    for (var l = 0; l < testimDots.length; l++) {
        testimDots[l].addEventListener("click", function() {
            playSlide(currentSlide = testimDots.indexOf(this));
        })
    }

    playSlide(currentSlide);

    // keyboard shortcuts
    document.addEventListener("keyup", function(e) {
        switch (e.keyCode) {
            case 37:
                testimLeftArrow.click();
                break;

            case 39:
                testimRightArrow.click();
                break;

            case 39:
                testimRightArrow.click();
                break;

            default:
                break;
        }
    })

        testim.addEventListener("touchstart", function(e) {
                touchStartPos = e.changedTouches[0].clientX;
        })

        testim.addEventListener("touchend", function(e) {
                touchEndPos = e.changedTouches[0].clientX;

                touchPosDiff = touchStartPos - touchEndPos;

                console.log(touchPosDiff);
                console.log(touchStartPos);
                console.log(touchEndPos);


                if (touchPosDiff > 0 + ignoreTouch) {
                        testimLeftArrow.click();
                } else if (touchPosDiff < 0 - ignoreTouch) {
                        testimRightArrow.click();
                } else {
                    return;
                }

        })
}
</script>
<script>
$(document).ready(function(){
      "use strict";

        $('.items').slick({
        dots: true,
        infinite: true,
        speed: 800,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
        },
        {
          breakpoint: 600,
          settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
        },
        {
          breakpoint: 480,
          settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
        }

        ]
        });
        });

</script>
<!-- /testimonial -->

<script>
  $('.brand-carousel').owlCarousel({
  loop:true,
  margin:10,
  autoplay:true,
  responsive:{
    0:{
      items:1
    },
    600:{
      items:3
    },
    1000:{
      items:5
    }
  }
})
</script>

@include('home-pages.common.initializetop')

@endsection
