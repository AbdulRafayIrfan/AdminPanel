<?php

require_once ('Models/Database.php');
require_once ('Models/accountData.php');

class accountDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    //login function
    public function login($username)
    {
        try
        {
            $query = "SELECT  `id`, `username`, `password` FROM `accounts` where  `username`=:username ";
            $statement = $this->_dbHandle->prepare($query); //prepare a PDO statement
            $statement->bindParam(':username',$username1);
            $username1=$username;
            $statement->execute(); //execute the PDO statement
            while ($row = $statement->fetch())
            {
                return new accountData($row);
            }
        }
        catch (Exception $e)
        {
            echo 'exception '.$e->getMessage();
        }
        return null;
    }

}