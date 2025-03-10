<?php 
class User {
    public $userId;
    public $email;
    public $password;
    public $name;
    public $address;
    public $phoneNUm;
    function UserConstructor($userId, $email, $password, 
    $name, $address, $phoneNum){
        $this->userId = $userId;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->address = $address;
        $this->phoneNUm = $phoneNum;
    }
}
?>