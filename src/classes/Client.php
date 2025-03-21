<?php 
final class Client extends User{
    public $clientId;
    public $address;
    function __construct($clientId, $email, $name, $phoneNum, $address){
        parent::__construct($email, $name,$phoneNum);
        $this->clientId = $clientId;
        $this->address = $address;
    }
}
?>