<?php
require('./ExerciseClass.php');

class DashBoard
{
    private array $Ratings = [];
    private array $Dates = [];
    private $Exercise;
    private $Mean;

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
        $Dates = $title->getDate();

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
            '1' => count($Rating_1), 
            '2' => count($Rating_2),
            '3' => count($Rating_3),
            '4' => count($Rating_4),
            '5' => count($Rating_5)
        ];
        
        $this->Ratings = $Ratings;
        $this->Dates = $Dates;
        $this->RatingMeans();
        $this->RatingMonth();

    }
    private function RatingMeans()
    {   
        $Ratings = $this->Ratings;
      
    }
    private function RatingMonth()
    {   
        $Dates = $this->Dates;
        foreach ($Dates as $date) {
            echo $date . PHP_EOL;
        //   parse_str();
        }
        
    }
    public function showDashboard()
    {   $Ratings = $this->Ratings;

        echo "Dashboard ratings Bit Academy excersises" . PHP_EOL;
        $width = "| %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s |\n";
        echo "-------------------------------------------------------------------------------------------" . PHP_EOL;
        printf($width, "month", "total", "5 star", "4 star", "3 star", "2 star", "1 star", "rating mean");
        echo "-------------------------------------------------------------------------------------------" . PHP_EOL;
       
        //    printf($width, $title, $total, $R5, $R4, $R3, $R2, $R1, $mean);
        
        echo "|__________|__________|__________|__________|__________|__________|__________|____________|" . PHP_EOL;
    }

    public function displayMonthRatings($excersise)
    {   $excersise;
        $Dates = $this->Dates;




        echo "Overview monthly ratings " . $excersise . PHP_EOL;
        $width = "| %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s | %-8.10s |\n";
        echo "-------------------------------------------------------------------------------------------" . PHP_EOL;
        printf($width, "month", "total", "5 star", "4 star", "3 star", "2 star", "1 star", "rating mean");
        echo "-------------------------------------------------------------------------------------------" . PHP_EOL;
       
        //    printf($width, $month, $total, $R5, $R4, $R3, $R2, $R1, $mean);
        
        echo "|__________|__________|__________|__________|__________|__________|__________|____________|" . PHP_EOL;
    }
    

}

        