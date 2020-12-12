# Exercise 2: COVID-19 data analysis

## Configuration

Project directory is in ```/var/www/html/meeting1/exercise2```

The Web interface support Firefox or Chrome

## Analysis

### CSV files structure analysis

It seem to be 5 different types of csv file structure

- **Type 1**: "Province/State", "Country/Region", "Last Update", "Confirmed", "Deaths", "Recovered"
- **Type 2**: "FIPS", "Admin2", "Province_State", "Country_Region", "Last_Update", "Lat", "Long_", "Confirmed", "Deaths", "Recovered", "Active", "Combined_Key", "Incident_Rate", "Case_Fatality_Ratio"
- **Type 3**: "FIPS", "Admin2", "Province_State", "Country_Region", "Last_Update", "Lat", "Long_", "Confirmed", "Deaths", "Recovered", "Active", "Combined_Key", "Incidence_Rate", "Case-Fatality_Ratio"
- **Type 4**: "Province/State", "Country/Region", "Last Update", "Confirmed", "Deaths", "Recovered", "Latitude", "Longitude"

The 5 type is similar to type 1 but with an encoding error in "Provence/State" with ".Provence/State"
The 3 type is also similar to type 2, only "Case_Fatality_Ratio" versus "Case-Fatality_Ratio"

Finaly we have only 3 types

Common fields that be used are:
- Province/State - Province_State - .Province/State
- Country/Region - Country_Region
- Last Update - Last_Update
- Confirmed
- Deaths
- Recovered

#### Country_Region analysis

They are duplicates in the files, typos and non country regions,
all adjustements will be done via SQL queries via PHPMyAdmin after initial csv data import.

All the queries are contained in the ```covid_stats_country_region_clean.sql``` file in ```/var/www/html/meeting1/exercise2```

An exeption is made for US converted to United States, this is done during the import by the PHP script
### Database structure

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

#### SQL query to insert

```$sql = "INSERT INTO covid_stats (filename, date, province_state, country_region, confirmed, deaths, recovered, type) VALUES ('$fileName', '$date', '$province_state', '$country_region', '$confirmed', '$deaths', '$recovered', '$type');";```

### CSV files

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
### Import CSV files

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

## Web Application

Output the number of confirmed / recovered cases and deaths in a given time period (more than 1 day is possible) for an input-defined country/region (the entered country name should be considered as a substring of the given country name inside the data). Make sure that user input data are validated and that no SQL injections are possible.

Outputs:
- Confirmed (total and delta for the requested period)
- Recovered (total and delta for the requested period)
- Deaths (total and delta for the requested period)

Inputs:
- Country/Region, like %uxembo%
- period 1 day or more

The web applicaition is accessible at ```http://xxx.xxx.xxx.xxx/meeting1/exercise2/``` page ```index.php```







