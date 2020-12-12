<?php

/*
* The script is a one shot import
* Doesn't verify if the entry already present in the database
* TRUNCATE TABLE `covid_stats required at each execution

/*
* Global variables
*/

$csvDirectory = 'csv-files';                // CSV diretory file
$regex = '/\d+\-\d+\-\d+/';                 // Regex to catch file name dates
$fileStart = 2;                             // Start at 2 due to '..' and '.' in scandir results
$fileAdd = 1;                               // Add 1 to end the loop
$csvType = [];                              // Empty array for storing filename and type

// Database informations

$servername = "10.6.0.4";
$username = "webprog";
$password = "webprog";
$dbname = "webprog";

/*
* Classification of CSV files
*/

// Type 1: include also encoding error replacement from 22/01 to 30/01
$csvType1 = array (
    "Province/State", "Country/Region", "Last Update", "Confirmed", "Deaths", "Recovered"
);

# Type 2 : Case_Fatality_Ratio, Incident_Rate
$csvType2 = array(
    "FIPS", "Admin2", "Province_State", "Country_Region", "Last_Update", "Lat", "Long_", "Confirmed", "Deaths", "Recovered", "Active", "Combined_Key", "Incident_Rate", "Case_Fatality_Ratio"
);

// Type 3: Incidence_Rate -> will be declared as type2
$csvType3 = array (
    "FIPS", "Admin2", "Province_State", "Country_Region", "Last_Update", "Lat", "Long_", "Confirmed", "Deaths", "Recovered", "Active", "Combined_Key", "Incidence_Rate", "Case-Fatality_Ratio"
);

// Type 4 : Type 1 + Latitude and Longitude
$csvType4 = array (
    "Province/State", "Country/Region", "Last Update", "Confirmed", "Deaths", "Recovered", "Latitude", "Longitude"
);

/*
* Country mapping to match inconsitancies
*/

// 

/*
* Scan the csv-file directory to list CSV files into the array files
*/

$csvFiles = array_diff(scandir($csvDirectory), array('..', '.'));

$nbrFiles = count($csvFiles);

$fileEnd = $nbrFiles + $fileAdd;

/*
* Excel File Classification
*/

function Classify($fileName) {

    global $csvDirectory;
    global $csvType1, $csvType2, $csvType3, $csvType4;
    global $csvType;

    $path = $csvDirectory . "/" . $fileName;

    $fileHandler = fopen($path, "r");

    while (($data = fgetcsv($fileHandler, 1000, ",")) !== FALSE) {
        $csvFileArr[] = $data;
    }
    fclose($fileHandler);

    if(array_diff($csvFileArr[0], $csvType1) == NULL):
        //echo "$fileName is equivalent to type 1\n"; 
        $csvType[$fileName] = 'type1';
    elseif (array_diff($csvFileArr[0], $csvType2) == NULL):
        //echo "$fileName is equivalent to type 2\n";
        $csvType[$fileName] = 'type2';
    elseif (array_diff($csvFileArr[0], $csvType3) == NULL):
        //echo "$fileName is equivalent to type 3\n";
        $csvType[$fileName] = 'type2';
    elseif (array_diff($csvFileArr[0], $csvType4) == NULL):
        //echo "$fileName is equivalent to type 4\n";
        $csvType[$fileName] = 'type3';
    else:
        // Seem only to affected files from 22/01 to 31/01
        // Not safe if new formats are provided

        //echo "$fileName is equivalent to type 1\n";
        $csvType[$fileName] = 'type1';

    endif;

}

/*
* Import File 
*/

function Import($fileName,$fileNameDate) {

    global $csvDirectory;
    global $csvType;

    // Gather the type of the file

    $type = isset($csvType[$fileName]) ? $csvType[$fileName] : null;
    //echo $fileName . " has the following " . $type . " file type\n";

    $path = $csvDirectory . "/" . $fileName;

    $fileHandler = fopen($path, "r");

    while (($data = fgetcsv($fileHandler, 1000, ",")) !== FALSE) {

        $csvFileArr[] = $data;

        //echo $fileName . "\n";
        //print_r($csvFileArr);
    }

    switch($type) {
        case 'type1';
            LoopInsert($csvFileArr,$fileName,$fileNameDate,'type1');
        break;

        case 'type2';
            LoopInsert($csvFileArr,$fileName,$fileNameDate,'type2');
        break;

        case 'type3';
            LoopInsert($csvFileArr,$fileName,$fileNameDate,'type3');
        break;

        case 'type4';
            LoopInsert($csvFileArr,$fileName,$fileNameDate,'type4');
        break;

        default;
            echo 'No type found\n';
        break;
    }

    fclose($fileHandler);
}

/*
* Loop insert into database
*/

