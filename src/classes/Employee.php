<?php
final class Employee extends User{
    public $employeeId;
    public $jobTitle;
    public $managerId;
    function __construct($employeeId, $name, $jobTitle, $phoneNum, $managerId, $email){
        parent::__construct($email,$name, $phoneNum);
        $this->managerId = $managerId;
        $this->employeeId = $employeeId;
        $this->jobTitle = $jobTitle;
    }
}
?>