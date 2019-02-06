<?php
/**
 *
 * UserModel extends the DbConfig PDO class to interact with the auth DB table
 */
class UserModel extends DbConfig
{

    /**
     * @var array available columns in the DB
     */
    protected $_columns = [];

    /**
     * Initialises the $_db config variable
     */
    public function __construct()
    {
        parent::__construct();
        $this->userTable = 'users';
    }
    public function register($userdata)
    {
        $oauth_uid = $userdata->id;
        $email = $userdata->emailAddress;
          $sql = "SELECT * FROM $this->userTable WHERE oauth_uid = '".$oauth_uid."' AND email = '".$email."'";
           $check = $this->select($sql);
        if(!empty($check)){
            $sql = "UPDATE $this->userTable SET fname = '".$userdata->firstName."', lname = '".$userdata->lastName."', email = '".$userdata->emailAddress."', location = '".$userdata->location->name."', country = '".$userdata->location->country->code."', picture_url = '".$userdata->pictureUrl."', profile_url = '".$userdata->publicProfileUrl."', modified = '".date("Y-m-d H:i:s")."' WHERE id = ".$check[0]['id'];
            return $this->update($sql);
        }else{
            $sql = "INSERT INTO 
                        $this->userTable(oauth_provider,oauth_uid,fname,lname,email,location,country,picture_url,profile_url,created,modified) 
                        VALUES('linkedin','".$userdata->id."','".$userdata->firstName."','".$userdata->lastName."','".$userdata->emailAddress."','".$userdata->location->name."','".$userdata->location->country->code."','".$userdata->pictureUrl."','".$userdata->publicProfileUrl."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')";
                        return $this->insert($sql);
        }
    }
} 