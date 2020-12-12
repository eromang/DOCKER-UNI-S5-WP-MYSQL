#!/bin/bash
MYDIR=./csv-files

echo "pre-purging"
rm -rf $MYDIR
mkdir $MYDIR
rm master.zip
rm -Rf COVID-19-master

echo "download csv files"
curl https://codeload.github.com/CSSEGISandData/COVID-19/zip/master --output master.zip

echo "unzip csv"
unzip -oqq master.zip

echo "copy data to csv-file directory"
cp COVID-19-master/csse_covid_19_data/csse_covid_19_daily_reports/*.csv $MYDIR 

echo "post-purging"
rm master.zip
rm -Rf COVID-19-master

echo "End of script"