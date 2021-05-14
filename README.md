# DOCKER-UNI-S5-WP-MYSQL

- Docker image used for UNI S5 Web Programming course.
- 3 exercises done with the image

## Exercise 1 - Simple COVID stats PHP web scraper

Your task is the development of a short PHP script that extracts and outputs the latest number of COVID-19 cases from three different websites (using regular expressions to extract the information out of the HTML code). Only one country per website is required, and the chosen countries can be different (but at least once Luxembourg information must be extracted).

### Details

- Located at www/meeting1/exercise1/webscraping.php
- execute with php webscraping.php in console

### Source selection

#### First source
https://www.ecdc.europa.eu/en/cases-2019-ncov-eueea

```html
<tr>
<td>Luxembourg</td>
<td>32 100</td>
<td>288</td>
<td>1237.2</td>
<td>13.4</td>
</tr>
```

#### Second source
https://tradingeconomics.com/luxembourg/coronavirus-cases

Luxembourg Coronavirus: 33,409 Cases and 300 Deaths

#### Third source
https://ncov2019.live

```
{"country":"Luxembourg","confirmed":33974,"deaths":306
```

## Exercise 2 - COVID-19 data analysis

### Configuration

- Project directory is in ```/var/www/html/meeting1/exercise2```
- The Web interface support Firefox or Chrome

### Analysis

#### CSV files structure analysis

It seem to be 5 different types of csv file structure

- **Type 1**: "Province/State", "Country/Region", "Last Update", "Confirmed", "Deaths", "Recovered"
- **Type 2**: "FIPS", "Admin2", "Province_State", "Country_Region", "Last_Update", "Lat", "Long_", "Confirmed", "Deaths", "Recovered", "Active", "Combined_Key", "Incident_Rate", "Case_Fatality_Ratio"
- **Type 3**: "FIPS", "Admin2", "Province_State", "Country_Region", "Last_Update", "Lat", "Long_", "Confirmed", "Deaths", "Recovered", "Active", "Combined_Key", "Incidence_Rate", "Case-Fatality_Ratio"
- **Type 4**: "Province/State", "Country/Region", "Last Update", "Confirmed", "Deaths", "Recovered", "Latitude", "Longitude"

- The 5 type is similar to type 1 but with an encoding error in "Provence/State" with ".Provence/State"
- The 3 type is also similar to type 2, only "Case_Fatality_Ratio" versus "Case-Fatality_Ratio"
- Finaly we have only 3 types

Common fields that be used are:
- Province/State - Province_State - .Province/State
- Country/Region - Country_Region
- Last Update - Last_Update
- Confirmed
- Deaths
- Recovered

##### Country_Region analysis

They are duplicates in the files, typos and non country regions,
all adjustements will be done via SQL queries via PHPMyAdmin after initial csv data import.

All the queries are contained in the ```covid_stats_country_region_clean.sql``` file in ```/var/www/html/meeting1/exercise2```

An exeption is made for US converted to United States, this is done during the import by the PHP script
#### Database structure

- Database: webprog
- Table: covid_stats
    - Field filename (only for debugging)
        - varchar (14)
    - Field date (coming from the filename)
        - DATE values in 'YYYY-MM-DD' format
        - Index date
    - Field province_state
        - varchar (255)
        - Index province_state
    - Field country_region
        - varchar (255)
        - Index country_region
    - Field confirmed
        - INT (11)
    - Field deaths
        - INT (11)
    - Field recovered
        - INT (11)
    - Fiel type
        - varchar (5)

Structure of the MySQL table is in the ```covid_stats.sql``` file in ```/var/www/html/meeting1/exercise2```
The structure can be created via PHPMyAdmin 

##### SQL query to insert

```$sql = "INSERT INTO covid_stats (filename, date, province_state, country_region, confirmed, deaths, recovered, type) VALUES ('$fileName', '$date', '$province_state', '$country_region', '$confirmed', '$deaths', '$recovered', '$type');";```

#### CSV files

CSV file source is:
https://github.com/CSSEGISandData/COVID-19/tree/master/csse_covid_19_data/csse_covid_19_daily_reports

