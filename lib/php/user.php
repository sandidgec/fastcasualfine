<?php

class user implements JsonSerializable {

    private $userID;

    private $email;

    private $firstName;

    private $lastName;

    private $hash;

    private $salt;

    private $phone;

    private $zip;

    private $accessLevel;

    private $address;

    public function __construct($newUserID, $newAccessLevel, $newEmail, $newFirstName, $newHash, $newLastName,
                                $newPhone, $newSalt, $Zip ,$Address)
    {
        try {
            $this->setUserId($newUserID);
            $this->setEmail($newEmail);
            $this->setFirstName($newFirstName);
            $this->setLastName($newLastName);
            $this->setPhone($newPhone);
            $this->setZip($Zip);
            $this->setAccessLevel($newAccessLevel);
            $this->setHash($newHash);
            $this->setSalt($newSalt);
            $this->setAddress($newAddress);
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

    public function getAccessLevel() {
        return ($this->accessLevel);
    }

    public function setAccessLevel($newAccessLevel) {
        // verify access level is integer
        $newAccessLevel = filter_var($newAccessLevel, FILTER_VALIDATE_INT);
        if(empty($newAccessLevel) === true) {
            throw new InvalidArgumentException ("Access Level Invalid");
        }
        if ( ($newAccessLevel !== 'A') || ($newAccessLevel !== 'U') || ($newAccessLevel !== 'S')){
            throw new InvalidArgumentException("Access Level Invaild");
        }

        $this->accessLevel = $newAccessLevel;
    }


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

    public function getFirstName() {
        return ($this->firstName);
    }

    public function setFirstName($newFirstName) {
        // verify first name is valid
        $newFirstName = filter_var($newFirstName, FILTER_SANITIZE_STRING);
        if(empty($newFirstName) === true) {
            throw new InvalidArgumentException("first name invalid");
        }
        if(strlen($newFirstName) > 32) {
            throw (new RangeException ("First Name content too large"));
        }
        $this->firstName = $newFirstName;
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

    public function getLastName() {
        return ($this->lastName);
    }

    public function setLastName($newLastName) {
        //verify last name is valid
        $newLastName = filter_var($newLastName, FILTER_SANITIZE_STRING);
        if(empty($newLastName) === true) {
            throw new InvalidArgumentException("last name invalid");
        }
        if(strlen($newLastName) > 32) {
            throw (new RangeException("Last Name content too large"));
        }
        $this->lastName = $newLastName;
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


    public static function getAllUSER(PDO &$pdo) {
        // create query template
        $query = "SELECT userID, firstName, lastName FROM userID";
        $statement = $pdo->prepare($query);
        // grab the bulletin from mySQL
        try {
            $UserID = null;
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !== false) {
                $UserID = new user ($row["userID"], $row["FirstName"], $row["LastName"]);
            }
        } catch(Exception $exception) {
            // if the row couldn't be converted, rethrow it
            throw(new PDOException($exception->getMessage(), 0, $exception));
        }
        return ($UserID);
    }



    public function getAddress() {
        return ($this->address);
    }

    public function setAddress($newAddress) {
        //verify Address is valid
        $newAddress = filter_var($newAddress, FILTER_SANITIZE_STRING);
        if(empty($newAddress) === true) {
            throw new InvalidArgumentException("last name invalid");
        }
        if(strlen($newAddress) > 32) {
            throw (new RangeException("Last Name content too large"));
        }
        $this->address = $newAddress;
    }

    public function JsonSerialize() {
        $fields = get_object_vars($this);
        unset ($fields["salt"]);
        unset ($fields["hash"]);
        return ($fields);
    }

    public function insert(PDO $pdo)
{
    // make sure user doesn't already exist
    if ($this->userID !== null) {
        throw (new PDOException("existing user"));

        //create query template
        $query
            = "INSERT INTO user(accessLevel, email, firstName, hash, lastName, phone, salt, zip, address)
                VALUES (:accessLevel, :email, :firstName, :hash, :lastName, :phone, :salt, :zip, :address)";
        $statement = $pdo->prepare($query);
        // bind the variables to the place holders in the template
        $parameters = array("accessLevel" => $this->accessLevel, "email" => $this->email,
            "firstName" => $this->firstName, "hash" => $this->hash, "lastName" => $this->lastName, "phone" => $this->phone,
            "salt" => $this->salt, "zip" => $this->zip);
        $statement->execute($parameters);
        //update null userId with what mySQL just gave us
        $this->userID = intval($pdo->lastInsertID);

    }
}

    public function delete(PDO $pdo) {
        //create query template
        $query = "DELETE FROM userID WHERE userID = :userID";
        $statement = $pdo->prepare($query);
        $parameters = array("userID" => $this->userID);
        $statement->execute($parameters);
    }

    public function update(PDO $pdo) {
        // create query template
        $query = "UPDATE userID SET userID = :userID WHERE userID = :userID";
        $statement = $pdo->prepare($query);
        // bind the member variables
        $parameters = array("userID" => $this->userID);
        $statement->execute($parameters);
    }



}