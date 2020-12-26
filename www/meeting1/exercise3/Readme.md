# Exercise 3

## TODO's

Your task in the third exercise is the development of a JS-based web application that combines OpenStreetMap with Covid-19 information from https://coronadatasource.org/api/ . In the description of the endpoints of that API, you will find an endpoint providing *"Worldmeters data – Returns data of all countries that has COVID-19"* (a data set encoded in JSON).

The application should initially show a map from OpenStreetMap. If a user clicks on a position on the map, then the "country in which the click was done" is determined and an overlay window should show up with the Corona information for that specific country (retrieved from the corona data source linked above). With a "close functionality" (link or button), that overlay window can be closed and another country can be chosen in the map. Note that you can find a tutorial on the usage of OpenStreetMap with a Google search.

Your application must be written in JavaScript without usage of a JS framework. Please upload a zip archive with all required source files, a README file, and a small screencast showing your application in action.

## Resources

JSON:
- https://www.tutorialspoint.com/json/index.htm
- https://www.w3schools.com/js/js_json_intro.asp

JSON with AJAX:
- https://www.tutorialspoint.com/json/json_ajax_example.htm

## Source of data

https://coronadatasource.org/api/corona-covid-19-api/

*Worldmeters data – Returns data of all countries that has COVID-19* : https://disease.sh/v3/covid-19/countries (JSON)

API documentation: https://disease.sh/docs/#/

## JSON

Receiving data
- https://www.w3schools.com/js/tryit.asp?filename=tryjson_receive

Storing data
- https://www.w3schools.com/js/js_json_intro.asp

Parsing data
- https://www.w3schools.com/js/js_json_parse.asp 

Stringify
- https://www.w3schools.com/js/js_json_stringify.asp

