<?php

class Exercise
{
    public $title;
    public $userRating = [];
    public $ratingDate = [];

    public function __construct($title)
    {  
        $this->title = $title;
    }
    public function AddRatings($Ratings)
    {
        $userRating = $this->userRating;
        array_push($userRating, $Ratings);
        $this->userRating = $userRating;

    }
    public function Ratingdate($Dates)
    {
        $ratingDate = $this->ratingDate;
        array_push($ratingDate, $Dates);
        $this->ratingDate = $ratingDate;

    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getRating()
    {
        return $this->userRating;
    }
    public function getDate()
    {   
        
        return $this->ratingDate;
    }
}


?>