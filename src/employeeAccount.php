<?php require 'ComponentsCode/header.php'; ?>
<?php 
if (isset($_POST["logout"])) {
    require_once 'ComponentsCode/logout.php';
}
?>
<?php
// Essentials
require_once 'data/connection.php';
require_once 'data/safety.php';
require_once 'classes/Rescue.php';
require_once 'classes/Booking.php'; // <-- ADDED Booking class!

// Only Employee allowed
if (!isset($_SESSION["Active"]) || $_SESSION['Type'] != "employee") {
    header("location:login.php");
    exit;
}

// Approve / Reject Rescue Requests
if (isset($_GET['approve'])) {
    $sql = "UPDATE rescues SET status = 'approved' WHERE rescueId = :id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':id', makeSafe($_GET['approve']));
    $stmt->execute();
    header("location:employeeAccount.php");
    exit;
}

if (isset($_GET['reject'])) {
    $sql = "UPDATE rescues SET status = 'rejected' WHERE rescueId = :id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':id', makeSafe($_GET['reject']));
    $stmt->execute();
    header("location:employeeAccount.php");
    exit;
}

//rescue filter
$statusFilter = isset($_GET['status']) ? makeSafe($_GET['status']) : 'all';

// rescue Data
$sql = "SELECT * FROM rescues";
if ($statusFilter !== 'all') {
    $sql .= " WHERE status = :status";
}
$statement = $connection->prepare($sql);

if ($statusFilter !== 'all') {
    $statement->bindValue(':status', $statusFilter);
}

$statement->execute();
$rescuesData = $statement->fetchAll(PDO::FETCH_ASSOC);

$rescues = array();
foreach ($rescuesData as $row) {
    $rescues[] = new Rescue(...array_values($row));
}

//load booking data
$bookingStmt = $connection->prepare("SELECT * FROM bookings");
$bookingStmt->execute();
$bookingRows = $bookingStmt->fetchAll(PDO::FETCH_ASSOC);

$bookings = array();
foreach ($bookingRows as $row) {
    $bookings[] = new Booking(
        $row['bookingId'],
        $row['catId'],
        $row['clientId'],
        $row['employeeId'],
        $row['time']
    );
}
?>

<h1>Employee Account</h1>

<!-- Action Buttons -->
<div style="margin-bottom: 20px;">
    <a href="catManager.php" class="buttonLink">Manage Cats</a>
</div>

<!-- Logout form -->
<form method="post">
    <button name="logout" type="submit">Logout</button>
</form>

<!-- --------------- BOOKINGS ---------------- -->
<div class="accountPageContainer">
    <h2>Bookings</h2>

    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Client ID</th>
                <th>Cat ID</th>
                <th>Employee ID</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($bookings)): ?>
                <tr><td colspan="5">No bookings found.</td></tr>
            <?php else: ?>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking->bookingId); ?></td>
                        <td><?php echo htmlspecialchars($booking->clientId); ?></td>
                        <td><?php echo htmlspecialchars($booking->catId); ?></td>
                        <td><?php echo htmlspecialchars($booking->employeeId); ?></td>
                        <td><?php echo htmlspecialchars($booking->time); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- --------------- RESCUE ---------------- -->
<div class="accountPageContainer">
    <h2>All Rescue Requests</h2>

    <!-- Status filter -->
    <form method="get" style="margin: 20px 0;">
        <label for="status">Filter by Status:</label>
        <select name="status" id="status" onchange="this.form.submit()">
            <option value="all" <?php if ($statusFilter === 'all') echo 'selected'; ?>>All</option>
            <option value="pending" <?php if ($statusFilter === 'pending') echo 'selected'; ?>>Pending</option>
            <option value="approved" <?php if ($statusFilter === 'approved') echo 'selected'; ?>>Approved</option>
            <option value="rejected" <?php if ($statusFilter === 'rejected') echo 'selected'; ?>>Rejected</option>
        </select>
        <noscript><button type="submit">Filter</button></noscript>
    </form>

    <table>
        <thead>
            <tr>
                <th>Rescue ID</th>
                <th>Client ID</th>
                <th>Location</th>
                <th>Date</th>
                <th>Desired Name</th>
                <th>Cat Description</th>
                <th>Event Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($rescues)): ?>
                <tr><td colspan="9">No rescues found for this status.</td></tr>
            <?php else: ?>
                <?php foreach ($rescues as $rescue): ?>
                    <tr>
                        <td><?php echo $rescue->rescueId ?></td>
                        <td><?php echo $rescue->clientId ?></td>
                        <td><?php echo $rescue->location ?></td>
                        <td><?php echo $rescue->date ?></td>
                        <td><?php echo $rescue->desCatName ?></td>
                        <td><?php echo $rescue->descriptionOfCat ?></td>
                        <td><?php echo $rescue->descriptionOfEvent ?></td>
                        <td><?php echo $rescue->status ?></td>
                        <td>
                            <a href="employeeAccount.php?approve=<?php echo makeSafe($rescue->rescueId); ?>" class="buttonLink">Approve</a>
                            <a href="employeeAccount.php?reject=<?php echo makeSafe($rescue->rescueId); ?>" class="buttonLink">Reject</a>
                            
                            <!-- transfer -->
                            <?php if ($rescue->status === 'approved'): ?>
                                <a href="addCat.php?rescueId=<?php echo makeSafe($rescue->rescueId); ?>" class="buttonLink">Add to Cats</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
//confirm before reject rescue
document.querySelectorAll('.buttonLink').forEach(link => {
    if (link.textContent.toLowerCase().includes("reject")) {
        link.addEventListener('click', function (e) {
            if (!confirm("Are you sure you want to reject this rescue?")) {
                e.preventDefault();
            }
        });
    }
});
</script>

<?php require 'ComponentsCode/footer.php'; ?>
