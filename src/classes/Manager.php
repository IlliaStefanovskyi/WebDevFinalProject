<?php 
final class Manager extends User{
    public $managerId;
    function __construct($managerId, $name, $phoneNum, $email){
        parent::__construct($email,$name, $phoneNum);
        $this->managerId = $managerId;
    }
}
?>