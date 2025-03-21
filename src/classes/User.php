<?php 
#generalisation
abstract class User {
    #has no password parameter, since it's a security threat
    private $email;
    private $name;
    private $phoneNum;
    function __construct($email, $name, $phoneNum){
        $this->email = $email;
        $this->name = $name;
        $this->phoneNum = $phoneNum;
    }
    #encapsulation
    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhoneNum() {
        return $this->phoneNum;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPhoneNum($phoneNum) {
        $this->phoneNum = $phoneNum;
    }
}
?>