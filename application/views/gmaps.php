<div id="map"></div>

<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 38.581572, lng: -121.494400},
            zoom: 8
        });
    }
</script>

<!-- JavaScript API to Google -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6Vp2c83d5i9mIwqHttrq6D2wMnxer6dg
&callback=initMap" async defer></script>

<!--
<div id="map"></div>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6Vp2c83d5i9mIwqHttrq6D2wMnxer6dg&libraries=visualization&callback=initMap">
</script>
-->