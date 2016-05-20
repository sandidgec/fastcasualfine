<?php

class user implements JsonSerializable {

    private $userID;

    private $name;

    private $email;

    private $phone;

    private $zip;

    private $hash;

    private $salt;



//    private $accessLevel;


    public function __construct($newUserID, $newEmail, $newHash, $newPhone, $newSalt, $Zip, $Name)
    {
        try {
            $this->setUserId($newUserID);
            $this->seName($newName);
            $this->setEmail($newEmail);
            $this->setPhone($newPhone);
            $this->setZip($Zip);
            $this->setHash($newHash);
            $this->setSalt($newSalt);
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

    public function getUserID() {
        return ($this->userID);
    }

    public function setUserId($newUserID) {
        // base case: if the userId is null,
        // this is a new user without a mySQL assigned id (yet)
        if($newUserID === null) {
            $this->userID = null;
            return;
        }
        //verify the User is valid
        $newUserID = filter_var($newUserID, FILTER_VALIDATE_INT);
        if(empty($newUserID) === true) {
            throw (new InvalidArgumentException ("userId invalid"));
        }
        $this->userID = $newUserID;
    }

//    public function getAccessLevel() {
//        return ($this->accessLevel);
//    }
//
//    public function setAccessLevel($newAccessLevel) {
//        // verify access level is integer
//        $newAccessLevel = filter_var($newAccessLevel, FILTER_VALIDATE_INT);
//        if(empty($newAccessLevel) === true) {
//            throw new InvalidArgumentException ("Access Level Invalid");
//        }
//        if ( ($newAccessLevel !== 'A') || ($newAccessLevel !== 'U') || ($newAccessLevel !== 'S')){
//            throw new InvalidArgumentException("Access Level Invaild");
//        }
//
//        $this->accessLevel = $newAccessLevel;
//    }


    public function getEmail() {
        return ($this->email);
    }

    public function setEmail($newEmail) {
        // verify email is valid
        $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
        if(empty($newEmail) === true) {
            throw new InvalidArgumentException ("user email invalid");
        }
        if(strlen($newEmail) > 64) {
            throw(new RangeException ("Email content too large"));
        }
        $this->email = $newEmail;
    }

    public function getName() {
        return ($this->name);
    }

    public function seName($newName) {
        // verify first name is valid
        $newName = filter_var($newName, FILTER_SANITIZE_STRING);
        if(empty($newName) === true) {
            throw new InvalidArgumentException("first name invalid");
        }
        if(strlen($newName) > 32) {
            throw (new RangeException ("Name content too large"));
        }
        $this->name = $newName;
    }

public function getZip(){
    return ($this->zip);
}

public function setZip($newZip) {
    $newZip = filter_var($newZip, FILTER_SANITIZE_STRING);
    if (empty($newZip) === true) {
        throw new InvalidArgumentException("Zip invalid");
    }
    if (strlen($newZip) > 7) {
        throw (new RangeException ("Zip content too large"));
    }
    $this->zip = $newZip;
}


    public function getHash() {
        return ($this->hash);
    }


    public function setHash($newHash) {
        // verify Hash is exactly string of 128
        if((ctype_xdigit($newHash)) === false) {
            if(empty($newHash) === true) {
                throw new InvalidArgumentException ("hash invalid");
            }
            if(strlen($newHash) !== 128) {
                throw new RangeException ("hash not valid");
            }
        }
        $this->hash = $newHash;
    }

    public function getPhone() {
        return ($this->phone);
    }

    public function setPhone($newPhone) {
        //verify phone number is valid and digits only
        if((ctype_digit($newPhone)) === false) {
            throw new InvalidArgumentException ("phoneNumber invalid");
        }
        if(strlen($newPhone) > 10) {
            throw (new RangeException ("Phone Number should be formatted 5055558787"));
        }
        $this->phone = $newPhone;
    }


    public function getSalt() {
        return ($this->salt);
    }

    public function setSalt($newSalt) {
        // verify salt is exactly string of 64
        if((ctype_xdigit($newSalt)) === false) {
            if(empty($newSalt) === true) {
                throw new InvalidArgumentException ("salt invalid");
            }
            if(strlen($newSalt) !== 64) {
                throw (new RangeException ("salt not valid"));
            }
        }
        $this->salt = $newSalt;
    }

    public static function getAllUsers(PDO $pdo) {
        //create the query template
        $query = "SELECT userID, name, email, phone FROM user";
        $statement = $pdo->prepare($query);
        // execute
        $statement->execute();
        //call the function to build an array of the values
        $user = null;
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $user = new SplFixedArray($statement->rowCount());
        while(($row = $statement->fetch()) !== false) {
        try {
            if($row !== false) {
                $user = new user($row["userID"], $row["name"], $row["email"], $row["phone"]);
                $userID[$userID->key()] = $user;
                $user->next();
                }
            } catch(Exception $exception) {

            throw(new PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return $user;
    }
    
    public function JsonSerialize() {
        $fields = get_object_vars($this);
        unset ($fields["salt"]);
        unset ($fields["hash"]);
        return ($fields);
    }

    public static function getUserByUserID(PDO $pdo, $user) {

        $userID = filter_var($user, FILTER_VALIDATE_INT);

        if($userID === false) {
            throw(new PDOException(""));
        }
        if($userID <= 0) {
            throw(new PDOException("userID is not positive"));
        }
        // create query template
        $query = "SELECT userID, email, name, phone FROM user WHERE userID = :userID";
        $statement = $pdo->prepare($query);
        // bind the bulletinid to the place holder in the template
        $parameters = array("user" => $user);
        $statement->execute($parameters);

        $user= null;
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();

        // grab the bulletin from mySQL
        try {
            if($row !== false) {
                $user = new user ($row["userId"], $row["name"], $row["email"], $row["phone"]);
                $userID[$userID->key()] = $user;
                $userID->next();
            }
        } catch(Exception $exception) {
            // if the row couldn't be converted, rethrow it
            throw(new PDOException($exception->getMessage(), 0, $exception));
        }
        return $user;
    }


    public function insert(PDO &$pdo)
{
    // make sure user doesn't already exist
    if ($this->userID !== null) {
        throw (new PDOException("existing user"));
    }
        //create query template
        $query
            = "INSERT INTO 'user'(name, email, phone, zip, salt, hash)" .
                "VALUES ( :name, :email, :hash, :phone, :salt, :zip)";
        $statement = $pdo->prepare($query);
        // bind the variables to the place holders in the template
        $parameters = array("name" => $this->name, "email" => $this->email,
            "hash" => $this->hash, "phone" => $this->phone,
            "salt" => $this->salt, "zip" => $this->zip);
        $statement->execute($parameters);
        //update null userId with what mySQL just gave us
        $this->userID = intval($pdo->lastInsertId());

    }


    public function delete(PDO $pdo) {

        if ($this->userID === null){
            throw(new PDOException("unable to delete a project that does not exist"));
        }

        //create query template
        $query = "DELETE FROM 'user' WHERE userID = :userID";
        $statement = $pdo->prepare($query);

        $parameters = array("userID" => $this->userID);
        $statement->execute($parameters);
    }

    public function update(PDO $pdo) {
        // create query template
        $query = "UPDATE 'user' SET name = :name, email = :email, phone = :phone, zip = :zip WHERE userID = :userID";
        $statement = $pdo->prepare($query);
        // bind the member variables
        $parameters = array("userID" => $this->userID, "name" => $this->name, "email" => $this->email, "phone"=> $this->phone, "zip" => $this->zip);
        $statement->execute($parameters);
    }



}