function LoopInsert($csvFileArr,$fileName,$fileNameDate,$type) {

    global $servername;
    global $username;
    global $password;
    global $dbname;

    // count number of line into the file array
    //echo count($csvFileArr) . " lines into " . $fileName . " with date ". $fileNameDate . " and type " . $type . "\n";

    $end = count($csvFileArr);

    $fileNameDate = DateTime::createFromFormat("m-d-Y" , $fileNameDate); 

    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Inserting but skeeping first line
    for ($i = 1; $i <= $end; $i++) {

        switch($type) {
            case 'type1';

                // "Province/State", "Country/Region", "Last Update", "Confirmed", "Deaths", "Recovered"
                // $csvFileArr[$i][0], $csvFileArr[$i][1], $csvFileArr[$i][3], $csvFileArr[$i][4], $csvFileArr[$i][5]
                // date 11-08-2020 to YYYY-MM-DD

                echo $fileName . ": " . $csvFileArr[$i][0] . " - " . $csvFileArr[$i][1] . " - " . $csvFileArr[$i][3] . " - " . $csvFileArr[$i][4] . " - " . $csvFileArr[$i][5] . " - " . $type . "\n";

                $date = $fileNameDate->format('Y-m-d');
                $province_state = addslashes($csvFileArr[$i][0]);
                $country_region = addslashes($csvFileArr[$i][1]);
                $confirmed = $csvFileArr[$i][3];
                $deaths = $csvFileArr[$i][4];
                $recovered = $csvFileArr[$i][5];    

            break;

            case 'type2';

                //"FIPS", "Admin2", "Province_State", "Country_Region", "Last_Update", "Lat", "Long_", "Confirmed", "Deaths", "Recovered", "Active", "Combined_Key", "Incident_Rate", "Case_Fatality_Ratio"
                // $csvFileArr[$i][2], $csvFileArr[$i][3], $csvFileArr[$i][7], $csvFileArr[$i][8], $csvFileArr[$i][9]

                echo $fileName . ": " . $csvFileArr[$i][2] . " - " . $csvFileArr[$i][3] . " - " . $csvFileArr[$i][7] . " - " . $csvFileArr[$i][8] . " - " . $csvFileArr[$i][9] . " - " . $type . "\n";

                $date = $fileNameDate->format('Y-m-d');
                $province_state = addslashes($csvFileArr[$i][2]);
                $country_region = addslashes($csvFileArr[$i][3]);
                $confirmed = $csvFileArr[$i][7];
                $deaths = $csvFileArr[$i][8];
                $recovered = $csvFileArr[$i][9]; 
            
            break;

            case 'type3';

                //"Province/State", "Country/Region", "Last Update", "Confirmed", "Deaths", "Recovered", "Latitude", "Longitude"
                // $csvFileArr[$i][0], $csvFileArr[$i][1], $csvFileArr[$i][3], $csvFileArr[$i][4], $csvFileArr[$i][5]

                echo $fileName . ": " . $csvFileArr[$i][0] . " - " . $csvFileArr[$i][1] . " - " . $csvFileArr[$i][3] . " - " . $csvFileArr[$i][4] . " - " . $csvFileArr[$i][5] . " - " . $type . "\n";

                $date = $fileNameDate->format('Y-m-d');
                $province_state = addslashes($csvFileArr[$i][0]);
                $country_region = addslashes($csvFileArr[$i][1]);
                $confirmed = $csvFileArr[$i][3];
                $deaths = $csvFileArr[$i][4];
                $recovered = $csvFileArr[$i][5];  
            
            break;

            default;
                echo 'No type found\n';
            break;
        }

        if($confirmed == NULL) {$confirmed = 0;}
        if($deaths == NULL){ $deaths = 0;}
        if($recovered == NULL){$recovered = 0;}

        if(empty($confirmed)) {$confirmed = 0;}
        if(empty($deaths)) {$deaths = 0;} 
        if(empty($recovered)) {$recovered = 0;}

        // Change from US to United States at the import, will reduce workload when fixing later
        if ($country_region == 'US') {$country_region = 'United States';}

        $sql = "INSERT INTO covid_stats (filename, date, province_state, country_region, confirmed, deaths, recovered, type) VALUES ('$fileName', '$date', '$province_state', '$country_region', '$confirmed', '$deaths', '$recovered', '$type');";

        //echo $sql . "\n";

        if ($conn->query($sql) === TRUE) {
            //echo "$fileName records created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error . "\n";
            exit;
        }
    }

    $conn->close();

}

/*
* Main
*/

// Initial database clean-up
//TRUNCATE TABLE `covid_stats

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "TRUNCATE TABLE `covid_stats`";

if ($conn->query($sql) === TRUE) {
    echo "covid stats truncate done\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error . "\n";
}

$conn->close();

// Loop into the files to classify

for ($i = $fileStart; $i <= $fileEnd; $i++) {
    
    preg_match_all($regex ,$csvFiles[$i], $date);
    $fileName = $csvFiles[$i];
    //$fileNameDate = $date[0][0];

    Classify($fileName);
}

// Loop into the files to import into the databse

for ($i = $fileStart; $i <= $fileEnd; $i++) {

    preg_match_all($regex ,$csvFiles[$i], $date);
    $fileName = $csvFiles[$i];
    $fileNameDate = $date[0][0];

    Import($fileName,$fileNameDate);
}

echo "Import of " . $fileEnd . " total CSV files finished";

?>