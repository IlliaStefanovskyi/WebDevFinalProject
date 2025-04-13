<?php 
require_once '../unitTests/ManagerTest.php';
require_once '../classes/Employee.php';

//creating an employee(partial aggregation + inheritance)
$employee = new Employee(0,"Duglas","GEO","9993337778",$manager,"employee@gmail.com");

//editing employee
$employee -> employeeId = 1;
$employee -> setName("Duglas1");
$employee -> jobTitle = "GEO1";
$employee -> setPhoneNum("1111111111");
$employee -> setEmail("employee1@gmail.com");

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