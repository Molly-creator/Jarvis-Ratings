<?php

require('./ExerciseDashboard.php');
// require('./test.php');

$file = './ratings.csv';
$Bitdata = [];
$file = fopen($file, 'r');

if ($file === false) {
    die('Er gaat iets mis met' . $file);
}

$file = fopen("./ratings.csv","r");
while(! feof($file))
  {
    $data = fgetcsv($file);
    array_push($Bitdata, $data);
  }

fclose($file);

$ExerciseTitle = [];
for ($i = 1; $i < count($Bitdata); $i++) {
    array_push($ExerciseTitle, $Bitdata[$i][0]);
}

// $UniqueExercises = array_unique($ExerciseTitle);
// echo "Er zijn " . count($UniqueExercises) . " opdrachten in de Jarvis dataset : " . PHP_EOL;
// foreach ($UniqueExercises as $title) {
//     echo $title . PHP_EOL;
// }

$Ex1 = new Exercise('Flex met boxen');
$Ex2 = new Exercise('Commandline commands');
$Ex3 = new Exercise('Read that data');
$Ex4 = new Exercise('Maak een kattenwebsite');
$Ex5 = new Exercise('Hover kan je gaan');



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

$DashBoard = new DashBoard([$Ex1, $Ex2, $Ex3, $Ex4, $Ex5]);


$DashBoard ->showDashboard();
$DashBoard ->displayMonthRatings('Flex met boxen');
$DashBoard ->displayMonthRatings('Commandline commands');
$DashBoard ->displayMonthRatings('Read that data');
$DashBoard ->displayMonthRatings('Maak een kattenwebsite');
$DashBoard ->displayMonthRatings('Hover kan je gaan');

