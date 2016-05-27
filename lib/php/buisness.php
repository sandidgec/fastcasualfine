
<?php

class Business implements JsonSerializable
{
    private $businessId;
    
    private $address;

    private $email;

    private $name;

    private $phone;
    
    private $speed;

    private $website;

    private $zip;
    
    

    public function __construct($newBusinessId, $newAddress, $newEmail, $newName, $newPhone, $newSpeed, $newWebsite, $newZip)
    {
        try {
            $this->setBusinessId($newBusinessId);
            $this->setAddress($newAddress);
            $this->setEmail($newEmail);
            $this->setName($newName);
            $this->setPhone($newPhone);
            $this->setSpeed($newSpeed);
            $this->setWebsite($newWebsite);
            $this->setZip($newZip);
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

    /**
     * accessor method for businessId
     *
     * @return int value of unique businessId
     **/
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
            throw (new InvalidArgumentException ("businessID invalid"));
        }
        $this->businessId = $newBusinessId;
    }
    
    public function getAddress()
    {
        return ($this->address);
    }


    public function setAddress($newAddress)
    {

        $newAddress = filter_var($newAddress, FILTER_SANITIZE_STRING);
        if($newAddress === false) {
            throw (new InvalidArgumentException("address is invalid"));
        }

        $this->address = $newAddress;
    }

    /**
     * accessor method for email
     *
     * @return string of email for user
     **/
    public function getEmail()
    {
        return ($this->email);
    }

    /**
     * Mutator method for Email
     *
     * @param string $newEmail of business's email $newEmail
     * @throws InvalidArgumentException if email does not pass sanitization
     * @throws RangeException if email is longer than 64 characters
     **/
    public function setEmail($newEmail)
    {
// verify email is valid
        $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
        if (empty($newEmail) === true) {
            throw new InvalidArgumentException ("user email invalid");
        }
        if (strlen($newEmail) > 64) {
            throw(new RangeException ("Email content too large"));
        }
        $this->email = $newEmail;
    }

    /**
     * accessor method for Name
     *
     * @return string for name
     **/
    public function getName()
    {
        return ($this->name);
    }

    /**
     * Mutator method for  Name
     *
     * @param string $newName for business name $newName
     */
    public function setName($newName)
    {
        // verify first name is valid
        $newName = filter_var($newName, FILTER_SANITIZE_STRING);
        if (empty($newName) === true) {
            throw new InvalidArgumentException("name invalid");
        }
        if (strlen($newName) > 32) {
            throw (new RangeException ("Name content too large"));
        }
        $this->name = $newName;
    }

    /**
     * Accessor method for Phone Number
     *
     * @return int for phone number
     **/
    public function getPhone()
    {
        return ($this->phone);
    }

    /**
     * Mutator method for Phone Number
     *
     * @param int $newPhone of user phone number $newPhoneNumber
     * @throws InvalidArgumentException if phoneNumber is not ctype digits
     * @throws RangeException if int is not 10 digits
     **/
    public function setPhone($newPhone)
    {

        $newPhone = filter_var($newPhone, FILTER_SANITIZE_STRING);
            if ($newPhone === false){
                throw (new InvalidArgumentException("Phone number incorrectly formatted"));
            }
        $this->phone = $newPhone;
    }

    /*
     * Speed Attribute
     */

    public function getSpeed()
    {
        return $this->speed;
    }
    /*
     * speed mutator
     */
    public function setSpeed($speed)
    {
        $speed = filter_var($speed, FILTER_SANITIZE_STRING);
        if ($speed === false){
            throw(new InvalidArgumentException("Speed is corrupt or empty"));
        }
        $speed = strtolower($speed);

        if ($speed === "fast"){
            $this->speed = $speed;
        } elseif ($speed === "casual"){
            $this->speed = $speed;
        } elseif ($speed === "fine"){
            $this->speed = $speed;
        } else {
            throw (new RangeException("Speed must be fast, casual, or fine"));
        }
    }
    /*Accessor for Website
     * @return Website
     *
     */

    public function getWebsite()
    {
        return ($this->website);
    }

    /**
     * @param $newWebsite
     * Mutator for Website
     *
     */
    public function setWebsite($newWebsite)
    {

        $newWebsite = filter_var($newWebsite, FILTER_SANITIZE_STRING);
        if($newWebsite === false) {
            throw(new InvalidArgumentException("new website is invalid"));
        }
        
        if (strlen($newWebsite) > 128) {
            throw (new RangeException ("Website is too long."));
        }

        $this->website = $newWebsite;
    }


