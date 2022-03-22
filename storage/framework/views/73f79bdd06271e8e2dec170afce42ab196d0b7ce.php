    <script type="text/javascript" src="<?php echo e(PUBLIC_ASSETS); ?>js/markerclusterer.js"></script>
    
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery-ui.min.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery-ui-touch-punch.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.cookie.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.placeholder.js"></script>

      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.touchSwipe.min.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.slimscroll.min.js"></script>

      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.tagsinput.min.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js/bootstrap-datepicker.js"></script>    

<style>
.sty-oht{
    overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
}
</style>

<script type="text/javascript">
var map;
var markerClusterer = null;
var geocoder;
var props;
var addMarkers = null;

jQuery( document ).ready(function( $ ) {

var bounds = new google.maps.LatLngBounds();
var windowHeight;
var windowWidth;
var contentHeight;
var contentWidth;
var isDevice = true;

    // calculations for elements that changes size on window resize
    var windowResizeHandler = function() {
        windowHeight = window.innerHeight;
        windowWidth = $(window).width();
        contentHeight = windowHeight - $('#header').height();
        contentWidth = $('#content').width();

        $('#leftSide').height(contentHeight);
        $('.closeLeftSide').height(contentHeight);
        $('#wrapper').height(contentHeight);
        $('#mapView').height(contentHeight);
        $('#content').height(contentHeight);
        setTimeout(function() {
            $('.commentsFormWrapper').width(contentWidth);
        }, 300);

        if (map) {
            google.maps.event.trigger(map, 'resize');
        }

        // Add custom scrollbar for left side navigation
        if(windowWidth > 767) {
            $('.bigNav').slimScroll({
                height : contentHeight - $('.leftUserWraper').height()
            });
        } else {
            $('.bigNav').slimScroll({
                height : contentHeight
            });
        }

        if($('.bigNav').parent('.slimScrollDiv').length > 0) {
            $('.bigNav').parent().replaceWith($('.bigNav'));
            if(windowWidth > 767) {
                $('.bigNav').slimScroll({
                    height : contentHeight - $('.leftUserWraper').height()
                });
            } else {
                $('.bigNav').slimScroll({
                    height : contentHeight
                });
            }
        }

        setTimeout(function() {
        // reposition of prices and area reange sliders tooltip
        var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
        var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
        var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
        $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);

        var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
        var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
        var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
        $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);
        }, 300);
    }

    windowResizeHandler();

    if($.cookie("css")) {
        $("#app").attr("href",$.cookie("css"));
    }
    var themeColorPath = $("#app").attr("href");
    var themeColorFile = themeColorPath.replace("css/app-", "");
    var themeColor = themeColorFile.replace(".css", "");
    var markerImg = "marker-green.png";

    switch(themeColor) {
        case "red":
            markerImg = "marker-red.png";
            break;
        case "blue":
            markerImg = "marker-blue.png";
            break;
        case "magenta":
            markerImg = "marker-magenta.png";
            break;
        case "yellow":
            markerImg = "marker-yellow.png";
            break;
    }

    // Custom options for map
    var options = {
            zoom : 2,
            mapTypeId : google.maps.MapTypeId.ROADMAP,

            gestureHandling: 'greedy'
        };
    var styles = [{
        stylers : [ {
            hue : "#cccccc"
        }, {
            saturation : -100
        }]
    }, {
        featureType : "road",
        elementType : "geometry",
        stylers : [ {
            lightness : 100
        }, {
            visibility : "simplified"
        }]
    }, {
        featureType : "road",
        elementType : "labels",
        stylers : [ {
            visibility : "on"
        }]
    }, {
        featureType: "poi",
        stylers: [ {
            visibility: "off"
        }]
    }];

    var newMarker = null;
    var markers = [];

    // json for properties markers on map
    props = [
    <?php if( ! empty( $records ) ): ?>
    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if( ! empty( $rec->property_address_latitude ) && ! empty( $rec->property_address_longitude ) ): ?>
    {

  <?php
    $property = $rec;
    $property_sub_space_types = $rec->property_sub_space_types;
    $property_amenities = $rec->property_amenities;
    $cover_image = $property->cover_image;


    $price_per_day = 'NA';
    if ( ! empty( $property_sub_space_types ) ) {
       foreach( $property_sub_space_types as $details ) {
          if ( 'NA' === $price_per_day && ! empty( $details->price_per_day ) ) {
             $price_per_day = $details->price_per_day;
             break; // Let us take first value as default.
          }
       }
    }

    $price_per_month = 'NA';
    if ( ! empty( $property_sub_space_types ) ) {
       foreach( $property_sub_space_types as $details ) {
          if ( 'NA' === $price_per_month && ! empty( $details->price_per_month ) ) {
             $price_per_month = $details->price_per_month;
             break; // Let us take first value as default.
          }
       }
    }

    ?>


        title : '<?php echo e($rec->company); ?>',
        single_url : '<?php echo e(route("properties.edit", [ "slug" => $rec->slug, "sub_space_type_id" => $rec->slug ])); ?>',
        property_id: '<?php echo e($rec->id); ?>',
        image : '<?php echo e($rec->cover_image); ?>',

        price : '<?php echo e($price_per_month); ?><?php echo e(trans("custom.listings.per-month")); ?>',
        address : '<?php echo e($rec->property_address); ?>',
        near_by_landmark : '<?php echo e($rec->near_by_landmark); ?>',


        position : {
            lat : '<?php echo e($rec->property_address_latitude); ?>',
            lng : '<?php echo e($rec->property_address_longitude); ?>',
        },
        landmark_position : {
            lat : '<?php echo e($rec->near_by_landmark_latitude); ?>',
            lng : '<?php echo e($rec->near_by_landmark_longitude); ?>',
        },

        markerIcon : markerImg
    },
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    ];
    // custom infowindow object
    var infobox = new InfoBox({
        disableAutoPan: false,
        maxWidth: 202,
        pixelOffset: new google.maps.Size(-101, -285),
        zIndex: null,
        boxStyle: {
            background: "url(<?php echo e(PREFIX); ?>'images/infobox-bg.png') no-repeat",
            opacity: 1,
            width: "202px",
            height: "245px"
        },
        closeBoxMargin: "28px 26px 0px 0px",
        closeBoxURL: "",
        infoBoxClearance: new google.maps.Size(1, 1),
        pane: "floatPane",
        enableEventPropagation: false
    });


    // function that adds the markers on map
    addMarkers = function(props, map, requestfrom) {
        if (markerClusterer) {
          markerClusterer.clearMarkers();
        }


        markers = [];

        $.each(props, function(i,prop) {

            var latlng = new google.maps.LatLng(prop.position.lat,prop.position.lng);

            var marker = new google.maps.Marker({

                position: latlng,
                map: map,
                draggable: false,
                animation: google.maps.Animation.DROP,
                property_id: prop.property_id
            });


            //extend the bounds to include each marker's position
            bounds.extend(marker.position);


            var viewlink = '<a href="'+prop.single_url+'" class="btn btn-sm btn-round btn-green viewInfo btn-' + themeColor + '">View</a>';
            <?php if( ! empty( $single_page ) && 'yes' === $single_page ): ?>

                viewlink = ''
				map.setCenter(latlng);
				map.setZoom(15);
				bounds.extend(map.position);

            <?php endif; ?>



            var infoboxContent = '<div class="infoW">' +
                                    '<div class="propImg">' +
                                        '<img src="' + prop.image + '">' +
                                        '<div class="propBg">' +
                                            '<div class="propPrice">' + prop.price + '</div>' +

                                        '</div>' +
                                    '</div>' +
                                    '<div class="paWrapper">' +

                                        '<div class="propTitle">' + prop.title + '</div>' +

                                '<div class="propAddress sty-oht" title="'+prop.address+'" >' + prop.address + '</div>' +
                                    '</div>'  +
                        '<ul class="propFeat">' +

                            '</li>' +
                        '</ul>' +
                        '<div class="clearfix"></div>' +
                        '<div class="infoButtons">' +
                            '<a class="btn btn-sm btn-round btn-gray btn-o closeInfo">Close</a>' + viewlink +
                        '</div>' +
                     '</div>';

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {

                    infobox.setContent(infoboxContent);
                    infobox.open(map, marker);
                }
            })(marker, i));

            //now fit the map to the newly inclusive bounds
            map.fitBounds(bounds);

            markers.push(marker);



        });


        var zoom = null;
        var size = null;
        var style = null;
        markerClusterer = new MarkerClusterer(map, markers, {
          imagePath: '//developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
          requestfrom: requestfrom
        });

    }

    $(document).on('click', '.closeInfo', function() {
        infobox.open(null,null);
    });



    var repositionTooltip = function(e, ui) {
        var div = $(ui.handle).data("bs.tooltip").$tip[0];
        var pos = $.extend({}, $(ui.handle).offset(), {
                        width: $(ui.handle).get(0).offsetWidth,
                        height: $(ui.handle).get(0).offsetHeight
                    });
        var actualWidth = div.offsetWidth;

        var tp = {left: pos.left + pos.width / 2 - actualWidth / 2}
        $(div).offset(tp);

        $(div).find(".tooltip-inner").text( ui.value );
    }


    $(window).resize(function() {
        windowResizeHandler();
    });



    // Marker cluster implementaion START
    window.managemap = function() {
        $('body').removeClass('notransition');

        map = new google.maps.Map(document.getElementById('mapView'), options);
        var styledMapType = new google.maps.StyledMapType(styles, {
            name : 'Styled'
        });

        map.mapTypes.set('Styled', styledMapType);
        map.setCenter(new google.maps.LatLng(17.387140,78.491684));
        map.setZoom(10);

        if ($('#address').length > 0) {
            newMarker = new google.maps.Marker({
                position: new google.maps.LatLng(17.387140,78.491684),
                map: map,
                icon: new google.maps.MarkerImage(
                    'images/marker-new.png',
                    null,
                    null,
                    // new google.maps.Point(0,0),
                    null,
                    new google.maps.Size(36, 36)
                ),
                draggable: true,
                animation: google.maps.Animation.DROP,
            });

            google.maps.event.addListener(newMarker, "mouseup", function(event) {
                var latitude = this.position.lat();
                var longitude = this.position.lng();
                $('#latitude').text(this.position.lat());
                $('#longitude').text(this.position.lng());
            });
        }


        if ($('#property_address_latitude').length > 0
            && $('#property_address_latitude').val() != ''
            && $('#property_address_longitude').length > 0
            && $('#property_address_longitude').val() != ''
            ) {
            var latlng = new google.maps.LatLng($('#property_address_latitude').val(), $('#property_address_longitude').val());
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                draggable: false,
                animation: google.maps.Animation.DROP
            });

            //extend the bounds to include each marker's position
            bounds.extend(marker.position);

            //now fit the map to the newly inclusive bounds
            map.fitBounds(bounds);


        }

        if ($('#near_by_landmark_latitude').length > 0
            && $('#near_by_landmark_latitude').val() != ''
            && $('#near_by_landmark_longitude').length > 0
            && $('#near_by_landmark_longitude').val() != ''
            ) {
            var latlng = new google.maps.LatLng($('#near_by_landmark_latitude').val(), $('#near_by_landmark_longitude').val());
            var marker_land = new google.maps.Marker({
                position: latlng,
                map: map,
                draggable: false,
                animation: google.maps.Animation.DROP
            });
            marker_land.setIcon('//maps.google.com/mapfiles/kml/shapes/info-i_maps.png');

            bounds.extend(marker_land.position);
            //now fit the map to the newly inclusive bounds
            map.fitBounds(bounds);

        }

        addMarkers(props, map, 'loading');
    }

