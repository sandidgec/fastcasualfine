<?php

class Review implements JsonSerializable
{
            const __default = self::Fast;

            const Fine = 1;
            const Casual = 2;
            const Fast = 3;


    public function getReviewID($newReviewID)
    {
        return ($this->reviewID)
    }


    public function setReviewID($newReviewID)
    {
        if ($newReviewID === null) {
            $this->reviewID = null;
            return;
        }
        //verify the User is valid
        $newReviewID = filter_var($newReviewID, FILTER_VALIDATE_INT);
        if (empty($newReviewID) === true) {
            throw (new InvalidArgumentException ("review ID is invalid"));
        }
        $this->userId = $newReviewID;
    }

    public function getBuisnessId()
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