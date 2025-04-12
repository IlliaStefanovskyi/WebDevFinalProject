<?php 
require '../ComponentsCode/header.php';
require_once '../classes/Manager.php';
require_once '../classes/Employee.php';
//creating a manager(inheritance)
$manager = new Manager(1,"John","0877837843","manager@gmail.com");
//editing manager
$manager -> setName("John1");
$manager -> managerId = 2;

//creating an employee(aggregation + inheritance)
$employee = new Employee(0,"Duglas","GEO","9993337778",$manager,"employee@gmail.com");
//editing employee
$employee -> setEmail("employee1@gmail.com");
$employee -> setName("Duglas 1");

//retreives manager from an employee
$managerFromEmployee = $employee -> getManager();
?>
<!--Testing data retreival-->
<h1>Data about manager retreived from employee</h1>
<p><?php echo $managerFromEmployee -> managerId; ?></p>
<p><?php echo $managerFromEmployee -> getName(); ?></p>
<p><?php echo $managerFromEmployee -> getPhoneNum(); ?></p>
<p><?php echo $managerFromEmployee -> getEmail(); ?></p>

<h1>Employee data</h1>
<p><?php echo $employee -> employeeId; ?></p>
<p><?php echo $employee -> getName(); ?></p>
<p><?php echo $employee -> jobTitle; ?></p>
<p><?php echo $employee -> getPhoneNum(); ?></p>
<p><?php echo $employee -> getManager() -> managerId; ?></p>
<p><?php echo $employee -> getEmail(); ?></p>