google.maps.event.addDomListener(window, 'load', managemap);
<?php if( ! empty( $requestfrom ) && $requestfrom == 'filter' ): ?>
	managemap();
<?php endif; ?>
    // Marker cluster implementation END





    if(!(('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch)) {
        $('body').addClass('no-touch');
        isDevice = false;
    }

    // Header search icon transition
    $('.search input').focus(function() {
        $('.searchIcon').addClass('active');
    });
    $('.search input').blur(function() {
        $('.searchIcon').removeClass('active');
    });

    // Notifications list items pulsate animation
    $('.notifyList a').hover(
        function() {
            $(this).children('.pulse').addClass('pulsate');
        },
        function() {
            $(this).children('.pulse').removeClass('pulsate');
        }
    );

    // Exapnd left side navigation
    var navExpanded = false;
    $('.navHandler, .closeLeftSide').on("click", function() {
        if(!navExpanded) {
            $('.logo').addClass('expanded');
            $('#leftSide').addClass('expanded');
            if(windowWidth < 768) {
                $('.closeLeftSide').show();
            }
            $('.hasSub').addClass('hasSubActive');
            $('.leftNav').addClass('bigNav');
            if(windowWidth > 767) {
                $('.full').addClass('m-full');
            }
            windowResizeHandler();
            navExpanded = true;
        } else {
            $('.logo').removeClass('expanded');
            $('#leftSide').removeClass('expanded');
            $('.closeLeftSide').hide();
            $('.hasSub').removeClass('hasSubActive');
            $('.bigNav').slimScroll({ destroy: true });
            $('.leftNav').removeClass('bigNav');
            $('.leftNav').css('overflow', 'visible');
            $('.full').removeClass('m-full');
            navExpanded = false;
        }
    });

    // functionality for map manipulation icon on mobile devices
    $('.mapHandler').on("click", function() {
        if ($('#mapView').hasClass('mob-min') ||
            $('#mapView').hasClass('mob-max') ||
            $('#content').hasClass('mob-min') ||
            $('#content').hasClass('mob-max')) {
                $('#mapView').toggleClass('mob-max');
                $('#content').toggleClass('mob-min');
        } else {
            $('#mapView').toggleClass('min');
            $('#content').toggleClass('max');
        }

        setTimeout(function() {
            var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
            var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
            var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
            $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);

            var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
            var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
            var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
            $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);

            if (map) {
                google.maps.event.trigger(map, 'resize');
            }

            $('.commentsFormWrapper').width($('#content').width());
        }, 300);

    });

    // Expand left side sub navigation menus
    $(document).on("click", '.hasSubActive', function() {
        $(this).toggleClass('active');
        $(this).children('ul').toggleClass('bigList');
        $(this).children('a').children('.arrowRight').toggleClass('fa-angle-down');
    });

    if(isDevice) {
        $('.hasSub').on("click", function() {
            $('.leftNav ul li').not(this).removeClass('onTap');
            $(this).toggleClass('onTap');
        });
    }

    // functionality for custom dropdown select list
    $('.dropdown-select li a').on("click", function() {
        if (!($(this).parent().hasClass('disabled'))) {
            $(this).prev().prop("checked", true);
            $(this).parent().siblings().removeClass('active');
            $(this).parent().addClass('active');
            $(this).parent().parent().siblings('.dropdown-toggle').children('.dropdown-label').html($(this).text());
        }
    });

    $('.priceSlider').slider({
        range: true,
        min: 0,
        max: 2000000,
        values: [0, 1500000],
        step: 10000,
        slide: function(event, ui) {
            var start = ui.values[0];
            var end = ui.values[1];
            $('#price_range_start').val( start );
            $('#price_range_end').val( end );

            $('.priceSlider .sliderTooltip .stLabel').html(
                '₹' + start.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +
                ' <span class="fa fa-arrows-h"></span> ' +
                '₹' + end.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
            );
            var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
            var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
            var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
            $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);
        }
    });



    $('#price_range_start').val();
    $('#price_range_end').val();

    $('.priceSlider .sliderTooltip .stLabel').html(
        '' + $('.priceSlider').slider('values', 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +
        ' <span class="fa fa-arrows-h"></span> ' +
        '' + $('.priceSlider').slider('values', 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
    );
    var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
    var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
    var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
    $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);

    $('.areaSlider').slider({
        range: true,
        min: 0,
        max: 20000,
        values: [5000, 10000],
        step: 10,
        slide: function(event, ui) {
            $('.areaSlider .sliderTooltip .stLabel').html(
                ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' Sq Ft' +
                ' <span class="fa fa-arrows-h"></span> ' +
                ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' Sq Ft'
            );
            var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
            var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
            var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
            $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);
        }
    });
    $('.areaSlider .sliderTooltip .stLabel').html(
        $('.areaSlider').slider('values', 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' Sq Ft' +
        ' <span class="fa fa-arrows-h"></span> ' +
        $('.areaSlider').slider('values', 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' Sq Ft'
    );
    var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
    var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
    var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
    $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);

    $('.volume .btn-round-right').on("click", function() {
        var currentVal = parseInt($(this).siblings('input').val());
        if (currentVal < 10) {
            $(this).siblings('input').val(currentVal + 1);
        }
    });
    $('.volume .btn-round-left').on("click", function() {
        var currentVal = parseInt($(this).siblings('input').val());
        if (currentVal > 1) {
            $(this).siblings('input').val(currentVal - 1);
        }
    });

    $(document).on("click", '.handleFilter', function(event) {

        event.stopImmediatePropagation();
        $('.filterForm').slideToggle(200);


    });

    $(document).on("click", '.handleFilterClose', function(event) {
        event.stopImmediatePropagation();

        var filter_available_date = $('#filter_available_date').val();
        var filter_months = $('#filter_months').val();
        var filter_seats = $('#filter_seats').val();
        var price_range_start = $('#price_range_start').val();
        var price_range_end = $('#price_range_end').val();

        var str = '';

        if ( filter_available_date != '' ) {
            str += '<button class="btn btn-default filterbutton morefilters" type="submit" value="9">Available '+filter_available_date+' <span class="fa fa-close subtypefilterclear" data-subtype_id=""   data-filter_type="available_date"></span></button>';
        }
        if ( filter_months != '' ) {
            str += '<button class="btn btn-default filterbutton morefilters" type="submit" value="9">No of Months '+filter_months+' <span class="fa fa-close subtypefilterclear" data-subtype_id=""   data-filter_type="months"></span></button>';
        }
        if ( filter_seats != '' ) {
            str += '<button class="btn btn-default filterbutton morefilters" type="submit" value="9">No of Seats '+filter_seats+' <span class="fa fa-close subtypefilterclear" data-subtype_id=""   data-filter_type="seats"></span></button>';
        }
        if ( price_range_start != '' && price_range_end != '' ) {
            str += '<button class="btn btn-default filterbutton morefilters" type="submit" value="9">Price Range '+price_range_start+' - '+price_range_end+' <span class="fa fa-close subtypefilterclear" data-subtype_id=""  data-filter_type="price_range"></span></button>';
        }

        $('.morefilters').remove();
        if ( $('.clearFilters').length > 0 ) {
            $('.clearFilters').before( str );
        } else {
            $('#morefiltersDiv').before( str );
        }
        $('.filterForm').slideToggle(200);

        var loc = $('#location').val();
        var wstype = $('#wstype').val();
        var excludefilters = $('#excludefilters').val();
        var datasource = $('#datasource').val();

        $.ajax({
            url: datasource,
            type:'POST',
            data: {
                location: loc,
                wstype: wstype,
                excludefilters: excludefilters,

                filter_available_date: filter_available_date,
                filter_months: filter_months,
                filter_seats: filter_seats,
                price_range_start: price_range_start,
                price_range_end: price_range_end
            },
            success: function(data) {
             $('#resultsList').html( data );
            }
        });
    });

    //Enable swiping
    $(".carousel-inner").swipe( {
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            $(this).parent().carousel('next');
        },
        swipeRight: function() {
            $(this).parent().carousel('prev');
        }
    });

    $(".carousel-inner .card").on("click", function() {
        window.open($(this).attr('data-linkto'), '_self');
    });

    $('#content').scroll(function() {
        if ($('.comments').length > 0) {
            var visible = $('.comments').visible(true);
            if (visible) {
                $('.commentsFormWrapper').addClass('active');
            } else {
                $('.commentsFormWrapper').removeClass('active');
            }
        }
    });

    $('.btn').on("click", function() {
        if ($(this).is('[data-toggle-class]')) {
            $(this).toggleClass('active ' + $(this).attr('data-toggle-class'));
        }
    });

    $('.tabsWidget .tab-scroll').slimScroll({
        height: '235px',
        size: '5px',
        position: 'right',
        color: '#939393',
        alwaysVisible: false,
        distance: '5px',
        railVisible: false,
        railColor: '#222',
        railOpacity: 0.3,
        wheelStep: 10,
        allowPageScroll: true,
        disableFadeOut: false
    });

    $("ul.colors li a").on("click", function() {
        $("#app").attr("href",$(this).attr('data-style'));
        $.cookie("css",$(this).attr('data-style'), {expires: 365, path: '/'});
        location.reload();
        return false;
    });

    $('.progress-bar[data-toggle="tooltip"]').tooltip();
    $('.tooltipsContainer .btn').tooltip();

    $("#slider1").slider({
        range: "min",
        value: 50,
        min: 1,
        max: 100,
        slide: repositionTooltip,
        stop: repositionTooltip
    });
    $("#slider1 .ui-slider-handle:first").tooltip({ title: $("#slider1").slider("value"), trigger: "manual"}).tooltip("show");

    $("#slider2").slider({
        range: "max",
        value: 70,
        min: 1,
        max: 100,
        slide: repositionTooltip,
        stop: repositionTooltip
    });
    $("#slider2 .ui-slider-handle:first").tooltip({ title: $("#slider2").slider("value"), trigger: "manual"}).tooltip("show");

    $("#slider3").slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 190, 350 ],
        slide: repositionTooltip,
        stop: repositionTooltip
    });
    $("#slider3 .ui-slider-handle:first").tooltip({ title: $("#slider3").slider("values", 0), trigger: "manual"}).tooltip("show");
    $("#slider3 .ui-slider-handle:last").tooltip({ title: $("#slider3").slider("values", 1), trigger: "manual"}).tooltip("show");

    $('#autocomplete').autocomplete({
        source: ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"],
        focus: function (event, ui) {
            var label = ui.item.label;
            var value = ui.item.value;
            var me = $(this);
            setTimeout(function() {
                me.val(value);
            }, 1);
        }
    });

    $('#tags').tagsInput({
        'height': 'auto',
        'width': '100%',
        'defaultText': 'Add a tag',
    });

    $('#datepicker').datepicker();

    $('.isThemeBtn').addClass("btn-" + themeColor.replace("css/app", "green"));
    $('.isThemeText').addClass("text-" + themeColor.replace("css/app", "green"));

    // functionality for autocomplete address field
    if ($('#address').length > 0) {
        var address = document.getElementById('address');
        var addressAuto = new google.maps.places.Autocomplete(address);

        google.maps.event.addListener(addressAuto, 'place_changed', function() {
            var place = addressAuto.getPlace();

            if (!place.geometry) {
                return;
            }
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
            }
            newMarker.setPosition(place.geometry.location);
            newMarker.setVisible(true);
            $('#latitude').text(newMarker.getPosition().lat());
            $('#longitude').text(newMarker.getPosition().lng());

            return false;
        });
    }

    $('input, textarea').placeholder();
});

