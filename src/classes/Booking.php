<?php 
class Booking{
public $bookingId;
public $catId;
public $clientId;
public $employeeId;
public $time;
function __construct($bookingId, $catId, $clientId, $employeeId, $time){
    $this->bookingId = $bookingId;
    $this->catId = $catId;
    $this->clientId = $clientId;
    $this->employeeId = $employeeId;
    $this->time = $time;
}
}
?>