(function ($) {
    "use strict";
    var list = []; 

    /* function to be executed when product is selected for comparision*/
    $(document).on('click', '.addToCompare', function () {
        $(".comparePanle").show();
        $(this).toggleClass("rotateBtn");
        $(this).parents(".selectProduct").toggleClass("selected");
        var productID = $(this).parents('.selectProduct').attr('data-title');

        var inArray = $.inArray(productID, list);
        if (inArray < 0) {
            if (list.length > 2) {
                $("#WarningModal").show();
                $("#warningModalClose").click(function () {
                    $("#WarningModal").hide();
                });
                $(this).toggleClass("rotateBtn");
                $(this).parents(".selectProduct").toggleClass("selected");
                return;
            }

            if (list.length < 3) {
                list.push(productID);

                var displayTitle = $(this).parents('.selectProduct').attr('data-id');

                var image = $(this).siblings(".productImg").attr('src');

                $(".comparePan").append('<div id="' + productID + '" class="relPos titleMargin w3-margin-bottom   w3-col l3 m4 s4"><div class="w3-white titleMargin"><a class="selectedItemCloseBtn w3-closebtn cursor">&times</a><img src="' + image + '" alt="image" style="height:100px;"/><p id="' + productID + '" class="titleMargin1">' + displayTitle + '</p></div></div>');
            }
        } else {
            list.splice($.inArray(productID, list), 1);
            var prod = productID.replace(" ", "");
            $('#' + prod).remove();
            hideComparePanel();

        }
        if (list.length > 1) {

            $(".cmprBtn").addClass("active");
            $(".cmprBtn").removeAttr('disabled');
        } else {
            $(".cmprBtn").removeClass("active");
            $(".cmprBtn").attr('disabled', '');
        }

    });

    /*function to be executed when compare button is clicked*/
    $(document).on('click', '.cmprBtn', function () {
        if ($(".cmprBtn").hasClass("active")) {
            /* this is to print the  features list statically*/
            $(".contentPop").append('<div class="w3-col s3 m3 l3 compareItemParent relPos">' + '<ul class="product">' + '<li class=" relPos compHeader"><p class="w3-display-middle" ><b>Property Preview</b></p></li>' + '<li class="relPos compHeader-2"><p class="w3-display-middle"><b>Coworking</b></p></li>' +  '<li class="relPos compHeader-2"><p class="w3-display-middle" ><b>Landmark</b></p></li>' + '<li class="cpu relPos compHeader-2"><p class="w3-display-middle" ><b>Amenities & Services</b></p></li>'
            + '<li class="cpu relPos compHeader-2"><p class="w3-display-middle" ><b>Price</b></p></li>' + '<li class="relPos compHeader-2"><p class="w3-display-middle" ><b>Check Availability</b></p></li>' + '</ul>' + '</div>');

            for (var i = 0; i < list.length; i++) {
                /* this is to add the items to popup which are selected for comparision */
                var product = $('.selectProduct[data-title="' + list[i] + '"]');

                var image = $('[data-title=' + list[i] + ']').find(".productImg").attr('src');
                var title = $('[data-title=' + list[i] + ']').attr('data-id');
                var amenities = $(product).data('processor');
                var slug = $(product).data('slug');
                var property_id = $(product).data('title');
                

                var amenities_display = '';
                $( amenities ).each(function(index, record) {
                     if ( amenities_display != '' ) {
                        amenities_display += '<br/> ';
                    }

                     amenities_display += record.name + '<img src="public/uploads/default-imgs/arrow-icon.png" style="float:left; margin-right: 10px;">'
                });
                /*appending to div*/
                $(".contentPop").append('<div class="w3-col s3 m3 l3 compareItemParent relPos">' + '<ul class="product">' + '<li class="compHeader" height="80px;" width="200px;"><img src="' + image + '" class="compareThumb"></li>' + '<li class="relPos compHeader-2">' + '<p class="w3-display-middle" >' + title + '</p>' + '</li>' + '<li class="relPos compHeader-2">'  + '<p class="w3-display-middle" >' + '</p></li>' + '<li class="relPos compHeader-2">' + '<p class="w3-display-middle" >' + $(product).data('weight') + '</p>' + '</li>' + '<li class="cpu relPos compHeader-2">' + '<p class="w3-display-middle" style="text-align: left;" >' + amenities_display + '</p>' + '</li>' + '<li class="cpu relPos compHeader-2">' + $(product).data('price_html') + '</li>' + '<li class="relPos compHeader-2">'  + '<p class="w3-display-middle" >' + '<a href="property/'+slug+'/'+property_id+'" class="btn btn-enquire-solid">' + 'Check Avaliability' + '</a>' + '</p>' + '</li>' + '</ul>' + '</div>');

            }
        }
        $(".modPos").show();
    });

    /* function to close the comparision popup */
    $(document).on('click', '.closeBtn', function () {
        $(".contentPop").empty();
        $(".comparePan").empty();
        $(".comparePanle").hide();
        $(".modPos").hide();
        $(".selectProduct").removeClass("selected");
        $(".cmprBtn").attr('disabled', '');
        list.length = 0;
        $(".rotateBtn").toggleClass("rotateBtn");
    });

    /*function to remove item from preview panel*/
    $(document).on('click', '.selectedItemCloseBtn', function () {

        var test = $(this).siblings("p").attr('id');
        $('[data-title=' + test + ']').find(".addToCompare").click();
        hideComparePanel();
    });

    function hideComparePanel() {
        if (!list.length) {
            $(".comparePan").empty();
            $(".comparePanle").hide();
        }
    }
})(jQuery);
