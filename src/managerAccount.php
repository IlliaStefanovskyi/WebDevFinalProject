<?php require 'ComponentsCode/header.php'; ?>

<?php
//Logging out
if (isset($_POST["logout"])) {
    require_once 'ComponentsCode/logout.php';
}

//Essentials
require_once 'data/connection.php';
require_once 'data/safety.php';
require_once 'classes/Rescue.php';

//Only managers allowed
if (!isset($_SESSION["Active"]) || $_SESSION['Type'] != "manager") {
    header("location:login.php");
    exit;
}

//Approve / Reject Rescue Requests
if (isset($_GET['approve'])) {
    $sql = "UPDATE rescues SET status = 'approved' WHERE rescueId = :id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':id', makeSafe($_GET['approve']));
    $stmt->execute();
    header("location:managerAccount.php");
    exit;
}

if (isset($_GET['reject'])) {
    $sql = "UPDATE rescues SET status = 'rejected' WHERE rescueId = :id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':id', makeSafe($_GET['reject']));
    $stmt->execute();
    header("location:managerAccount.php");
    exit;
}

//Get rescue data
$sql = "SELECT * FROM rescues";
$statement = $connection->prepare($sql);
$statement->execute();
$rescuesData = $statement->fetchAll(PDO::FETCH_ASSOC);

$rescues = array();
foreach ($rescuesData as $row) {
    $rescues[] = new Rescue(...array_values($row));
}

//Add Employee
if (isset($_POST['addEmployee'])) {
    $sql = "INSERT INTO employees (email, password, name, jobTitle, phoneNumber, managerId)
            VALUES (:email, :password, :name, :jobTitle, :phoneNumber, :managerId)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'email' => makeSafe($_POST['email']),
        'password' => makeSafe($_POST['password']),
        'name' => makeSafe($_POST['name']),
        'jobTitle' => makeSafe($_POST['jobTitle']),
        'phoneNumber' => makeSafe($_POST['phoneNumber']),
        'managerId' => $_SESSION['Id']
    ]);
    header("location:managerAccount.php");
    exit;
}

//Remove Employee
if (isset($_GET['removeEmployee'])) {
    $sql = "DELETE FROM employees WHERE employeeId = :id";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'id' => makeSafe($_GET['removeEmployee'])
    ]);
    header("location:managerAccount.php");
    exit;
}

//Get employee list
$sql = "SELECT * FROM employees";
$stmt = $connection->prepare($sql);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Manager</h1>
<h1>Log out</h1>
<form method="post">
    <button name="logout" type="logout">Logout</button>
</form>

<div class="accountPageContainer">
    <h1>All Rescue Requests</h1>
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
                        <a href="managerAccount.php?approve=<?php echo makeSafe($rescue->rescueId); ?>" class="buttonLink">Approve</a>
                        <a href="managerAccount.php?reject=<?php echo makeSafe($rescue->rescueId); ?>" class="buttonLink">Reject</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="accountPageContainer">
    <h1>Manage Employees</h1>

    <form method="post">
        <h3>Add New Employee</h3>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="password" placeholder="Password" required>
        <input type="text" name="jobTitle" placeholder="Job Title" required>
        <input type="text" name="phoneNumber" placeholder="Phone Number" required>
        <button type="submit" name="addEmployee">Add Employee</button>
    </form>

    <h3>Current Employees</h3>
    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Job Title</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $emp): ?>
                <tr>
                    <td><?php echo $emp['employeeId']; ?></td>
                    <td><?php echo $emp['name']; ?></td>
                    <td><?php echo $emp['email']; ?></td>
                    <td><?php echo $emp['jobTitle']; ?></td>
                    <td><?php echo $emp['phoneNumber']; ?></td>
                    <td>
                        <a href="managerAccount.php?removeEmployee=<?php echo $emp['employeeId']; ?>" class="buttonLink" onclick="return confirm('Remove this employee?');">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
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
