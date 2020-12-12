<?php

/*
Exercise 1: PHP regular expressions

Your task is the development of a short PHP script that extracts and outputs the latest number of COVID-19 cases from three different websites (using regular expressions to extract the information out of the HTML code). Only one country per website is required, and the chosen countries can be different (but at least once Luxembourg information must be extracted).
*/

/*
Sources selection

# First source
https://www.ecdc.europa.eu/en/cases-2019-ncov-eueea

<tr>
<td>Luxembourg</td>
<td>32 100</td>
<td>288</td>
<td>1237.2</td>
<td>13.4</td>
</tr>

# Second source
https://tradingeconomics.com/luxembourg/coronavirus-cases

Luxembourg Coronavirus: 33,409 Cases and 300 Deaths

# Third source
https://ncov2019.live

{"country":"Luxembourg","confirmed":33974,"deaths":306

*/

# Date

$date = date('l jS \of F Y');

# Sources

$source1 = 'https://www.ecdc.europa.eu/en/cases-2019-ncov-eueea';
$source2 = 'https://www.worldometers.info/coronavirus/country/luxembourg/';
$source3 = 'https://ncov2019.live';

// Array for the sources
$sources = array($source1, $source2, $source3);

// Array for the outputs
$outputs = array();

// Array for the regex

$regExes = array();

/*
Regex for source 1: /\Luxembourg \(([^)]+)\)/

\Luxembourg : match Luxembourg
\(          : match an opening parentheses
(           : begin capturing group
[^)]+       : match one or more non ) characters
)           : end capturing group
\)          : match closing parentheses

2 values will results, number of total cases and total deaths

*/

$regExes[0] = "/\Luxembourg \(([^)]+)\)/";

/*
Regex for source 2: \Luxembourg Coronavirus: (\d+,\d+) Cases and (\d+) Deaths

\Luxembourg Coronavirus:  : match Luxembourg Coronavirus: 
(           : begin capturing group
\d          : Matches any digit characters (0-9)
+           : Quantifier match 1 or more of the preceding token
)           : end capturing group

2 values will results, number of total cases and total deaths

*/

$regExes[1] = "/\Luxembourg Coronavirus: (\d+,\d+) Cases and (\d+) Deaths/";

/*
Regex for source 3: /Luxembourg\",\"confirmed\"\:(\d+),\"deaths\"\:(\d+)/

(           : begin capturing group
\d          : Matches any digit characters (0-9)
+           : Quantifier match 1 or more of the preceding token
)           : end capturing group

2 values will results, number of total cases and total deaths

*/

$regExes[2] = '/Luxembourg\",\"confirmed\"\:(\d+),\"deaths\"\:(\d+)/';

// loop in the sources

foreach ($sources as $i => $value) {

    echo "\n";
    $outputs[$i] = file_get_contents($sources[$i]);

    echo "Source is: $sources[$i]\n";
    echo "Matching regex is: $regExes[$i]\n";

    if ($i == 0) {

        preg_match_all($regExes[0] ,$outputs[0], $matches);
        //print_r($matches);

        $totalCases = $matches[1][0];
        $totalDeath = $matches[1][1];

        echo "As of $date for Luxembourg\n";
        echo "Total number of cases are : $totalCases\n";
        echo "Total number of death are : $totalDeath\n";


    } elseif ($i == 1) {

        preg_match_all($regExes[1] ,$outputs[1], $matches);
        //print_r($matches);

        $totalCases = $matches[1][0];
        $totalDeath = $matches[2][0];

        echo "As of $date for Luxembourg\n";
        echo "Total number of cases are : $totalCases\n";
        echo "Total number of death are : $totalDeath\n";
        
    } elseif ($i == 2) {

        preg_match_all($regExes[2] ,$outputs[2], $matches);
        //print_r($matches);

        $totalCases = $matches[1][0];
        $totalDeath = $matches[2][0];

        echo "As of $date for Luxembourg\n";
        echo "Total number of cases are : $totalCases\n";
        echo "Total number of death are : $totalDeath\n";
    }

    echo "\n\n";
}

?>