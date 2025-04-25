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
    //receiving manager id to add it to employee
    $sql = "SELECT managerId FROM managers WHERE email = :email";
    $statement = $connection -> prepare($sql);
    $statement -> bindValue(":email", $_SESSION['Username']);
    $statement -> execute();
    $managerId = $statement->fetch(PDO::FETCH_ASSOC);
    //creating new employee
    $sql = "INSERT INTO employees (email, password, name, jobTitle, phoneNumber, managerId)
            VALUES (:email, :password, :name, :jobTitle, :phoneNumber, :managerId)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'email' => makeSafe($_POST['email']),
        'password' => makeSafe($_POST['password']),
        'name' => makeSafe($_POST['name']),
        'jobTitle' => makeSafe($_POST['jobTitle']),
        'phoneNumber' => makeSafe($_POST['phoneNumber']),
        'managerId' => $managerId["managerId"]
    ]);
    header("location:managerAccount.php");
    exit;
}

//Remove Employee
if (isset($_GET['removeEmployee'])) {
    try{
        $sql = "DELETE FROM employees WHERE employeeId = :id";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'id' => makeSafe($_GET['removeEmployee'])
        ]);
        header("location:managerAccount.php");
        exit;
    }catch(PDOException){
        echo "<p class = 'eroorMessage'>Employee with id ", $_GET['removeEmployee'], " can't be deleted, since he/she still has appointments.</p>";
    }
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
    //For reject button
    document.querySelectorAll('.buttonLink').forEach(link => {
        if (link.textContent.toLowerCase().includes("reject")) {
            link.addEventListener('click', function (e) {
                if (!confirm("Are you sure you want to reject this rescue?")) {
                    e.preventDefault();
                }
            });
        }
    });

    //For removing employees
    document.querySelectorAll('.buttonLink').forEach(link => {
        if (link.textContent.toLowerCase().includes("remove")) {
            link.addEventListener('click', function (e) {
                if (!confirm("Are you sure you want to remove this employee?")) {
                    e.preventDefault();
                }
            });
        }
    });

    //For adding employees
    const addEmployeeForm = document.querySelector('form[method="post"]');
    if (addEmployeeForm) {
        addEmployeeForm.addEventListener('submit', function (e) {
            const email = addEmployeeForm.querySelector('input[name="email"]').value.trim();
            const password = addEmployeeForm.querySelector('input[name="password"]').value.trim();
            const phone = addEmployeeForm.querySelector('input[name="phoneNumber"]').value.trim();

            if (password.length < 8 || !/[A-Za-z]/.test(password) || !/\d/.test(password)) {
                alert("Password must be at least 8 characters long and include letters and numbers!");
                e.preventDefault();
            }

            if (!/^[0-9]{7,10}$/.test(phone)) {
                alert("Phone number must be 7 to 10 digits!");
                e.preventDefault();
            }

            if (!email.includes("@")) {
                alert("Enter a valid email!");
                e.preventDefault();
            }
        });
    }
</script>

<?php require 'ComponentsCode/footer.php'; ?>
