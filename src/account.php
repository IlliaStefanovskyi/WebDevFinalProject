<?php require 'ComponentsCode/header.php'; ?>
<?php
require_once 'data/connection.php';
require_once 'data/safety.php';

if (isset($_POST["logout"])) {
    //overwrite the current session array with an empty array.
    $_SESSION = [];
    //overwrite the session cookie with empty data too.
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
    session_destroy();
    //redirect to login page
    header("location:login.php");
    exit;
}
//deleting booking
if(isset($_GET['id'])){
    $sqlQuery = "DELETE FROM bookings WHERE bookingId = :id;";
    $statement = $connection -> prepare($sqlQuery);
    $statement -> bindValue(':id',makeSafe($_GET['id']));
    $statement -> execute();

    //redirects in order to remove id from URL
    header("location:account.php");
    exit;
}

//receiving bookings
$sqlQuery = "SELECT * FROM bookings b INNER JOIN clients c ON b.clientId = c.clientId WHERE c.email = :email";
$statement = $connection->prepare($sqlQuery);
$statement->bindValue(':email', $_SESSION['Username']);
$statement->execute();
$bookingsData = $statement->fetchAll(PDO::FETCH_ASSOC);

require_once("classes/Booking.php");
$bookings = array();
foreach ($bookingsData as $row) {
    $bookings[] = new Booking(...array_values($row));
}
?>

<body>
    <h1>Log out</h1>
    <form method="post">
        <button name="logout" type="logout">Logout</button>
    </form>
    <h1>My bookings</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Cat Id</th>
                <th>Client Id</th>
                <th>Employee Id</th>
                <th>Time</th>
                <th>Cancel</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?php echo $booking->bookingId ?></td>
                    <td><?php echo $booking->catId ?></td>
                    <td><?php echo $booking->clientId ?></td>
                    <td><?php echo $booking->employeeId ?></td>
                    <td><?php echo $booking->time ?></td>
                    <td><a href="account.php?id=<?php echo makeSafe($booking->bookingId); ?> " name = "cancellBooking" type = "submit"> Cancel </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>