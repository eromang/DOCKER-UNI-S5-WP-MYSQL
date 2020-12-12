<html>
<head>
</head>
<body>
<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<h1>COVID-19 Statistics</h1>

<label for="start">Start date:</label>

<input type="date" id="start" name="stats_start"
       value="<?php echo date("Y-m-d"); ?>"
       min="2020-01-01" max="2020-12-31">

<label for="end">End date:</label>

<input type="date" id="end" name="stats_end"
       value="<?php echo date("Y-m-d"); ?>"
       min="2020-01-01" max="2020-12-31">

<label for="country_region">Country/Region:</label>
<input type="text" id="country_region" name="country_region">

<input type="submit" name="submit">

</form>

<?php

// Database informations

$servername = "10.6.0.4";
$username = "webprog";
$password = "webprog";
$dbname = "webprog";



function Results($start,$end,$countryRegion) {

    global $servername;
    global $username;
    global $password;
    global $dbname;

    // Connect to the database
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } 

    $start = $mysqli->real_escape_string($start);
    $end = $mysqli->real_escape_string($end);
    $countryRegion = $mysqli->real_escape_string($countryRegion);

    $sql = "SELECT date, province_state, country_region, confirmed, deaths, recovered FROM covid_stats WHERE ((date BETWEEN '$start' AND '$end') AND (country_region LIKE '%$countryRegion%'))";

    //echo $sql;
    
    if ($result = $mysqli->query($sql))
    {
        $row_count = $result->num_rows;

        $i = 0;
        
        while ($row = $result->fetch_row())
        {
            if ($i == 0)
            {
                $diff_confirmed = 0;
                $confirmed_previous_day = $row[3];

                $diff_deaths = 0;
                $deaths_previous_day = $row[4];

                $diff_recovered = 0;
                $recoved_previous_day = $row[5];

            } else {

                $diff_confirmed = $row[3] - $confirmed_previous_day;
                $confirmed_previous_day = $row[3];

                $diff_deaths = $row[4] - $deaths_previous_day;
                $deaths_previous_day = $row[4];

                $diff_recovered = $row[5] - $recoved_previous_day;
                $recoved_previous_day = $row[5];
            }

            echo "<tr>";
            echo "<td align=center>" . $row[0] . "</td>";
            echo "<td align=center>" . $row[1] . "</td>";
            echo "<td align=center>" . $row[2] . "</td>";
            echo "<td align=center>" . $row[3] . " (" . $diff_confirmed . ")</td>";
            echo "<td align=center>" . $row[4] . " (" . $diff_deaths . ")</td>";
            echo "<td align=center>" . $row[5] . " (" . $diff_recovered . ")</td>";
            echo "</tr>";

            $i++;

        }

        $row->close;

    } else {
        echo "Error: " . $sql . "<br>" . $result->error . "\n";
        exit;
    }

    $mysqli->close();

}

if(isset($_POST['submit'])) 
{ 
    $statsStart = $_POST['stats_start'];
    $statsEnd = $_POST['stats_end'];
    $countryRegion = $_POST['country_region'];

    echo "User Has submitted the form and entered :<br>";
    echo "<ul>";
    echo "<li>Start date : <b> $statsStart </b></li>";
    echo "<li>End date : <b> $statsEnd </b></li>";
    echo "<li>Country/Region : <b> $countryRegion </b></li>";
    echo "</ul>";
    echo "<br>You can use the following form again to enter a new research."; 
}
?>

<h1>Results:<h1>

<table style="width:100%">
  <tr>
    <th>Date</th>
    <th>Province/State</th> 
    <th>Country/Region</th> 
    <th>Confirmed</th>
    <th>Deaths</th>
    <th>Recovered</th>
  </tr>

<?php 

if(isset($_POST['submit']))
{ 

    $statsStart = $_POST['stats_start'];
    $statsEnd = $_POST['stats_end'];
    $countryRegion = $_POST['country_region'];

    Results($statsStart,$statsEnd,$countryRegion);
}

?>

</table>

</body>
</html>