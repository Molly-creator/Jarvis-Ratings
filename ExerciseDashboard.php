<?php
require('./ExerciseClass.php');

class DashBoard
{
    private array $Ratings = [];
    private array $Dates = [];

    public function __construct($Exercise)
    {   
        $this->Exercise = $Exercise;
        for ($i = 0; $i < count($Exercise); $i++) {
            $this->RatingDistribution($Exercise[$i]);
        }
    }

    private function RatingDistribution($title)
    {   
        $Ratings = $this->Ratings;
        $ExTitle = $title->getTitle();
        $ratings = $title->getRating();
        $inputDates = $title->getDate();

        $Month = $this->ParseDate($inputDates, $ExTitle);
        $Rating_1 = [];
        $Rating_2 = [];
        $Rating_3 = [];
        $Rating_4 = [];
        $Rating_5 = [];
        
        foreach($ratings as $vals) {
            if ($vals == 1) {
                array_push($Rating_1, $vals);
           } elseif ($vals == 2) {
                array_push($Rating_2, $vals);
            } elseif ($vals == 3) {
                array_push($Rating_3, $vals);
            } elseif ($vals == 4) {
                array_push($Rating_4, $vals);
            } elseif ($vals == 5) {
                array_push($Rating_5, $vals);
            }
        }

        $Ratings[$ExTitle] = [
            'month' => $Month,
            '1' => $Rating_1,
            '2' => $Rating_2,
            '3' => $Rating_3,
            '4' => $Rating_4,
            '5' => $Rating_5
        ];

              
        $this->Ratings = $Ratings;
    }
    private function ParseDate($input, $title)
    {   
        $Month[$title] = [];
        foreach ($input as  $date) {
            $Parsedate = strtotime($date);
            array_push($Month, date("M", $Parsedate));
        }
       return $Month;
    }
    public function showDashboard()
    {   $Ratings = $this->Ratings;

        echo "Dashboard ratings Bit Academy excersises" . PHP_EOL;
        $width = "| %-30.30s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.8s |\n";
        echo "---------------------------------------------------------------------------------------------------------------" . PHP_EOL;
        printf($width, "title", "total", "5 star", "4 star", "3 star", "2 star", "1 star", "mean");
        echo "---------------------------------------------------------------------------------------------------------------" . PHP_EOL;
        
        foreach ($Ratings as $title => $ArrayRatings) {
            $R5 = count($ArrayRatings[5]);
            $R4 = count($ArrayRatings[4]);
            $R3 = count($ArrayRatings[3]);
            $R2 = count($ArrayRatings[2]);
            $R1 = count($ArrayRatings[1]);
            $nRating = $R1 + $R2 + $R3 + $R4 + $R5;

            $mean = (float)(($R5 * 5 + $R4 * 4 + $R3 * 3 + $R2 * 2 + $R1 * 1) / $nRating);
        
           printf($width, $title, $nRating, $R5, $R4, $R3, $R2, $R1, $mean);
        }
        echo "|________________________________|__________|__________|__________|__________|__________|__________|__________|" . PHP_EOL;
    }

    public function displayMonthRatings($excersise)
    {   $excersise;
        $Ratings = $this->Ratings;

        echo "Overview monthly ratings " . $excersise . PHP_EOL;
        $width = "| %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s |\n";
        echo "-------------------------------------------------------------------------------------------" . PHP_EOL;
        printf($width, "month", "total", "5 star", "4 star", "3 star", "2 star", "1 star", "rating mean");
        echo "-------------------------------------------------------------------------------------------" . PHP_EOL;
        foreach ($Ratings as $title => $ArrayRatings) {
            $month = $ArrayRatings['month'];
            $R5 = count($ArrayRatings[5]);
            $R4 = count($ArrayRatings[4]);
            $R3 = count($ArrayRatings[3]);
            $R2 = count($ArrayRatings[2]);
            $R1 = count($ArrayRatings[1]);
            $nRating = $R1 + $R2 + $R3 + $R4 + $R5;

            $mean = (float)(($R5 * 5 + $R4 * 4 + $R3 * 3 + $R2 * 2 + $R1 * 1) / $nRating);
        
           printf($width, $month, $nRating, $R5, $R4, $R3, $R2, $R1, $mean);
        }
        echo "|________________________________|__________|__________|__________|__________|__________|__________|__________|" . PHP_EOL;
    }
    

}

        