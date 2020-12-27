import 'ol/ol.css';
import Map from 'ol/Map';
import Overlay from 'ol/Overlay';
import TileLayer from 'ol/layer/Tile';
import View from 'ol/View';
import XYZ from 'ol/source/XYZ';
import {fromLonLat, toLonLat} from 'ol/proj';
import {toStringHDMS} from 'ol/coordinate';
import * as olProj from 'ol/proj';

/**
 * Elements that make up the popup.
 */
var container = document.getElementById('popup');
var content = document.getElementById('popup-content');
var closer = document.getElementById('popup-closer');

/**
 * Create an overlay to anchor the popup to the map.
 */
var overlay = new Overlay({
    element: container,
    autoPan: true,
    autoPanAnimation: {
      duration: 250,
    },
  });

/**
 * Add a click handler to hide the popup.
 * @return {boolean} Don't follow the href.
 */
closer.onclick = function () {
    overlay.setPosition(undefined);
    closer.blur();
    return false;
};

var key = 'bCVzgaOVuGoXXhOLB8kY';
var attributions =
  '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> ' +
  '<a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>';

var map = new Map({
    layers: [
        new TileLayer({
            source: new XYZ({
                attributions: attributions,
                url: 'https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=' + key,
                tileSize: 512,
        }),
    }) ],
    overlays: [overlay],
    target: 'map',
    view: new View({
    center: [0, 0],
    zoom: 2,
    }),
});

// Mouse-SingleClick event 
map.on('singleclick', function (evt) {

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
            const diseases_country =                    diseases_data_json.country;
            const disease_cases =                       numberWithDots(diseases_data_json.cases);
            const disease_todayCases =                  numberWithDots(diseases_data_json.todayCases);
            const disease_deaths =                      numberWithDots(diseases_data_json.deaths);
            const disease_todayDeaths =                 numberWithDots(diseases_data_json.todayDeaths);
            const disease_recovered =                   numberWithDots(diseases_data_json.recovered);
            const disease_todayRecovered =              numberWithDots(diseases_data_json.todayRecovered);
            const disease_active =                      numberWithDots(diseases_data_json.active);
            const disease_critical =                    numberWithDots(diseases_data_json.critical);
            const disease_casesPerOneMillion =          numberWithDots(diseases_data_json.casesPerOneMillion);
            const disease_deathsPerOneMillion =         numberWithDots(diseases_data_json.deathsPerOneMillion);
            //const disease_tests =                       numberWithDots(tests);
            //const disease_testsPerOneMillion =          numberWithDots(testsPerOneMillion);
            //const disease_oneCasePerPeople =            numberWithDots(oneCasePerPeople);
            //const disease_oneDeathPerPeople =           numberWithDots(oneDeathPerPeople);
            //const disease_oneTestPerPeople =            numberWithDots(oneTestPerPeople);
            //const disease_activePerOneMillion =         numberWithDots(activePerOneMillion);
            //const disease_recoveredPerOneMillion =      numberWithDots(recoveredPerOneMillion);
            //const disease_criticalPerOneMillion =       numberWithDots(criticalPerOneMillion);

            console.log("Country: "                     + diseases_country);
            console.log("Country cases: "               + disease_cases);
            console.log("Country todayCase: "           + disease_todayCases);
            console.log("Country deaths: "              + disease_deaths);
            console.log("Country todayDeaths: "         + disease_todayDeaths);
            console.log("Country recovered: "           + disease_recovered);
            console.log("Country todayRecovered: "      + disease_todayRecovered);
            console.log("Country active: "              + disease_active);
            console.log("Country critical: "            + disease_critical);
            console.log("Country casesPerOneMillion: "  + disease_casesPerOneMillion);
            console.log("Country deathsPerOneMillion: " + disease_deathsPerOneMillion);
            //console.log("Country tests: "               + disease_tests);
            //console.log("Country testsPerOneMillion: "  + disease_testsPerOneMillion);
            //console.log("Country oneCasePerPeople: "    + disease_oneCasePerPeople);
            //console.log("Country oneDeathPerPeople: "   + disease_oneDeathPerPeople);
            //console.log("Country oneTestPerPeople: "    + disease_oneTestPerPeople);
            //console.log("Country activePerOneMillion: " + disease_activePerOneMillion);
            //console.log("Country recoveredPerOneMillion: " + disease_recoveredPerOneMillion);
            //console.log("Country criticalPerOneMillion: " + disease_criticalPerOneMillion);

            content.innerHTML = '<p><h3>' + diseases_country + '</h3></p>' +
                '<b>Today</b><br />' +
                'Cases: ' + disease_todayCases + '<br />' +
                'Deaths: ' + disease_todayDeaths + '<br />' +
                'Recovered: ' + disease_todayRecovered + '<br />' +
                '<br /><b>Total</b><br />' +
                'Cases: ' + disease_cases + '<br />' +
                'Deaths: ' + disease_deaths + '<br />' +
                'Recovered: ' + disease_recovered + '<br />' +
                'Active: ' + disease_active + '<br />' + 
                'Critical: ' + disease_critical + '<br />' +
                'Cases Per One Million: ' + disease_casesPerOneMillion + '<br />' +
                'Deaths Per One Million: ' + disease_deathsPerOneMillion;
            overlay.setPosition(coordinate);

        });
    });
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

/*
* To process numbers
*/

function numberWithDots(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

