'use strict';

let map;
let directionsDisplay;
let directionsService;

$(function () {
    $('.datepicker').datepicker();

    initForms([
        {form: "#searchForm", url: 'api/routes', callback: drawRoutes},
        {form: "#registrationForm", url: 'api/register', callback: afterRegistration},
        {form: "#loginForm", url: 'api/login', callback: afterLogin},
    ]);
});

function url(path) {
    return base_url + path;
}

function initForms(data) {

    data.forEach((obj) => {
        $(obj.form).on('submit', function(e) {
            e.preventDefault();
            serverRequest(obj.url, $(this).serialize(), obj.callback);
            return false;
        });
    });
}

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 56.8796, lng: 24.6032},
        zoom: 8
    });

    directionsDisplay = new google.maps.DirectionsRenderer();

    directionsDisplay.setMap(map);

    directionsService = new google.maps.DirectionsService();

}

function serverRequest(url, data, callback, type = 'get') {
    $.ajax({
        url: url,
        data: data,
        type: type,
        dataType: 'json',
        success: callback,
        error: (xhr, ajaxOptions, thrownError) => {
            let response = xhr.responseJSON;
            alert(response ? response.message : xhr.responseText);
        }
    });
}

function drawRoutes(routes) {
    Object.keys(routes.data.units).forEach(function(key) {
        let unit = routes.data.units[key];
        Object.keys(unit.routes).forEach(function(k){
            if (unit.routes[k].type === 'route') {
                drawRoute(unit.routes[k].start, unit.routes[k].end)
            }
        })
    });
}

function afterRegistration(response) {
    window.location = url('map');
}

function afterLogin(response) {
    window.location = url('map');
}

function get(key, def = null) {
    return pageData[key] || def;
}

function drawRoute(startObj, endObj) {
    let start = new google.maps.LatLng(startObj.lat, startObj.lng);
    let end = new google.maps.LatLng(endObj.lat, endObj.lng);
    let request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });
}