    /**
     * Mutator method for Zip Number
     *
     * $Zip of zip code number $newZip
     */
    public function getZip()
    {
        return ($this->zip);
    }
    /*
     * 
     * param int $newZip
     * @throws RangeException when $newZip is not 5
     */
    public function setZip($newZip)
    {
        $newZip = filter_var($newZip, FILTER_VALIDATE_INT);

        if ($newZip === false){
            throw (new InvalidArgumentException("Zip must ba an inteter"));
        }

        if (strlen($newZip) > 5) {
            throw (new RangeException("Zip code is not valid."));
        }

        $this->zip = $newZip;
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
     **/
    /**
     * Inserts User into mySQL
     *
     * Inserts this userId into mySQL in intervals
     * @param PDO $pdo connection to
     **/
    public function insert(PDO $pdo)
    {
        //create query template
        $query = "INSERT INTO business(address, email, name, phone, speed, website, zip)
              VALUES (:address, :email, :name, :phone, :speed, :website, :zip)";
        $statement = $pdo->prepare($query);
        // bind the variables to the place holders in the template
        $parameters = array("address" => $this->address, "email" => $this->email, "name"=> $this->name, "phone"=> $this->phone, "speed"=> $this->speed, "website"=> $this->website, "zip"=> $this->zip);
        $statement->execute($parameters);

        $this->businessId = intval($pdo->lastInsertId());
    }

    /**
     * @param PDO $pdo
     */
    public function update(PDO $pdo)
    {
        
            $query = "UPDATE business SET address = :address, email = :email, name = :name, phone = :phone, speed = :speed, website = :website, zip = :zip
                      WHERE businessId = :businessId";
            $statement = $pdo->prepare($query);

            $parameters = array ("address" => $this->address, "email" => $this->email, "name"=> $this->name, "phone"=> $this->phone,
                                    "speed"=> $this->speed, "website"=> $this->website, "zip"=> $this->zip, "businessId" => $this->businessId);
            $statement->execute($parameters);
    }


    /**
     * @param PDO $pdo
     */
    public function delete(PDO $pdo)
    {
        // enforce the bulletin is not null
        if ($this->businessId === null) {
            throw(new PDOException("unable to delete a business that does not exist"));
        }
        //create query template
        $query = "DELETE FROM business WHERE businessId = :businessId";
        $statement = $pdo->prepare($query);
        //bind the member variables to the place holder in the template
        $parameters = array("businessId" => $this->businessId);
        $statement->execute($parameters);
    }

    /**
     * Get all Businesses
     *
     * @param PDO $pdo pointer to PDO connection, by reference
     * @return mixed| business
     **/
    public static function getAllBusiness(PDO $pdo)
    {
        // create query template
        $query = "SELECT businessId, address, email, name,  phone, speed, website, zip FROM business";
        $statement = $pdo->prepare($query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $businesses = new SplFixedArray($statement->rowCount());

        // grab the bulletin from mySQL
        while($row = $statement->fetch()) {
            try {
                if ($row !== false) {
                    $business = new Business ($row["businessId"], $row["address"], $row["email"], $row["name"], $row["phone"], $row["speed"], $row["website"], $row["zip"]);
                    $businesses[$businesses->key()] = $business;
                    $businesses->next();
                }
            } catch (Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return ($businesses);
    }

    /**
     * get business by category
     *
     * @param PDO $pdo pointer to PDO connection, by reference
     * @param int $businessId for $business
     * @return null|business
     **/
    public static function getBusinessByBusinessId(PDO $pdo, $businessId)
    {
        if ($businessId === false) {
            throw(new PDOException(""));
        }
        // create query template
        $query = "SELECT businessId, address, email, name, phone,speed, website, zip
        FROM business WHERE businessId = :businessId";
        $statement = $pdo->prepare($query);
        // bind the bulletinid to the place holder in the template
        $parameters = array("businessId" => $businessId);
        $statement->execute($parameters);
        $business = null;
        // grab the bulletin from mySQL
        try {
            
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if ($row !== false) {
                $business = new Business ($row["businessId"],  $row["address"], $row["email"], $row["name"],$row["phone"], $row["speed"], $row["website"], $row["zip"]);
            }
        } catch (Exception $exception) {
            // if the row couldn't be converted, rethrow it
            throw(new PDOException($exception->getMessage(), 0, $exception));
        }
        return ($business);
    }
}



