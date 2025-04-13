<?php
require_once '../classes/Manager.php';

//creating a manager(inheritance)
$manager = new Manager(1,"John","0877837843","manager@gmail.com");

//editing manager
$manager -> managerId = 2;
$manager -> setName("John2");
$manager -> setPhoneNum("2222222222");
$manager -> setEmail("manager2@gmail.com");
?>

<!--Testing data retreival-->
<h1>Data about manager</h1>
<p><?php echo $manager -> managerId; ?></p>
<p><?php echo $manager -> getName(); ?></p>
<p><?php echo $manager -> getPhoneNum(); ?></p>
<p><?php echo $manager -> getEmail(); ?></p>