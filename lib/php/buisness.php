
<?php

class Buisness implements 

/**
 * accessor method for buisnessId
 *
 * @return int value of unique buisnessId
 **/
public function getBuisnessId() {
    return ($this->buisnessId);
}

/**
 * mutator method for the buisnessId
 * @param int $newBuisnessId unique value to represent a user $newBuisnessId
 * @throws InvalidArgumentException for invalid content
 **/
public function setBuisnessId($newBuisnessId) {
// base case: if the buisnessId is null,
// this is a new user without a mySQL assigned id (yet)
    if($newBuisnessId === null) {
        $this->buisnessId = null;
        return;
    }
//verify the User is valid
    $newBuisnessId = filter_var($newBuisnessId, FILTER_VALIDATE_INT);
    if(empty($newBuisnessId) === true) {
        throw (new InvalidArgumentException ("buisnessID invalid"));
    }
    $this->buisnessId = $newBuisnessId;
}

/**
 * accessor method for email
 *
 * @return string of email for user
 **/
public function getEmail() {
    return ($this->email);
}
/**
 * Mutator method for Email
 *
 * @param string of users' email $newEmail
 * @throws InvalidArgumentException if email does not pass sanitization
 * @throws RangeException if email is longer than 64 characters
 **/
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

/**
 * accessor method for First Name
 *
 * @return string for first name
 **/
public function getName() {
    return ($this->name);
}
/**
 * Mutator method for First Name
 *
 * @param string for user first name $newFirstName
 */
public function setname($newName) {
    // verify first name is valid
    $newName = filter_var($newName, FILTER_SANITIZE_STRING);
    if(empty($newName) === true) {
        throw new InvalidArgumentException("name invalid");
    }
    if(strlen($newName) > 32) {
        throw (new RangeException ("Name content too large"));
    }
    $this->name = $newName;
}
public function get