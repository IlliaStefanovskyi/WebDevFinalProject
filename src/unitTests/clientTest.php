<?php 
require_once '../classes/Client.php';
//creating client
$client = new Client(1,"client@gmail.com","David Luis", "3128928723", "1261 Rosella Drive");

//updating values
$client -> clientId = 2;
$client -> setEmail("client2@gmail.com");
$client -> setName("James Bond");
$client -> setPhoneNum("2222222222");
$client -> address = "Client address works";
?>

<!-- Data retreival -->
<h1>Client data</h1>
<p>id: <?php echo $client -> clientId ?></p>
<p>email: <?php echo $client -> getEmail() ?></p>
<p>name: <?php echo $client -> getName() ?></p>
<p>phone num: <?php echo $client -> getPhoneNum() ?></p>
<p>address: <?php echo $client -> address ?></p>