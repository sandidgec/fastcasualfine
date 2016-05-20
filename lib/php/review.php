<?php

class review implements JsonSerializable
{
    private $reviewID;

    private $businessId;

    private $userId;

    private $time;


    public function __construct($newBusinessId, $newEmail, $newName, $newPhone, $newWebsite, $newAddress, $newZip )
    {
        try {
            $this->setReviewID ($newReviewId);
            $this->setBusinessId ($newBusinessId);
            $this->setUserId ($newUserId);
            $this->setTime($newTime);
        } catch (InvalidArgumentException $invalidArgument) {
            //rethrow the exception to the caller
            throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        } catch (RangeException $range) {
            // rethrow the exception to the caller
            throw (new RangeException($range->getMessage(), 0, $range));
        } catch (Exception $exception) {
            // rethrow generic exception
            throw(new Exception($exception->getMessage(), 0, $exception));
        }
    }





    const __default = self::Fast;

    const Fine = 1;
    const Casual = 2;
    const Fast = 3;


    public function getReviewID($newReviewId)
    {
        return ($this->reviewID);
    }


    public function setReviewID($newReviewId)
    {
        if ($newReviewId === null) {
            $this->review = null;
            return;
        }
        //verify the review is valid
        $newReviewId = filter_var($newReviewId, FILTER_VALIDATE_INT);
        if (empty($newReviewId) === true) {
            throw (new InvalidArgumentException ("review ID is invalid"));
        }
        $this->userId = $newReviewId;
    }

    public function getBuisnessId($newBusinessId)
    {
        return ($this->businessId);
    }

    /**
     * mutator method for the buisnessId
     * @param int $newBuisnessId unique value to represent a user $newBuisnessId
     * @throws InvalidArgumentException for invalid content
     **/
    public function setBuisnessId($newBusinessId)
    {
// base case: if the buisnessId is null,
// this is a new user without a mySQL assigned id (yet)
        if ($newBusinessId === null) {
            $this->businessId = null;
            return;
        }
//verify the User is valid
        $newBusinessId = filter_var($newBusinessId, FILTER_VALIDATE_INT);
        if (empty($newBusinessId) === true) {
            throw (new InvalidArgumentException ("buisnessID invalid"));
        }
        $this->businessId = $newBusinessId;
    }

    public function setUserId($newUserId)
    {


        if ($newUserId === null) {
            $this->userId = null;
            return;
        }

        $newUserId = filter_var($newUserId, FILTER_VALIDATE_INT);
        if (empty($newUserId) === true) {
            throw (new InvalidArgumentException ("userId invalid"));
        }
        $this->userId = $newUserId;
    }


    public function getTime($time)
    {

    }

    public function setTime($time)
    {
        if ($time === null) {
        $this->time = null;
        return;
    }
    }

    function validateDate($time)
    {
        // base case: if the date is a DateTime object, there's no work to be done
        if (is_object($time) === true && get_class($time) === "DateTime") {
            return ($time);
        }
        // treat the date as a mySQL date string: Y-m-d H:i:s
        $time = trim($time);
        if ((preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/", $time, $matches)) !== 1) {
            throw(new InvalidArgumentException("date is not a valid date"));
        }
        // verify the date is really a valid calendar date
        $year = intval($matches[1]);
        $month = intval($matches[2]);
        $day = intval($matches[3]);
        $hour = intval($matches[4]);
        $minute = intval($matches[5]);
        $second = intval($matches[6]);
        if (checkdate($month, $day, $year) === false) {
            throw(new RangeException("date $time is not a Gregorian date"));
        }



    }
    public function JsonSerialize()
    {
        $fields = get_object_vars($this);
        return ($fields);
    }
}

/**
 * Inserts Bulletin into mySQL
 *
 * Inserts this bulletinId into mySQL in intervals
 * @param PDO $pdo connection to
 **/
public function insert(PDO &$pdo)
{
    // make sure bulletin doesn't already exist
    if ($this->ReviewId !== null) {
        throw (new PDOException("existing bulletin"));
    }
    //create query template
    $query
        = "INSERT INTO review (userId, buisnessId, time)" .
        "VALUES (:userId, :buisnessId, :time)";
    $statement = $pdo->prepare($query);
    // bind the variables to the place holders in the template
    $parameters = array("userId" => $this->userId, "buisnessId" => $this->buisnessId, "time" => $this->time);
    $statement->execute($parameters);
    //update null bulletinId with what mySQL just gave us
    $this->reviewId = intval($pdo->lastInsertId());

    /**
     * Deletes Bulletin from mySQL
     *
     * Delete PDO to delete bulletinId
     * @param PDO $pdo
     **/
    public function delete(PDO &$pdo) {
    // enforce the bulletin is not null
    if($this->reviewId === null) {
        throw(new PDOException("unable to delete a bulletin that does not exist"));
    }
    //create query template
    $query = "DELETE FROM review WHERE ReviewId = :ReviewId";
    $statement = $pdo->prepare($query);
    //bind the member variables to the place holder in the template
    $parameters = array("reviewId" => $this->ReviewId);
    $statement->execute($parameters);
}



    public static function getAllReviews(PDO &$pdo) {
    // create query template
    $query = "SELECT reviewId, businessId, userId, time, FROM review";
    $statement = $pdo->prepare($query);
    // grab the bulletin from mySQL
    try {
        $review = null;
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();
        if($row !== false) {
            $review = new Review ($row["reviewId"], $row["businessId"], $row["userId"], $row["time"]);
        }
    } catch(Exception $exception) {
        // if the row couldn't be converted, rethrow it
        throw(new PDOException($exception->getReview(), 0, $exception));
    }
    return ($review);
}
    public static function getBusinessByBusinessId(PDO &$pdo, $bulletin) {
    if($bulletin === false) {
        throw(new PDOException(""));
    }
    // create query template
    $query = "SELECT ReviewId, businessId, userId, time;
        FROM review WHERE reviewId = :reviewId";
    $statement = $pdo->prepare($query);
    // bind the bulletinid to the place holder in the template
    $parameters = array("reviewId" => $review);
    $statement->execute($parameters);
    // grab the bulletin from mySQL
    try {
        $review= null;
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();
        if($row !== false) {
            $review = new reviewId ($row["reviewId"], $row["businessId"], $row["userId"], $row["time"]);
        }
    } catch(Exception $exception) {
        // if the row couldn't be converted, rethrow it
        throw(new PDOException($exception->getMessage(), 0, $exception));
    }
    return ($business);
}
}