<?php
require('./ExerciseDashboard.php');

// Open en read CSV file
$file = './ratings.csv';
$Bitdata = [];
$file = fopen($file, 'r');

// Loop through CSV file and append rows to array
$file = fopen("./ratings.csv","r");
while(! feof($file))
  {
    $data = fgetcsv($file);
    array_push($Bitdata, $data);
  }

//Close file
fclose($file);

// New object for each exercise in dataset 
$Ex1 = new Exercise('Flex met boxen');
$Ex2 = new Exercise('Commandline commands');
$Ex3 = new Exercise('Read that data');
$Ex4 = new Exercise('Maak een kattenwebsite');
$Ex5 = new Exercise('Hover kan je gaan');

// Loop through dataset, select column 3 and 4.
// Add data (columns) to object
for ($i = 1; $i < count($Bitdata); $i++) {
    if ($Bitdata[$i][0] == 'Flex met boxen') {
        $Ex1->AddRatings((int)$Bitdata[$i][3]);
        $Ex1->Ratingdate($Bitdata[$i][4]);
    } elseif ($Bitdata[$i][0] == 'Commandline commands') {
        $Ex2->AddRatings((int)$Bitdata[$i][3]);
        $Ex2->Ratingdate($Bitdata[$i][4]);
    } elseif ($Bitdata[$i][0] == 'Read that data') {
        $Ex3->AddRatings((int)$Bitdata[$i][3]);
        $Ex3->Ratingdate($Bitdata[$i][4]);
    } elseif ($Bitdata[$i][0] == 'Maak een kattenwebsite') {
        $Ex4->AddRatings((int)$Bitdata[$i][3]);
        $Ex4->Ratingdate($Bitdata[$i][4]);
    } elseif ($Bitdata[$i][0] == 'Hover kan je gaan') {
        $Ex5->AddRatings((int)$Bitdata[$i][3]);
        $Ex5->Ratingdate($Bitdata[$i][4]);
    }
}
//New object
$DashBoard = new DashBoard([$Ex1, $Ex2, $Ex3, $Ex4, $Ex5]);

$Flex_Pre = [];
$Flex_Post = [];

for ($i = 1; $i < count($Bitdata); $i++) {
    if ($Bitdata[$i][0] == 'Flex met boxen') {
        $rating = (int)$Bitdata[$i][3];
        $Parsedate = strtotime($Bitdata[$i][4]);
        $Fulldatum = date("d m Y", $Parsedate);
        $month = date("m", $Parsedate);
        $year = date("Y", $Parsedate);

        if ($month <= 4 && $year == 2021) {
            array_push($Flex_Pre, $rating);
        } elseif ($month >= 5 && $year == 2021) {
            array_push($Flex_Post, $rating);
       }
    }
}

//Addition statistics Flex met boxen exercise
$FlexPostN = count($Flex_Post);
$FlexPostSum = array_sum($Flex_Post);
$FlexPostMean = round(($FlexPostSum/$FlexPostN),2);
$FlexPreN  = count($Flex_Pre);
$FlexPreSum = array_sum($Flex_Pre);
$FlexPreMean = round(($FlexPreSum/$FlexPreN),2);

$FlexPreDist = array_count_values($Flex_Pre);
$FlexPostDist = array_count_values($Flex_Post);