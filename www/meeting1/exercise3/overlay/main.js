import 'ol/ol.css';
import Map from 'ol/Map';
import OSM from 'ol/source/OSM';
import Overlay from 'ol/Overlay';
import TileLayer from 'ol/layer/Tile';
import View from 'ol/View';
import {fromLonLat, toLonLat} from 'ol/proj';
import {toStringHDMS} from 'ol/coordinate';
import * as olProj from 'ol/proj';
import { Disposable } from 'ol';

var layer = new TileLayer({
  source: new OSM(),
});

var map = new Map({
  layers: [layer],
  target: 'map',
  view: new View({
    center: [0, 0],
    zoom: 2,
  }),
});

var pos = fromLonLat([16.3725, 48.208889]);

// Popup showing the position the user clicked
var popup = new Overlay({
  element: document.getElementById('popup'),
});
map.addOverlay(popup);

// Mouse-Click event 
map.on('click', function (evt) {

    var element = popup.getElement();
    var coordinate = evt.coordinate;
    var hdms = toStringHDMS(toLonLat(coordinate));

    // Coords of click is coordinate
    console.log("evt.coordinate: " + coordinate);

    // Transform the coordinates because evt.coordinate 
    // is by default Web Mercator (EPSG:3857) 
    // and not "usual coords" (EPSG:4326) 

    const coords_click = olProj.transform(coordinate, 'EPSG:3857', 'EPSG:4326');
    console.log("Mouse Click coordinates: " + coords_click);

    // MOUSE CLICK: Longitude
    const lon = coords_click[0];
    // MOUSE CLICK: Latitude
    const lat = coords_click[1];

    // DATA to put in NOMINATIM URL to find country of mouse click location
    const data_for_url = {lon: lon, lat: lat, format: "json", limit: 1, zoom: 3, addressdetails: 0};

    // ENCODED DATA for URL
    const encoded_data = Object.keys(data_for_url).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data_for_url[k])
    }).join('&');

    // FULL URL for searching country of mouse click
    const url_nominatim = 'https://nominatim.openstreetmap.org/reverse?accept-language=en&' + encoded_data;
    console.log("URL Request to NOMINATIM: " + url_nominatim);

    // Call to Nominatim to get the country name

    httpGet(url_nominatim, function (response) {

        // JSON Data of the response to the request Nominatim
        const nominatim_data_json = JSON.parse(response);

        // Longitude and latitude
        const res_lon = nominatim_data_json.lon;
        const res_lat = nominatim_data_json.lat;

        // Nominatim Country
        const nominatim_country  = nominatim_data_json.display_name;
        console.log("Clicked Nominatim country is: " + nominatim_country);

        const url_diseases = 'https://disease.sh/v3/covid-19/countries/' + encodeURIComponent(nominatim_country);
        console.log("URL Request to DISEASE: " + url_diseases);

        // Call to Diseases to get the clicked country related data

        httpGet(url_diseases, function (response) {

            // JSON Data of the response to the request Diseases
            const diseases_data_json = JSON.parse(response);

            // Diseases Country
            const diseases_country  = diseases_data_json.country;
            
            console.log("Clicked Diseases country is: " + diseases_country);

        });

    });



    $(element).popover('dispose');
    popup.setPosition(coordinate);
    $(element).popover({
        container: element,
        placement: 'top',
        animation: false,
        html: true, 
        content: '<p>:</p><code>' + hdms + '</code>',
    });
    $(element).popover('show');
});

/*
* Function to XMLHttpRequest JSON's
*/

function httpGet(url, callback) {

    const getRequest = new XMLHttpRequest();
    getRequest.open("GET", url, true);

    getRequest.addEventListener("readystatechange", function () {

        // IF RESPONSE is GOOD
        if (getRequest.readyState === 4 && getRequest.status === 200) {

            // Callback for making stuff with the Nominatim response address
            callback(getRequest.responseText); 
        }
    });

    // Send the request
    getRequest.send();
}


