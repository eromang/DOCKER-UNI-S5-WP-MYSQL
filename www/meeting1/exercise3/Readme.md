# Exercise 3

## TODO's

Your task in the third exercise is the development of a JS-based web application that combines OpenStreetMap with Covid-19 information from https://coronadatasource.org/api/ . In the description of the endpoints of that API, you will find an endpoint providing "Worldmeters data – Returns data of all countries that has COVID-19" (a data set encoded in JSON).

The application should initially show a map from OpenStreetMap. If a user clicks on a position on the map, then the "country in which the click was done" is determined and an overlay window should show up with the Corona information for that specific country (retrieved from the corona data source linked above). With a "close functionality" (link or button), that overlay window can be closed and another country can be chosen in the map. Note that you can find a tutorial on the usage of OpenStreetMap with a Google search.

Your application must be written in JavaScript without usage of additional JS frameworks except the openlayers JS library. Please upload a zip archive with all required source files, a README file, and a small screencast showing your application in action.

## Resources

JSON:
- https://www.tutorialspoint.com/json/index.htm
- https://www.w3schools.com/js/js_json_intro.asp

JSON with AJAX:
- https://www.tutorialspoint.com/json/json_ajax_example.htm

OpenLayers
- https://openlayers.org

Nominatim:
- https://nominatim.org/release-docs/develop/api/Reverse/
    - E.g. https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=22.3444&lon=74.123123&limit=1&zoom=3&accept-language=en&addressdetails=0

## Source of data

https://coronadatasource.org/api/corona-covid-19-api/

*Worldmeters data – Returns data of all countries that has COVID-19* : https://disease.sh/v3/covid-19/countries (JSON)

API documentation: https://disease.sh/docs/#/
- https://disease.sh/v3/covid-19/countries/United%20States

## JSON Documentation

Receiving data
- https://www.w3schools.com/js/tryit.asp?filename=tryjson_receive

Storing data
- https://www.w3schools.com/js/js_json_intro.asp

Parsing data
- https://www.w3schools.com/js/js_json_parse.asp 

Stringify
- https://www.w3schools.com/js/js_json_stringify.asp

## Requirements

- npm v6.14.9
- Node.js v14.15.3

## NPM

### Initial steps

From tutorial: https://openlayers.org/en/latest/doc/tutorials/bundle.html

- `mkdir exercise3-1 && cd exercise3-1`
- `npm init`
    - Customize package.json to your needs
- `npm install ol`
- `npm install --save-dev parcel-bundler`

Add to package.json:

```json
"start": "parcel index.html",
"build": "parcel build --public-url . index.html"
```

- Start application: `npm start`
    - Open in http://localhost:1234/

To create a production bundle of your application, simply type:

`npm run build`

and copy the **dist/**   folder to your production server.




