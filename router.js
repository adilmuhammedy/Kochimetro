function initMap() {
    // Map options
    var options = {
        zoom: 12,
        center: { lat: 9.9784, lng: 76.3155 } // Coordinates of Kochi
    };

    // Create the map
    var map = new google.maps.Map(document.getElementById('map'), options);

    // Add the metro route overlay
    var routeLayer = new google.maps.KmlLayer({
        url: 'https://goo.gl/maps/dvqGEKAVFkDoAD5X6',
        map: map
    });
}.

