<?php 
class Rescues{
public $rescueId;
public $clientId;
public $location;
public $date;
public $desCatName;
public $descriptionOfCat;
public $descriptionOfEvent;
public $status;
function __construct($rescueId, $clientId, $location, $date, $desCatName, $descriptionOfCat, $descriptionOfEvent, $status) {
    $this->rescueId = $rescueId;
    $this->clientId = $clientId;
    $this->location = $location;
    $this->date = $date;
    $this->desCatName = $desCatName;
    $this->descriptionOfCat = $descriptionOfCat;
    $this->descriptionOfEvent = $descriptionOfEvent;
    $this->status = $status;
}
}
?>