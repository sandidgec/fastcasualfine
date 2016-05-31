<?php

class review implements JsonSerializable
{
    //comments
    private $reviewId;

    private $businessId;

    private $userID;

    private $rating;

    private $date;

    public function __construct($newReviewId, $newBusinessId, $newUserID, $rating, $newdate)
    {
        try {
            $this->setReviewId($newReviewId);
            $this->setBusinessId($newBusinessId);
            $this->setUserID($newUserID);
            $this->setRating($rating);
            $this->setdate($newdate);
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
    

    public function getReviewId()
    {
        return ($this->reviewId);
    }


    public function setReviewId($newReviewId)
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
        $this->reviewId = $newReviewId;
    }

    public function getBusinessId()
    {
        return ($this->businessId);
    }

    /**
     * mutator method for the businessId
     * @param int $newBusinessId unique value to represent a user $newBusinessId
     * @throws InvalidArgumentException for invalid content
     **/
    public function setBusinessId($newBusinessId)
    {
// base case: if the businessId is null,
// this is a new user without a mySQL assigned id (yet)
        if ($newBusinessId === null) {
            $this->businessId = null;
            return;
        }
//verify the User is valid
        $newBusinessId = filter_var($newBusinessId, FILTER_VALIDATE_INT);
        if (empty($newBusinessId) === true) {
            throw (new InvalidArgumentException ("businessId invalid"));
        }
        $this->businessId = $newBusinessId;
    }

    public function getUserID()
    {
        return ($this->userID);
    }

    public function setUserID($newUserID)
    {


        if ($newUserID === null) {
            $this->userID = null;
            return;
        }

        $newUserID = filter_var($newUserID, FILTER_VALIDATE_INT);
        if (empty($newUserID) === true) {
            throw (new InvalidArgumentException ("userId invalid"));
        }
        $this->userID = $newUserID;
    }

    public function getRating()
    {
        return ($this->rating);
    }

    public function setRating($rating)
    {
        $rating = filter_var($rating, FILTER_SANITIZE_STRING);
        if ($rating === false){
            throw(new InvalidArgumentException("Rating is corrupt or empty"));
        }
        $rating = strtolower($rating);

        if ($rating === "fast"){
            $this->rating = $rating;
        } elseif ($rating === "casual"){
            $this->rating = $rating;
        } elseif ($rating === "fine"){
            $this->rating = $rating;
        } else {
            throw (new RangeException("Rating must be fast, casual, or fine"));
        }
    }
    


    public function getdate()
    {
        return ($this->date);
    }

    public function setdate($date)  
    {
        //If date is null, set current time and date
            if($date === null) {
                $this->date = new DateTime();
                return;
            }

        // store the schedule start date
        try {
            $date = $this->validateDate($date);
        } catch(InvalidArgumentException $invalidArgument) {
            throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        } catch(RangeException $range) {
            throw(new RangeException($range->getMessage(), 0, $range));
        }

        $this->date = $date;
    }

    function validateDate($date)  
    {
        // base case: if the date is a Datedate object, there's no work to be done
        if (is_object($date) === true && get_class($date) === "Datedate") {
            return ($date);
        }
        // treat the date as a mySQL date string: Y-m-d
        $date = trim($date);
        if ((preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $matches)) !== 1) {
            throw(new InvalidArgumentException("date is not a valid date"));
        }
        // verify the date is really a valid calendar date
        $year = intval($matches[1]);
        $month = intval($matches[2]);
        $day = intval($matches[3]);

        if (checkdate($month, $day, $year) === false) {
            throw(new RangeException("datedate is not a Gregorian date"));
        }
        return ($date);
    }

    public function JsonSerialize()
    {
        $fields = get_object_vars($this);
        return ($fields);
    }


