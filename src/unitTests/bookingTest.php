<?php 
require_once 'catTest.php';
require_once 'clientTest.php';
require_once 'employeeTest.php';
require_once '../classes/Booking.php';

//creating booking instance
$booking = new Booking(1, 
$cat -> catId,
$client -> clientId, 
$employee -> employeeId, 
"2020-03-20 12:30:30");

//updating values
$booking -> bookingId = 2;
$booking -> catId = 2;
$booking -> clientId = 2;
$booking -> employeeId = 2;
$booking -> time = "2022-02-20 12:45:45";
?>

<!-- Values retreival -->
<h1>Booking data displayed</h1>
<p>id: <?php echo $booking -> bookingId ?></p>
<p>catId: <?php echo $booking -> catId ?></p>
<p>clientId: <?php echo $booking -> clientId ?></p>
<p>employeeId: <?php echo $booking -> employeeId ?></p>
<p>time: <?php echo $booking -> time ?></p>