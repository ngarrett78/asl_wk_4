/**
 * Created by nate on 4/11/2016.
 */

// Modals
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
})


// Jumbotron responsiveness
var jumboHeight = $('.home_jumbotron').outerHeight();
function parallax(){
    var scrolled = $(window).scrollTop();
    $('.bg').css('height', (jumboHeight-scrolled) + 'px');
}


// Slideshow - rotating
$(document).ready(function() {
    $('#slideshow').cycle({
        fx: 'fade',
        pager: '#smallnav',
        pause:   1,
        speed: 1800,
        timeout:  4500
    });
});


// Facebook API code
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        testAPI();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' +
            'into this app.';
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        document.getElementById('status').innerHTML = 'Please log ' +
            'into Facebook.';
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId      : '{1698623300403907}',
        cookie     : true,  // enable cookies to allow the server to access
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.5' // use graph api version 2.5
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Successful login for: ' + response.name);
        document.getElementById('status').innerHTML =
            'Thanks for logging in, ' + response.name + '!';
    });
}


// Jquery and Ajax for form validation
$(document).ready(function() {
    $('#frm').submit(function(){

        $.post($('#frm').attr('action'), $('#frm').serialize(), function( data ) {
            if(data.st == 0)
            {
                $('#validation-error').html(data.msg);
            }

            if(data.st == 1)
            {
                $('#validation-error').html(data.msg);
            }

        }, 'json');
        return false;
    });


});


// JQuery for moving elements
var $fade = $('.fade');

$fade.waypoint(function(direction) {
    if(direction == 'down') {
        $fade.addClass('js-fade-animate');
    } else {
        $fade.removeClass('js-fade-animate');
    }
    //console.log('waypoint!');

}, { offset: '50%' });



// Firebase DB
//var firebase = new Firebase("https://nates-map.firebaseapp.com");

// Google Maps
/*
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 0, lng: 0},
        zoom: 3
    });

    // Add marker on user click
    map.addListener('click', function(e) {
        firebase.push({lat: e.latLng.lat(), lng: e.latLng.lng()});
    });

    // Create a heatmap.
    var heatmap = new google.maps.visualization.HeatmapLayer({
        data: [],
        map: map,
        radius: 8
    });

    firebase.on("child_added", function(snapshot, prevChildKey) {
        // Get latitude and longitude from Firebase.
        var newPosition = snapshot.val();

        // Create a google.maps.LatLng object for the position of the marker.
        // A LatLng object literal (as above) could be used, but the heatmap
        // in the next step requires a google.maps.LatLng object.
        var latLng = new google.maps.LatLng(newPosition.lat, newPosition.lng);

        heatmap.getData().push(latLng);
    });
}

    */

// Google Location
function initMap() {
    var sacramento = new google.maps.LatLng(38.581572, -121.494400);

    var map = new google.maps.Map(document.getElementById('map'), {
        center: sacramento,
        zoom: 9
    });

    var coordInfoWindow = new google.maps.InfoWindow();
    coordInfoWindow.setContent(createInfoWindowContent(sacramento, map.getZoom()));
    coordInfoWindow.setPosition(sacramento);
    coordInfoWindow.open(map);

    map.addListener('zoom_changed', function() {
        coordInfoWindow.setContent(createInfoWindowContent(sacramento, map.getZoom()));
        coordInfoWindow.open(map);
    });
}

var TILE_SIZE = 256;

function createInfoWindowContent(latLng, zoom) {
    var scale = 1 << zoom;

    var worldCoordinate = project(latLng);

    var pixelCoordinate = new google.maps.Point(
        Math.floor(worldCoordinate.x * scale),
        Math.floor(worldCoordinate.y * scale));

    var tileCoordinate = new google.maps.Point(
        Math.floor(worldCoordinate.x * scale / TILE_SIZE),
        Math.floor(worldCoordinate.y * scale / TILE_SIZE));

    return [
        'sacramento, CA',
        'LatLng: ' + latLng,
        'Zoom level: ' + zoom,
        'World Coordinate: ' + worldCoordinate,
        'Pixel Coordinate: ' + pixelCoordinate,
        'Tile Coordinate: ' + tileCoordinate
    ].join('<br>');
}

// The mapping between latitude, longitude and pixels is defined by the web
// mercator projection.
function project(latLng) {
    var siny = Math.sin(latLng.lat() * Math.PI / 180);

    // Truncating to 0.9999 effectively limits latitude to 89.189. This is
    // about a third of a tile past the edge of the world tile.
    siny = Math.min(Math.max(siny, -0.9999), 0.9999);

    return new google.maps.Point(
        TILE_SIZE * (0.5 + latLng.lng() / 360),
        TILE_SIZE * (0.5 - Math.log((1 + siny) / (1 - siny)) / (4 * Math.PI)));
}