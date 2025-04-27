<div class = footerAway>
<div>
<?php require 'ComponentsCode/header.php'; ?>
<?php
require_once 'data/connection.php';
require_once 'data/safety.php';

//logging out
if (isset($_POST["logout"])) {
    require_once 'ComponentsCode/logout.php';
}

//redirects managers and employees
if($_SESSION['Type'] == "manager"){
    header("location:managerAccount.php");
    exit;
}
else if($_SESSION['Type'] == "employee"){
    header("location:employeeAccount.php");
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
//deleting rescue
if(isset($_GET['rescId'])){
    $sqlQuery = "DELETE FROM rescues WHERE rescueId = :rescId;";
    $statement = $connection -> prepare($sqlQuery);
    $statement -> bindValue(':rescId', makeSafe($_GET['rescId']));
    $statement -> execute();

    //redirects in order to remove rescId from URL
    header("location:account.php");
    exit;
}

//receiving bookings
$sqlQuery = "SELECT b.* FROM bookings b INNER JOIN clients c ON b.clientId = c.clientId WHERE c.email = :email";
$statement = $connection->prepare($sqlQuery);
$statement->bindValue(':email', $_SESSION['Username']);
$statement->execute();
$bookingsData = $statement->fetchAll(PDO::FETCH_ASSOC);

require_once("classes/Booking.php");
$bookings = array();
foreach ($bookingsData as $row) {
    $bookings[] = new Booking(...array_values($row));
}

//receiving rescues
$sqlQuery = "SELECT r.* FROM rescues r INNER JOIN clients c ON r.clientId = c.clientId WHERE c.email = :email";
$statement = $connection->prepare($sqlQuery);
$statement->bindValue(':email',$_SESSION['Username']);
$statement->execute();
$rescuesData = $statement->fetchAll(PDO::FETCH_ASSOC);

require_once("classes/Rescue.php");
$rescues = array();
foreach($rescuesData as $row){
    $rescues[] = new Rescue(...array_values($row));
}
?>

<body>
    <div class="accountPageContainer">
        <h1>Log out</h1>
        <form method="post">
            <button class = "buttonLink" name="logout" type="logout">Logout</button>
        </form>
        <h1>My bookings</h1>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Cat Id</th>
                    <th>Employee Id</th>
                    <th>Time</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking->bookingId ?></td>
                        <td><a><?php echo $booking->catId ?></a></td>
                        <td><?php echo $booking->employeeId ?></td>
                        <td><?php echo $booking->time ?></td>
                        <td><a href="description.php?id=<?php echo makeSafe($booking->catId)?>" class="buttonLink">See cat</a></td>
                        <td><a href="account.php?id=<?php echo makeSafe($booking->bookingId); ?>" class="buttonLink">Cancel</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
        <h1>My rescues</h1>
            <table>
                <thead>
                    <tr>
                        <th>Rescue ID</th>
                        <th>Client ID</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Desired name</th>
                        <th>Cat description</th>
                        <th>Event description</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rescues as $rescue): ?>
                        <tr>
                            <td><?php echo $rescue->rescueId ?></td>
                            <td><?php echo $rescue->clientId ?></td>
                            <td><?php echo $rescue->location ?></td>
                            <td><?php echo $rescue->date ?></td>
                            <td><?php echo $rescue->desCatName ?></td>
                            <td class = descriptionOfCat><?php echo $rescue->descriptionOfCat ?></td>
                            <td class = descriptionOfCat><?php echo $rescue->descriptionOfEvent ?></td>
                            <td><?php echo $rescue->status ?></td>
                            <?php if($rescue->status != 'on display or adopted' && $rescue->status != 'approved'):?>
                                <td><a href="account.php?rescId=<?php echo makeSafe($rescue->rescueId); ?>" class="buttonLink">Delete</a></td>
                                <td><a href = "catRescue.php?rescId=<?php echo makeSafe($rescue->rescueId); ?>" class = "buttonLink">Edit</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <script>
    document.querySelectorAll('.buttonLink').forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.textContent.toLowerCase().includes("cancel") || this.textContent.toLowerCase().includes("delete")) {
                if (!confirm("Are you sure you want to proceed?")) {
                    e.preventDefault();
                }
            }
        });
    });
    </script>

</body>
</div>
</div>
<?php require 'ComponentsCode/footer.php'; ?>