function initialize( id ) {


    var initialLat = 17.387140;
    var initialLong = 78.491684;

    var latlng = new google.maps.LatLng(initialLat, initialLong);
    var options = {
        zoom: 12,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("mapView"), options);
    geocoder = new google.maps.Geocoder();

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
     map: map,
     anchorPoint: new google.maps.Point(0, -29),
     draggable: true
    });


    var initialLat = $('#'+id+'_latitude').val();
    var initialLong = $('#'+id+'_longitude').val();

    var other_field = 'near_by_landmark';
    if ( id == 'near_by_landmark') {
        other_field = 'property_address';
    }


    if ( id == 'near_by_landmark' && $('#' + other_field).val() != '' ) {
        initialLat = $('#'+other_field+'_latitude').val();
        initialLong = $('#'+other_field+'_longitude').val();
    }

    if ( initialLat != '' && initialLong != '' ) {
        latlng = new google.maps.LatLng(initialLat, initialLong);
        options = {
            zoom: 12,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("mapView"), options);
        geocoder = new google.maps.Geocoder();

        infowindow = new google.maps.InfoWindow();
        marker = new google.maps.Marker({
         map: map,
         anchorPoint: new google.maps.Point(0, -29),
         draggable: true,
        });

         if ( id === 'near_by_landmark') {
         marker.setIcon('//maps.google.com/mapfiles/kml/shapes/info-i_maps.png');
        }
         marker.setPosition(latlng);

         marker.setVisible(true);
     }


    // Places API
    var options = {
        types: ['geocode'],
        componentRestrictions: {
           'country': []
        },
        language: 'en-GB',

        zoom: 12
    };
    var input = jQuery( '#' + id);
    var autocomplete_my = new google.maps.places.Autocomplete(input[0], options);



    google.maps.event.addListener(marker, 'dragend', function() {


    jQuery( '#' + id + '_latitude' ).val(marker.getPosition().lat() );
    jQuery( '#' + id + '_longitude' ).val(marker.getPosition().lng() );

    geocoder.geocode({
        latLng: marker.getPosition()
      }, function(responses) {
        if (responses && responses.length > 0) {
          marker.formatted_address = responses[0].formatted_address;
        } else {
          marker.formatted_address = 'Cannot determine address at this location.';
        }
        var content = '<div><strong>' + "Location(" + marker.getPosition().lat() + "," + marker.getPosition().lng() + ")" + '</strong><br>';
        content += '' + marker.formatted_address;

        infowindow.setContent( content );
        infowindow.open(map, marker);

        input.val(marker.formatted_address);
      });

  });

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name',
  political: 'short_name'
};

    google.maps.event.addListener(autocomplete_my, 'place_changed', function () {
        place = autocomplete_my.getPlace();
        console.log( place );
        jQuery( '#' + id + '_latitude' ).val(place.geometry.location.lat() );
        jQuery( '#' + id + '_longitude' ).val(place.geometry.location.lng() );

        var property_address_city,
        property_address_state,
        property_address_country,
        property_addrress_postal_code,
        property_address_street_number,
        property_address;

        if (place.address_components) {
            for( var i = 0; i < place.address_components.length; i++ ) {
                var addressType = place.address_components[i].types[0];
                if (addressType == 'sublocality_level_1' ) { // property_address_street_number OR Village
                  property_address_street_number = place.address_components[i].long_name;
                }
                if ( addressType == 'locality' ) { // City
                  property_address_city = place.address_components[i].long_name;
                }
                if (addressType == 'administrative_area_level_2' && property_address_city == '' ) { // City
                  property_address_city = place.address_components[i].long_name;
                }
                if (addressType == 'administrative_area_level_1' ) { // State
                  property_address_state = place.address_components[i].long_name;
                }
                if (addressType == 'country' ) {
                  property_address_country = place.address_components[i].long_name;
                }
                if (addressType == 'postal_code' ) {
                  property_addrress_postal_code = place.address_components[i].long_name;
                }

            }

        }

        property_address = place.formatted_address;
        input.blur();
        input.val(property_address);

        if ( id == 'property_address') {
            $('#property_address_street_number').val( property_address_street_number );
            $('#property_address_city').val( property_address_city );
            $('#property_address_state').val( property_address_state );
            $('#property_address_country').val( property_address_country );
            $('#property_addrress_postal_code').val( property_addrress_postal_code );
        }


        // Marker Display
        infowindow.close();
        marker.setVisible(false);

        // If the place has a geometry, then present it on a map.
         if (place.geometry.viewport) {
             map.fitBounds(place.geometry.viewport);
         } else {
             map.setCenter(place.geometry.location);
             map.setZoom(17);  // Why 17? Because it looks good.
         }

         if ( id === 'near_by_landmark') {
         marker.setIcon('//maps.google.com/mapfiles/kml/shapes/info-i_maps.png');
        }
         marker.setPosition(place.geometry.location);
         marker.setVisible(true);


         var address = '';
         if (place.address_components) {
             address = [
               (place.address_components[0] && place.address_components[0].short_name || ''),
               (place.address_components[1] && place.address_components[1].short_name || ''),
               (place.address_components[2] && place.address_components[2].short_name || '')
             ].join(' ');
         }


         var content = '<div><strong>' + "Location(" + place.geometry.location.lat() + "," + place.geometry.location.lng() + ")" + '</strong><br>';
         content += '' + address;
         infowindow.setContent( content );
         infowindow.open(map, marker);


    });

}