    /**
     * Inserts Bulletin into mySQL
     *
     * Inserts this bulletinId into mySQL in intervals
     * @param PDO $pdo connection to
     **/public function insert(PDO $pdo)
{
    // make sure bulletin doesn't already exist
    if ($this->reviewId !== null) {
        throw (new PDOException("existing bulletin"));
    }
        //create query template
        $query = "INSERT INTO review (userID, businessID, rating, date)
                 VALUES (:userID, :businessID, :rating, :date)";
        $statement = $pdo->prepare($query);

        $d = $this->date->format("Y-m-d");
        // bind the variables to the place holders in the template
        $parameters = array("userID" => $this->userID, "businessID" => $this->businessId,"rating" => $this->rating, "date" => $d);
        $statement->execute($parameters);
    
        //update null bulletinId with what mySQL just gave us
        $this->reviewId = intval($pdo->lastInsertId());
}
    public function update(PDO $pdo)
    {

        $query = "UPDATE review SET userID = :userID, businessID = :businessID, rating = :rating, date = :date ";
        $statement = $pdo->prepare($query);

        $d = $this->date->format("Y-m-d");

        $parameters = array ("userID" => $this->userID, "businessID" => $this->businessId, "rating" => $this->rating, "date" => $d );
        $statement->execute($parameters);
    }
    
    
        /**
         * Deletes Bulletin from mySQL
         *
         * Delete PDO to delete bulletinId
         * @param PDO $pdo
         **/
    public function delete(PDO $pdo)
    {

        //create query template
        $query = "DELETE FROM review WHERE reviewID = :reviewID";
        $statement = $pdo->prepare($query);

        //bind the member variables to the place holder in the template
        $parameters = array("reviewID" => $this->reviewId);
        $statement->execute($parameters);
    }

    /**
     * Get all reviews
     * 
     * @param PDO $pdo pointer to PDO
     * @return mixed reviews
     */

    public static function getAllReviews(PDO $pdo)
    {
        // create query template
        $query = "SELECT reviewID, businessID, userID, rating, date FROM review";
        $statement = $pdo->prepare($query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $reviews = new SplFixedArray($statement->rowCount());
        // grab the bulletin from mySQL
        while ($row = $statement->fetch()) {
            try {
                if ($row !== false) {
                    $date = new DateTime($row["date"]);
                    $review = new Review ($row["reviewID"], $row["businessID"], $row["userID"], $row["rating"], $date->format("Y-m-d"));
                    $reviews[$reviews->key()] = $review;
                    $reviews->next();
                }
            } catch (Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return ($reviews);
    }

    /**
     * get business by category
     * 
     * @param PDO $pdo
     * @param $reviewId
     * @return null|review
     */

        public static function getReviewByReviewID(PDO $pdo, $reviewId)
        {
            if ($reviewId === false) {
                throw(new PDOException(""));
            }
            // create query template
            $query = "SELECT reviewID, businessID, userID, date, rating FROM review WHERE reviewID = :reviewID";
            $statement = $pdo->prepare($query);
            // bind the reviewId to the place holder in the template
            $parameters = array("reviewID" => $reviewId);
            $statement->execute($parameters);
            $review = null;
            // grab the bulletin from mySQL
            try {
                
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $row = $statement->fetch();
                if ($row !== false) {
                    $date = new DateTime($row["date"]);
                    $review = new review ($row["reviewID"], $row["businessID"], $row["userID"], $row["rating"], $date->format("Y-m-d"));
                }
            } catch (Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new PDOException($exception->getMessage(), 0, $exception));
            }
            return ($review);
        }

        public static function getALLReviewsByBusinessID(PDO $pdo)
        {
            // create query template
            $query = "SELECT reviewID, businessID, userID, rating, date FROM review WHERE businessID = :businessID";
            $statement = $pdo->prepare($query);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $reviews = new SplFixedArray($statement->rowCount());
            // grab the bulletin from mySQL
            while ($row = $statement->fetch()) {
                try {
                    if ($row !== false) {
                        $date = new DateTime($row["date"]);
                        $review = new Review ($row["reviewID"], $row["businessID"], $row["userID"], $row["rating"], $date->format("Y-m-d"));
                        $reviews[$reviews->key()] = $review;
                        $reviews->next();
                    }
                } catch (Exception $exception) {
                    // if the row couldn't be converted, rethrow it
                    throw(new PDOException($exception->getMessage(), 0, $exception));
                }
            }
            return ($reviews);
        }

        public static function getAllReviewsByUserID(PDO $pdo)
        {
            // create query template
            $query = "SELECT reviewID, businessID, userID, rating, date FROM review WHERE userID = :userID";
            $statement = $pdo->prepare($query);
            
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $reviews = new SplFixedArray($statement->rowCount());
            // grab the bulletin from mySQL
            while ($row = $statement->fetch()) {
                try {
                    if ($row !== false) {
                        $date = new DateTime($row["date"]);
                        $review = new Review ($row["reviewID"], $row["businessID"], $row["userID"], $row["rating"], $date->format("Y-m-d"));
                        $reviews[$reviews->key()] = $review;
                        $reviews->next();
                    }
                } catch (Exception $exception) {
                    // if the row couldn't be converted, rethrow it
                    throw(new PDOException($exception->getMessage(), 0, $exception));
                }
            }
            return ($reviews);
        }

}
