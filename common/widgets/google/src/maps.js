/**
 * Created by Pineapple on 19.01.16.
 */


var lat,lng,full_address;
var   box, label,map;

function drawCell(geohash) {
    if (typeof box != 'undefined') box.setMap(null);

    var bounds = Geohash.bounds(geohash);

    // google maps doesn't extend beyond ±85°
    bounds.sw.lat = Math.min(Math.max(bounds.sw.lat, -85), 85);
    bounds.ne.lat = Math.min(Math.max(bounds.ne.lat, -85), 85);

    var boxBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(bounds.sw.lat, bounds.sw.lon),
        new google.maps.LatLng(bounds.ne.lat, bounds.ne.lon)
    );
    box = new google.maps.Rectangle({
        bounds: boxBounds,
        strokeColor: '#0000ff',
        strokeOpacity: 0.8,
        strokeWeight: 1,
        fillColor: '#0000ff',
        fillOpacity: 0.2
    });
    //console.log(box);
    box.setMap(map);
    map.fitBounds(box.bounds);
}

function drawLabel(geohash) {
    var centre = Geohash.decode(geohash);

    if (typeof label == 'undefined') {
        label = new google.maps.InfoWindow({
            maxWidth: 100
        });
    }
    label.setContent(geohash);
    label.setPosition(new google.maps.LatLng(centre.lat, centre.lon));
    label.open(map)
}
//
// function showNeighbours(geohash) {
//     var neighbours = Geohash.neighbours(geohash);
//     $('#neighbour-nw').html(neighbours.nw);
//     $('#neighbour-n').html(neighbours.n);
//     $('#neighbour-ne').html(neighbours.ne);
//     $('#neighbour-w').html(neighbours.w);
//     $('#neighbour-me').html(geohash);
//     $('#neighbour-e').html(neighbours.e);
//     $('#neighbour-sw').html(neighbours.sw);
//     $('#neighbour-s').html(neighbours.s);
//     $('#neighbour-se').html(neighbours.se);
//     $('#neighbour-me').css('font-weight', 'bold');
// }

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        // {types: ['geocode']});
        {types: ['(cities)']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    console.log(place);

    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }


    console.log(componentForm);

    console.log(place.address_components);

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }
}


// [END region_fillform]





// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new googlee.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}
// [END region_geolocation]


function initMap() {
    var start_value_lng = parseFloat($(componentForm['lng']).val());
    var start_value_lat = parseFloat($(componentForm['lat']).val());

    console.log(start_value_lng,start_value_lat);
    var start_location = {
        lng:82.9346, lat: 55.0415
    };
    var zoom = 12;
    var markerOn = false;
    if (start_value_lng) {

        var lat = start_value_lat;
        var lng = start_value_lng;
        zoom = 16;
        // console.log('___ START VALUE EXPLODE', lat,lng);
        start_location = {
            lng:lng, lat: lat
        };
        console.log('___ START VALUE EXPLODE', lat,lng,start_location);
        markerOn = true;
    }

      map = new google.maps.Map(document.getElementById('map'), {
        center: start_location,
        zoom: zoom
    });

    if (markerOn) {
        var marker = new google.maps.Marker({
            position: start_location,
            map: map,
            title: 'Hello World!'
        });
    } else {
        var marker = new google.maps.Marker({
            map: map
        });
    }


    var input = document.getElementById('pac-input');

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var infowindow = new google.maps.InfoWindow();
    // var marker = new google.maps.Marker({
    //     map: map
    // });
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        var place = autocomplete.getPlace();



        if (!place.geometry) {
            return;
        }

        console.log('---Place',place.address_components);
        var city_text = '';
        var city_shorttext = '';

        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];

            if ((addressType == "locality")  ) {
                console.log(addressType);
                city_shorttext =place.address_components[i].long_name;
            }
            if ((addressType == 'country') || (addressType == 'administrative_area_level_1') || (addressType == 'administrative_area_level_2')) {
                city_text = city_text + ' ' + place.address_components[i].long_name;
            }

        }

        if (componentForm['place_location']) {
            $(componentForm['place_location']).val(''+place.geometry.location.lng()  + ',' + place.geometry.location.lat()  +'');
        }

        if (componentForm['lat']) {
            $(componentForm['lat']).val(place.geometry.location.lat);
        }

        if (componentForm['lng']) {
            $(componentForm['lng']).val(place.geometry.location.lng);
        }
        if (componentForm['city_text']) {
            $(componentForm['city_text']).val(city_text);
        }
        if (componentForm['city_shorttitle']) {
            $(componentForm['city_shorttitle']).val(city_shorttext);
        }

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        // Set the position of the marker using the place ID and location.
        marker.setPlace({
            placeId: place.place_id,
            location: place.geometry.location
        });
        marker.setVisible(true);

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                //'Place ID: ' + place.place_id + '<br>' +
            place.formatted_address);
        // infowindow.open(map, marker);
    });
}





function iMapWithMarkers(markers,lat,lng,places) {

    var zoom = 16;
    var markerOn = false;
    var start_location = {
        // lng:-73.993145, lat: 40.655320
        lng:parseFloat( lng), lat: parseFloat( lat)
    };

    markerOn = true;


      map = new google.maps.Map(document.getElementById('map'), {
        center: start_location,
        zoom: zoom
    });







    $.each(markers, function( index, loc ) {
        console.log('--- Location: ',loc);
        var infowindow = new google.maps.InfoWindow({
            content: loc.content
        });
        var marker = new google.maps.Marker({
            position: {lng: parseFloat(loc.lng), lat: parseFloat(loc.lat)},
            map: map,
            icon: {
                url: loc.iconUrl                          },
            label:loc.label,
            title: 'Hello World!'
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
            drawCell(loc.geohash);
            // drawLabel(loc.geohash);
        });
    });
    console.log('--- Placess: ',places);
    $.each(places, function( index, loc ) {
        console.log('--- Place: ',loc);
        var infowindow = new google.maps.InfoWindow({
            content: loc.content
        });
        var marker = new google.maps.Marker({
            position: {lng: parseFloat(loc.lng), lat: parseFloat(loc.lat)},
            map: map,
            icon: {
                url: loc.iconUrl                          },
            label:loc.label

        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
            drawCell(loc.geohash);
            // drawLabel(loc.geohash);
        });
    });



}


function iMap(lat,lng, content) {

    var zoom = 16;
    var markerOn = false;
    var start_location = {
        lng:lng, lat: lat
    };
    markerOn = true;


    var map = new google.maps.Map(document.getElementById('map'), {
        center: start_location,
        zoom: zoom
    });

    var infowindow = new google.maps.InfoWindow({
        content: content
    });
    var marker = new google.maps.Marker({
        position: start_location,
        map: map,
        // label:'',
        title: 'Hello World!'
    });
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

}

function codeAddress(address){
    //var address = document.getElementById('adr').value;
    geocoder.geocode( { 'address':address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            return results[0].geometry.location;
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}