function initialize_top( id ) {

    // Places API
    var options = {
        types: ['geocode'],
        componentRestrictions: {
             'country': []
        },
        language: 'en-GB',

        zoom: 12
    };
    var input = jQuery( '#' + id);
    var autocomplete_my = new google.maps.places.Autocomplete(input[0], options);

    google.maps.event.addListener(autocomplete_my, 'place_changed', function () {
        place = autocomplete_my.getPlace();
        input.val(place.formatted_address);


            var property_address_city,
            property_address_state,
            property_address_country,
            property_addrress_postal_code,
            property_address_street_number,
            property_address;

            if (place.address_components) {
                for( var i = 0; i < place.address_components.length; i++ ) {
                    var addressType = place.address_components[i].types[0];
                    if (addressType == 'sublocality_level_1' ) { // property_address_street_number OR Village
                      property_address_street_number = place.address_components[i].long_name;
                    }
                    if (addressType == 'administrative_area_level_2' || addressType == 'locality' ) { // City
                      property_address_city = place.address_components[i].long_name;
                    }
                    if (addressType == 'administrative_area_level_1' ) { // State
                      property_address_state = place.address_components[i].long_name;
                    }
                    if (addressType == 'country' ) {
                      property_address_country = place.address_components[i].long_name;
                    }
                    if (addressType == 'postal_code' ) {
                      property_addrress_postal_code = place.address_components[i].long_name;
                    }

                }
            }

            if ( property_address_city == '' ) {
                property_address_city = property_addrress_postal_code;
            }
        if ( id == 'search_property') {
            searchProperty( place.formatted_address );
        }
    });
}

function searchProperty( formatted_address )
{
    window.location = '<?php echo e(PREFIX); ?>properties?location=' + formatted_address + '&wstype=';
}

</script>

<?php echo $__env->make( 'home-pages.common.map-refresh' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>