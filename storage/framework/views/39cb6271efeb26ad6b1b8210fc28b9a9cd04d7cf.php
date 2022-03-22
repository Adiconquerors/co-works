
 <?php
    $google_api_key = getSetting( 'google_api_key', 'google-api-key-settings' );
 ?>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo e($google_api_key); ?>"></script>
<script type="text/javascript">
    function initialize_autocomplete( id ) {
    
    // Places API
    var options = {
        types: ['geocode'],
        componentRestrictions: {
            'country': []
        },
        language: 'en-GB',
        // mapTypeId: google.maps.MapTypeId.ROADMAP,
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
    });
}
</script>