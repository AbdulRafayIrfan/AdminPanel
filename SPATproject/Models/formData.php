<?php

class formData
{
    protected $id, $companyName, $contactName, $contactNo, $address, $date, $taskType, $quantity, $vehicleNo,
        $simNo, $imeiNo, $remarks, $technicianName, $clientEmail;

    public function __construct($dbRow) {
        $this->id = $dbRow['id'];
        $this-> companyName = $dbRow['companyName'];
        $this->contactName = $dbRow['contactName'];
        $this->contactNo = $dbRow['contactNo'];
        $this->address = $dbRow['address'];
        $this->date = $dbRow['date'];
        $this->taskType = $dbRow['taskType'];
        $this->quantity = $dbRow['quantity'];
        $this->vehicleNo = $dbRow['vehicleNo'];
        $this->simNo = $dbRow['simNo'];
        $this->imeiNo = $dbRow['imeiNo'];
        $this->remarks = $dbRow['remarks'];
        $this->technicianName = $dbRow['technicianName'];
        $this->clientEmail = $dbRow['clientEmail'];
    }

    public function getID() {
        return $this->id;
    }

    public function getCompanyName() {
        return $this-> companyName;
    }

    public function getContactName() {
        return $this->contactName;
    }

    public function getContactNo() {
        return $this->contactNo;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getDate() {
        return $this->date;
    }

    public function getTaskType() {
        return $this->taskType;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getVehicleNo() {
        return $this->vehicleNo;
    }

    public function getSimNo() {
        return $this->simNo;
    }

    public function getImeiNo() {
        return $this->imeiNo;
    }

    public function getRemarks() {
        return $this->remarks;
    }

    public function getTechnicianName() {
        return $this->technicianName;
    }

    public function getClientEmail() {
        return $this->clientEmail;
    }
}