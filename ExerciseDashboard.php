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
        $Dates = [];

        foreach ($inputDates as  $date) {
                $Parsedate = strtotime($date);
                array_push($Dates, date("M", $Parsedate));
        }
        
        $Ratings[$ExTitle] = [];
        for($i=0;$i<count($ratings);$i++) {
                array_push($Ratings[$ExTitle], $ratings[$i], $Dates[$i]);
        }

        $this->Ratings = $Ratings;
        $this->Dates = $Dates;
    }

    public function showDashboard()
    {   
        $Ratings = $this->Ratings;

        echo "<table>"; 
        echo "<tr><th>Dashboard ratings Bit Academy excersises</th></tr>" . PHP_EOL;
        echo "<tr><td>title</td><td>total</td><td>5 star</td><td>4 star</td><td>3 star</td><td>2 star</td><td>1 star</td><td>mean</td><tr>";       
        foreach ($Ratings as $title => $x) {
            
                $RatingDist = array_count_values($x);
                $nRating = ($RatingDist[5]  + $RatingDist[4] + $RatingDist[3]  + $RatingDist[2]  + $RatingDist[1]);
                $mean = round((float)(($RatingDist[5] * 5 + $RatingDist[4] * 4 + $RatingDist[3] * 3 + $RatingDist[2] * 2 + $RatingDist[1] * 1) / $nRating), 2);

        
        echo "<tr><td>$title</td><td>$nRating</td><td>$RatingDist[5]</td><td>$RatingDist[4]</td><td>$RatingDist[3]</td><td>$RatingDist[2]</td><td>$RatingDist[1]</td><td>$mean</td></tr>";
        }
        echo "</table>";

        // $this->Ratings = $Ratings;
    }

    public function displayMonthRatings($excersise)
    {   $excersise = (string)$excersise;
        $Ratings = $this->Ratings;
        $ExRating = $Ratings[$excersise];

        $Rjan = [];
        $Rfeb = [];
        $Rmar = [];
        $Rapr = [];
        $Rmay = [];
        $Rjun = [];
        $Rjul = [];
        $Raug = [];
        $Rsep = [];
        $Roct = [];
        $Rnov = [];
        $Rdec = [];
        
         for ($i = 0; $i < count($ExRating) - 1; $i++) {;
            if(!is_numeric($ExRating[$i])) {
                $month = $ExRating[$i];
                $R = $ExRating[$i - 1];

               if ($month == 'Jan') {
                    array_push($Rjan, $R);
                } elseif ($month == 'Feb')  {
                    array_push($Rfeb, $R);
                } elseif ($month == 'Mar')  {
                    array_push($Rmar, $R);
                } elseif ($month == 'Apr')  {
                    array_push($Rapr, $R);
                } elseif ($month == 'May')  {
                    array_push($Rmay, $R);
                } elseif ($month == 'Jun')  {
                    array_push($Rjun, $R);
                } elseif ($month == 'Jul')  {
                    array_push($Rjul, $R);
                } elseif ($month == 'Aug')  {
                    array_push($Raug, $R);
                } elseif ($month == 'Sep')  {
                    array_push($Rsep, $R);
                } elseif ($month == 'Oct')  {
                    array_push($Roct, $R);
                } elseif ($month == 'Nov')  {
                    array_push($Rnov, $R);
                } elseif ($month == 'Dec')  {
                    array_push($Rdec, $R);
                }

            }
            $DistMonth = [
                'januari' => $Rjan,
                'februari' => $Rfeb,
                'maart' => $Rmar,
                'april' => $Rapr,
                'mei' => $Rmay,
                'juni' => $Rjun,
                'juli' => $Rjul,
                'augustus' => $Raug,
                'september' => $Rsep,
                'oktober' => $Roct,
                'november' => $Rnov,
                'december' => $Rdec,
            ];  
        }
        echo "<table>"; 
        echo "<tr><th>Dashboard monthly ratings <span>$excersise</span></th></tr>". PHP_EOL;
        echo "<tr><td>month</td><td>total</td><td>5 star</td><td>4 star</td><td>3 star</td><td>2 star</td><td>1 star</td><td>mean</td><tr>";

        foreach ($DistMonth as $month => $val) {
            $RMdist = array_count_values($val);
            if (empty($RMdist[5])) {
                $RM5 = 0;
            } else {
              $RM5 = $RMdist[5];  
            }
            if (empty($RMdist[4])) {
                $RM4 = 0;
            } else {
              $RM4 = $RMdist[4];  
            }
            if (empty($RMdist[3])) {
                $RM3 = 0;
            } else {
              $RM3 = $RMdist[3];  
            }
            if (empty($RMdist[2])) {
                $RM2 = 0;
            } else {
              $RM2 = $RMdist[2];  
            }
            if (empty($RMdist[1])) {
                $RM1 = 0;
            } else {
              $RM1 = $RMdist[1];  
            }
           
            $nRating = count($val);
            $mean = round((float)(($RM5 * 5 + $RM4 * 4 +  $RM3 * 3 +  $RM2 * 2 +  $RM1 * 1) / $nRating), 2);
        
           echo "<tr><td>$month</td><td>$nRating</td><td>$RM5</td><td>$RM4</td><td> $RM3</td><td>$RM2</td><td>$RM1</td><td>$mean</td></tr>";
        }
        echo "</table>"; 
    }
}