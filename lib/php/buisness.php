
<?php

class Business implements JsonSerializable{
    private $buisnessId;

    private $email;

    private $name;

    private $phone;

    private $website;



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
    public function setBusinessId($businessId)
    {
// base case: if the buisnessId is null,
// this is a new user without a mySQL assigned id (yet)
        if ($businessId === null) {
            $this->businessId = null;
            return;
        }
//verify the User is valid
        $businessId = filter_var($businessId, FILTER_VALIDATE_INT);
        if (empty($businessId) === true) {
            throw (new InvalidArgumentException ("buisnessID invalid"));
        }
        $this->businessId = $businessId;
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
     * @param string for user first name $newFirstName
     */
    public function setname($newName)
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

    }

    /**
     * Mutator for Website
     *
     */
    public function setWebsite($newWebsite)
    {


        $newWebsite = filter_var($newWebsite, FILTER_SANITIZE_STRING);
        if (strlen($newWebsite) > 128) {
            throw (new RangeExecption ("Website is too long."));
        }
    }


    public function getAddress($newAddress)
    {
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

    }

    public function setZip($newZip)
    {

        if (strlen($newZip) > 5) {
            throw (new RangeExecption("Zip code is not valid."));
        }
    }


   /* public function getSpeed($newSpeed){
            //!!!! !NEED HELP !!!!!
    }

    Public function setSpeed($newSpeed){

    }*/
}