CSV file are stored in the csv-files directory aka ```/var/www/html/meeting1/exercise2/csv-files```

To download just execute the script ```init-csv.sh``` in the ```/var/www/html/meeting1/exercise2``` directory.

```
root@bfa7154eca03:/var/www/html/meeting1/exercise2# sh init-csv.sh 
pre-purging
download csv files
  % Total    % Received % Xferd  Average Speed   Time    Time     Time  Current
                                 Dload  Upload   Total   Spent    Left  Speed
100  190M    0  190M    0     0  8893k      0 --:--:--  0:00:21 --:--:-- 11.9M
unzip csv
copy data to csv-file directory
post-purging
End of script
```

#### Import CSV files

Execute the following command

```root@bfa7154eca03:/var/www/html/meeting1/exercise2# php import_csv_files.php```

A truncate of the table is done before inserting all the data

When the script is running the following example will be displayed to illustrate import of data

...
08-24-2020.csv: Nebraska - US - 3 - 0 - 0
08-24-2020.csv: Nebraska - US - 0 - 0 - 0
08-24-2020.csv: Nebraska - US - 2 - 0 - 0
08-24-2020.csv: Nebraska - US - 17 - 0 - 0
08-24-2020.csv: Nebraska - US - 4 - 0 - 0
08-24-2020.csv: Nebraska - US - 60 - 5 - 0
08-24-2020.csv: Nebraska - US - 19 - 0 - 0
...

Once the import is finished, the script will return

Import of xxxx total CSV files finished

### Web Application

Output the number of confirmed / recovered cases and deaths in a given time period (more than 1 day is possible) for an input-defined country/region (the entered country name should be considered as a substring of the given country name inside the data). Make sure that user input data are validated and that no SQL injections are possible.

Outputs:
- Confirmed (total and delta for the requested period)
- Recovered (total and delta for the requested period)
- Deaths (total and delta for the requested period)

Inputs:
- Country/Region, like %uxembo%
- period 1 day or more

The web applicaition is accessible at ```http://xxx.xxx.xxx.xxx/meeting1/exercise2/``` page ```index.php```


## Exercise 3 - COVID Stats with OpenStreetMap

### TODO's

Your task in the third exercise is the development of a JS-based web application that combines OpenStreetMap with Covid-19 information from https://coronadatasource.org/api/ . In the description of the endpoints of that API, you will find an endpoint providing "Worldmeters data – Returns data of all countries that has COVID-19" (a data set encoded in JSON).

The application should initially show a map from OpenStreetMap. If a user clicks on a position on the map, then the "country in which the click was done" is determined and an overlay window should show up with the Corona information for that specific country (retrieved from the corona data source linked above). With a "close functionality" (link or button), that overlay window can be closed and another country can be chosen in the map. Note that you can find a tutorial on the usage of OpenStreetMap with a Google search.

Your application must be written in JavaScript without usage of additional JS frameworks except the openlayers JS library. Please upload a zip archive with all required source files, a README file, and a small screencast showing your application in action.

### Instructions

- All NPM build code is in the root of exercise3 folder
- Readme.md also available in the same root folder
- index.html in the root folder is the starting point of the build colde
- Folder sources contain the pre-build index.html, main.js and package.json file
- exercise3 folder can be deployed on any the docker
- Day-1 data is used (see e-mail exchange with me on the 28 december)

Requirements

- npm v6.14.9
- Node.js v14.15.3
- Chrome, Firefox or Safari

### Resources

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

https://coronadatasource.org/api/corona-covid-19-api/

*Worldmeters data – Returns data of all countries that has COVID-19* : https://disease.sh/v3/covid-19/countries (JSON)

API documentation: https://disease.sh/docs/#/
- https://disease.sh/v3/covid-19/countries/United%20States

#### JSON Documentation

Receiving data
- https://www.w3schools.com/js/tryit.asp?filename=tryjson_receive

Storing data
- https://www.w3schools.com/js/js_json_intro.asp

Parsing data
- https://www.w3schools.com/js/js_json_parse.asp 

Stringify
- https://www.w3schools.com/js/js_json_stringify.asp

### NPM

#### Initial NPM steps

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