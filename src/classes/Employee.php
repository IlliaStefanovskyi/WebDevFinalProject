<?php
final class Employee extends User{
    public $employeeId;
    public $jobTitle;
    private $manager;#partial composition
    function __construct($employeeId, $name, $jobTitle, $phoneNum, $manager, $email){
        parent::__construct($email,$name, $phoneNum);
        $this->manager = $manager;
        $this->employeeId = $employeeId;
        $this->jobTitle = $jobTitle;
    }
    public function setManager($managerId, $name, $phoneNum, $email){
        $this->manager = new Manager($managerId, $name, $phoneNum, $email);
    }
    public function getManager(){
        return $this->manager;
    }
}
?>