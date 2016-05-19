<?php

class Bulletin implements JsonSerializable {

    private $bulletinId;

    private $userId;

    private $category;

    private $message;

    public function __construct($newBulletinId, $newUserId, $newCategory, $newMessage)
    {
        try {
            $this->setBulletinId($newBulletinId);
            $this->setUserId($newUserId);
            $this->setCategory($newCategory);
            $this->setMessage($newMessage);
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

    public function getBulletinId()
    {
        return ($this->bulletinId);
    }

    public function setBulletinId($newBulletinId)
    {
        // base case: if the bulletinId is null,
        // this is a new bulletin without a mySQL assigned id (yet)
        if ($newBulletinId === null) {
            $this->bulletinId = null;
            return;
        }
        //verify the User is valid
        $newBulletinId = filter_var($newBulletinId, FILTER_VALIDATE_INT);
        if (empty($newBulletinId) === true) {
            throw (new InvalidArgumentException ("bulletinId invalid"));
        }
        $this->bulletinId = $newBulletinId;
    }

    public function getUserId() {
        return ($this->userId);
    }

    public function setUserId($newUserId) {
        // verify access level is integer
        $newUserId = filter_var($newUserId, FILTER_VALIDATE_INT);
        if(empty($newUserId) === true) {
            throw new InvalidArgumentException ("User Id Invalid");
        }
        $this->userId = $newUserId;
    }

    public function getCategory()
    {
        return ($this->category);
    }

    public function setCategory($newCategory)
    {
        // verify category is valid
        $newCategory = filter_var($newCategory, FILTER_SANITIZE_STRING);
        if (empty($newCategory) === true) {
            throw new InvalidArgumentException("category invalid");
        }
        if (strlen($newCategory) > 32) {
            throw (new RangeException ("Category name too large"));
        }
        $this->category = $newCategory;
    }

    public function getMessage()
    {
        return ($this->message);
    }

    public function setMessage($newMessage)
    {
        // verify message is valid
        $newMessage = filter_var($newMessage, FILTER_SANITIZE_STRING);
        if (empty($newMessage) === true) {
            throw new InvalidArgumentException("message invalid");
        }
        $this->category = $newMessage;
    }
    public function JsonSerialize()
    {
        $fields = get_object_vars($this);
        return ($fields);
    }

    public function insert(PDO &$pdo)
    {
        // make sure bulletin doesn't already exist
        if ($this->bulletinId !== null) {
            throw (new PDOException("existing bulletin"));
        }
        //create query template
        $query
            = "INSERT INTO bulletin(userId, category, message)" .
            "VALUES (:userId, :category, :message)";
        $statement = $pdo->prepare($query);
        // bind the variables to the place holders in the template
        $parameters = array("userId" => $this->userId, "category" => $this->category, "message" => $this->message);
        $statement->execute($parameters);
        //update null bulletinId with what mySQL just gave us
        $this->bulletinId = intval($pdo->lastInsertId());
    }

    public function delete(PDO &$pdo) {
        // enforce the bulletin is not null
        if($this->bulletinId === null) {
            throw(new PDOException("unable to delete a bulletin that does not exist"));
        }
        //create query template
        $query = "DELETE FROM bulletin WHERE bulletinId = :bulletinId";
        $statement = $pdo->prepare($query);
        //bind the member variables to the place holder in the template
        $parameters = array("bulletinId" => $this->bulletinId);
        $statement->execute($parameters);
    }

    public function update(PDO $pdo) {
        // create query template
        $query = "UPDATE bulletin SET userId = :userId, category = :category, message = :message WHERE bulletinId = :bulletinId";
        $statement = $pdo->prepare($query);
        // bind the member variables
        $parameters = array("userId" => $this->userId, "category" => $this->category, "message" => $this->message,
            "bulletinId" => $this->bulletinId);
        $statement->execute($parameters);
    }

    public static function getBulletinByBulletinId(PDO $pdo, $bulletinId) {
        // sanitize the bulletinId before searching
        $bulletinId = filter_var($bulletinId, FILTER_VALIDATE_INT);
        if($bulletinId === false) {
            throw(new PDOException("bulletin id is not an integer"));
        }
        if($bulletinId <= 0) {
            throw(new PDOException("bulletin id is not positive"));
        }
        // create query template
        $query = "SELECT bulletinId, userId, category, message FROM user WHERE bulletinId = :bulletinId";
        $statement = $pdo->prepare($query);
        // bind the bulletin id to the place holder in the template
        $parameters = array("bulletinId" => $bulletinId);
        $statement->execute($parameters);
        // grab the bulletin from mySQL
        try {
            $bulletin = null;
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !== false) {
                $bulletin = new Bulletin ($row["bulletinId"], $row["userId"], $row["category"], $row["message"]);
            }
        } catch(Exception $exception) {
            // if the row couldn't be converted, rethrow it
            throw(new PDOException($exception->getMessage(), 0, $exception));
        }
        return ($bulletin);
    }

    public static function getBulletinByCategory(PDO &$pdo, $bulletin) {
        if($bulletin === false) {
            throw(new PDOException(""));
        }
        // create query template
        $query = "SELECT bulletinId, userId, category, message
        FROM bulletin WHERE category = :category";
        $statement = $pdo->prepare($query);
        // bind the bulletinid to the place holder in the template
        $parameters = array("category" => $bulletin);
        $statement->execute($parameters);
        // grab the bulletin from mySQL
        try {
            $bulletin= null;
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !== false) {
                $bulletin = new Bulletin ($row["bulletinId"], $row["userId"], $row["category"], $row["message"]);
            }
        } catch(Exception $exception) {
            // if the row couldn't be converted, rethrow it
            throw(new PDOException($exception->getMessage(), 0, $exception));
        }
        return ($bulletin);
    }

    public static function getAllBulletins(PDO &$pdo) {
        // create query template
        $query = "SELECT bulletinId, userId, category, message FROM bulletin";
        $statement = $pdo->prepare($query);
        // grab the bulletin from mySQL
        try {
            $bulletin = null;
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !== false) {
                $bulletin = new Bulletin ($row["bulletinId"], $row["userId"], $row["category"], $row["message"]);
            }
        } catch(Exception $exception) {
            // if the row couldn't be converted, rethrow it
            throw(new PDOException($exception->getMessage(), 0, $exception));
        }
        return ($bulletin);
    }
}