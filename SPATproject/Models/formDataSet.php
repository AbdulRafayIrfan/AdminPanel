<?php

require_once ('Models/Database.php');
require_once ('Models/formData.php');

class formDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllForms()
    {
        $sqlQuery = 'SELECT * FROM Form';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new formData($row);
        }
        return $dataSet;
    }

    public function insertForm($companyName, $contactName, $contactNo, $address, $date, $taskType, $quantity, $vehicleNo, $simNo, $imeiNo, $remarks, $technicianName, $clientEmail)
    {
        $last_id = -1;
        $sqlQuery = "insert into `form` (`companyName`, `contactName`, `contactNo`, `address`, `date`, `taskType`, `quantity`, `vehicleNo`, `simNo`, `imeiNo`, `remarks`, `technicianName`, `clientEmail`) values(:companyName, :contactName, :contactNo, :address, :date1, :taskType, :quantity, :vehicleNo, :simNo, :imeiNo, :remarks, :technicianName, :clientEmail)";
        try
        {
            $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->bindParam(':companyName',$companyName);
            $statement->bindParam(':contactName',$contactName);
            $statement->bindParam(':contactNo',$contactNo);
            $statement->bindParam(':address',$address);
            $statement->bindParam(':date1',$date);
            $statement->bindParam(':taskType',$taskType);
            $statement->bindParam(':quantity',$quantity);
            $statement->bindParam(':vehicleNo',$vehicleNo);
            $statement->bindParam(':simNo',$simNo);
            $statement->bindParam(':imeiNo',$imeiNo);
            $statement->bindParam(':remarks',$remarks);
            $statement->bindParam(':technicianName',$technicianName);
            $statement->bindParam(':clientEmail',$clientEmail);

            $statement->execute(); // execute the PDO statement
            $last_id = $this->_dbHandle->lastInsertId();
        }
            catch (Exception $e)
            {
            echo $e->getMessage();
            }
            return $last_id;
    }


    // searching through the whole database for users
    public function search($search)
    {
        $query = 'SELECT `id`, `companyName`, `contactName`, `contactNo`, `address`, `date`, `taskType`, `quantity`, `vehicleNo`, `simNo`, `imeiNo`, `remarks`, `technicianName`, `clientEmail` FROM `form`' ;
        $query= $query." where (`companyName` like CONCAT('%',:srch,'%') or `taskType`= :srch or `date` like CONCAT('%',:srch,'%'))";
        $statement = $this->_dbHandle->prepare($query); // prepare a PDO statement
        $statement->bindParam(':srch',$search);
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch())
        {
            $dataSet[] = new formData($row);
        }
        return $dataSet;
    }

}
