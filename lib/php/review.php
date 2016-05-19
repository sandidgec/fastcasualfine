<?php

class Review implements JsonSerializable
{

    
            const __default = self::Fast;

            const Fine = 1;
            const Casual = 2;
            const Fast = 3;


    public function getReviewID($newReviewId)
    {
        return ($this->reviewID)
    }


    public function setReviewID($newReviewId)
    {
        if ($newReviewId === null) {
            $this->reviewId = null;
            return;
        }
        //verify the User is valid
        $newReviewId = filter_var($newReviewId, FILTER_VALIDATE_INT);
        if (empty($newReviewId) === true) {
            throw (new InvalidArgumentException ("review ID is invalid"));
        }
        $this->userId = $newReviewId;
    }

    public function getBuisnessId($newBuisnessId)
    {
        return ($this->buisnessId);
    }

    /**
     * mutator method for the buisnessId
     * @param int $newBuisnessId unique value to represent a user $newBuisnessId
     * @throws InvalidArgumentException for invalid content
     **/
    public function setBuisnessId($newBuisnessId)
    {
// base case: if the buisnessId is null,
// this is a new user without a mySQL assigned id (yet)
        if ($newBuisnessId === null) {
            $this->buisnessId = null;
            return;
        }
//verify the User is valid
        $newBuisnessId = filter_var($newBuisnessId, FILTER_VALIDATE_INT);
        if (empty($newBuisnessId) === true) {
            throw (new InvalidArgumentException ("buisnessID invalid"));
        }
        $this->buisnessId = $newBuisnessId;
    }
    
//user id goes here

    public function getTime($time){

    }

    public function setTime($time){
        if ($time) === null {
            $this->time = null;
            return;
        }
    }
}