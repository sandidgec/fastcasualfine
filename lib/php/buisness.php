
<?php

class Business implements JsonSerializable{
    private $businessId;

    private $email;

    private $name;

    private $phone;

    private $website;

    private $address;

    private $zip;

    public function __construct($newBusinessId, $newEmail, $newName, $newPhone, $newWebsite, $newAddress, $newZip )
    {
        try {
            $this->setBusinessId($newBusinessId);
            $this->setEmail($newEmail);
            $this->setName($newName);
            $this->setPhone($newPhone);
            $this->setWebsite($newWebsite);
            $this->setAddress($newAddress);
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
     * mutator method for the buisnessId
     * @param int $newBuisnessId unique value to represent a user $newBuisnessId
     * @throws InvalidArgumentException for invalid content
     **/
    public function setBusinessId($newBusinessId)
    {
// base case: if the buisnessId is null,
// this is a new user without a mySQL assigned id (yet)
        if ($newBusinessId === null) {
            $this->newBusinessId = null;
            return;
        }
//verify the User is valid
        $newBusinessId = filter_var($newBusinessId, FILTER_VALIDATE_INT);
        if (empty($newBusinessId) === true) {
            throw (new InvalidArgumentException ("buisnessID invalid"));
        }
        $this->businessId = $newBusinessId;
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
     * @param string of users' email $newEmail
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
     * accessor method for First Name
     *
     * @return string for first name
     **/
    public function getName()
    {
        return ($this->name);
    }

    /**
     * Mutator method for First Name
     *
     * @param string $newName  for user first name $newFirstName
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
     * @param int of user phone number $newPhoneNumber
     * @throws InvalidArgumentException if phoneNumber is not ctype digits
     * @throws RangeException if int is not 10 digits
     **/
    public function setPhone($newPhone)
    {
        //verify phone number is valid and digits only
        if ((ctype_digit($newPhone)) === false) {
            throw new InvalidArgumentException ("phoneNumber invalid");
        }
        if (strlen($newPhone) > 16) {
            throw (new RangeException ("Phone Number should be formatted 5055558787"));
        }
        $this->phone = $newPhone;
    }

    public function getWebsite($newWebsite)
    {
        return ($this->website);
    }

    /**
     * Mutator for Website
     *
     */
    public function setWebsite($newWebsite)
    {


        $newWebsite = filter_var($newWebsite, FILTER_SANITIZE_STRING);
        if (strlen($newWebsite) > 128) {
            throw (new RangeException ("Website is too long."));
        }
    }


    public function getAddress($newAddress){
    return ($this->address);
    }


    public function setAddress($newAddress)
    {

        $newAddress = filter_var($newAddress, FILTER_SANITIZE_STRING);
        if ($newAddress === null) {
            $this->address = null;
            return;
            }
    }


    public function getZip($newZip){
        return ($this->zip);
    }

    public function setZip($newZip)
    {

        if (strlen($newZip) > 5) {
            throw (new RangeExecption("Zip code is not valid."));
        }
    }



   /* public function getSpeed($newSpeed){
            //!!!! !NEED HELP !!!!!
    }      I do not kno how I would write this.

    Public function setSpeed($newSpeed){

    }*/
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
/**
 * Inserts User into mySQL
 *
 * Inserts this userId into mySQL in intervals
 * @param PDO $pdo connection to
 **/
public function insert(PDO &$pdo)
{
    // make sure user doesn't already exist
    if ($this->buisnessId !== null) {
        throw (new PDOException("existing user"));
    }
    //create query template
    $query
        = "INSERT INTO business(businessId, email, name, address, website, phone)
        VALUES (businessId, email, name, address, website, phone)";
    $statement = $pdo->prepare($query);
    // bind the variables to the place holders in the template
}
public function delete(PDO &$pdo) {
    // enforce the bulletin is not null
    if($this->businessId === null) {
        throw(new PDOException("unable to delete a bulletin that does not exist"));
    }
    //create query template
    $query = "DELETE FROM business WHERE businessId = :businessId";
    $statement = $pdo->prepare($query);
    //bind the member variables to the place holder in the template
    $parameters = array("businessId" => $this->businessId);
    $statement->execute($parameters);

/**
 * Get all Bulletins
 *
 * @param PDO $pdo pointer to PDO connection, by reference
 * @return mixed| buisness
 **/
public static function getAllBusiness(PDO &$pdo) {
    // create query template
    $query = "SELECT business, businessId, email, name, address, website, phone)";
    $statement = $pdo->prepare($query);
    // grab the bulletin from mySQL
    try {
        $bulletin = null;
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();
        if($row !== false) {
            $bulletin = new Business ($row["businessId"], $row["userId"], $row["email"], $row["name"], $row["address"], $row["website"], $row["phone"] );
        }
    } catch(Exception $exception) {
        // if the row couldn't be converted, rethrow it
        throw(new PDOException($exception->getMessage(), 0, $exception));
    }
    return ($bulletin);
}
/**
 * get bulletin by category
 *
 * @param PDO $pdo pointer to PDO connection, by reference
 * @param mixed info for $business
 * @return null|buisness
 **/
public static function getBusinessByBusinessId(PDO &$pdo, $bulletin) {
    if($bulletin === false) {
        throw(new PDOException(""));
    }
    // create query template
    $query = "SELECT businessId, name, phone, email, website, address, zip
        FROM business WHERE businessId = :buisnessId";
    $statement = $pdo->prepare($query);
    // bind the bulletinid to the place holder in the template
    $parameters = array("BusinessId" => $business);
    $statement->execute($parameters);
    // grab the bulletin from mySQL
    try {
        $review= null;
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();
        if($row !== false) {
            $buinsess = new Business ($row["businessId"], $row["userId"], $row["email"], $row["name"], $row["address"], $row["website"], $row["phone"] );
        }
    } catch(Exception $exception) {
        // if the row couldn't be converted, rethrow it
        throw(new PDOException($exception->getMessage(), 0, $exception));
    }
    return ($business);
}



