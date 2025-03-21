<?php
final class Employee extends User{
    public $employeeId;
    public $jobTitle;
    public $manager;#partial composition, just pass a manager object
    function __construct($employeeId, $name, $jobTitle, $phoneNum, $manager, $email){
        parent::__construct($email,$name, $phoneNum);
        $this->manager = $manager;
        $this->employeeId = $employeeId;
        $this->jobTitle = $jobTitle;
    }
}
?>