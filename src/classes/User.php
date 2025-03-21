<?php 
abstract class User {
    #has no password parameter, since it's a security threat
    public $email;
    public $name;
    public $phoneNum;
    function __construct($email, $name, $phoneNum){
        $this->email = $email;
        $this->name = $name;
        $this->phoneNum = $phoneNum;
    }
}
?>