<?php require 'ComponentsCode/header.php'; ?>
<?php

require_once 'data/connection.php';
require_once 'data/safety.php';
require_once 'classes/Rescue.php';

//only employees access
if (!isset($_SESSION["Active"]) || $_SESSION['Type'] != "employee") {
    header("location:login.php");
    exit;
}

//check if ID provided
if (!isset($_GET['rescueId'])) {
    die("No rescue ID provided.");
}

$rescueId = makeSafe($_GET['rescueId']);
$sql = "SELECT * FROM rescues WHERE rescueId = :id";
$stmt = $connection->prepare($sql);
$stmt->bindValue(':id', $rescueId);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Rescue not found.");
}

//form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO cats (image, name, age, gender, breed, color, weight, description, inboundDate)
            VALUES (:image, :name, :age, :gender, :breed, :color, :weight, :description, :inboundDate)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':image'       => makeSafe($_POST['image']),
        ':name'        => makeSafe($_POST['name']),
        ':age'         => makeSafe($_POST['age']),
        ':gender'      => makeSafe($_POST['gender']),
        ':breed'       => makeSafe($_POST['breed']),
        ':color'       => makeSafe($_POST['color']),
        ':weight'      => makeSafe($_POST['weight']),
        ':description' => makeSafe($_POST['description']),
        ':inboundDate' => makeSafe($_POST['inboundDate']),
    ]);
    header("location:employeeAccount.php");
    exit;
}
?>

<div class="addCatFormPage">
    <h2>Add Cat from Rescue Request</h2>

    <form method="post">
        <!-- auto input fields (from rescue data) -->
        <label>
            <span>Name:</span>
            <input type="text" name="name" value="<?php echo htmlspecialchars($data['desCatName']); ?>" required>
        </label>

        <label>
            <span>Description:</span>
            <textarea name="description" required><?php echo htmlspecialchars($data['descriptionOfCat']); ?></textarea>
        </label>

        <label>
            <span>Inbound Date:</span>
            <input type="date" name="inboundDate" value="<?php echo htmlspecialchars($data['date']); ?>" required>
        </label>

        <!-- manually input field -->
        <label>
            <span>Image URL:</span>
            <input type="text" name="image" placeholder="Enter image URL" required>
        </label>

        <label>
            <span>Age:</span>
            <input type="number" name="age" min="0" required>
        </label>

        <label>
            <span>Gender:</span>
            <select name="gender" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </label>

        <label>
            <span>Breed:</span>
            <input type="text" name="breed" placeholder="Enter breed" required>
        </label>

        <label>
            <span>Color:</span>
            <input type="text" name="color" placeholder="Enter color" required>
        </label>

        <label>
            <span>Weight (kg):</span>
            <input type="number" step="0.1" name="weight" required>
        </label>

        <button type="submit">Add Cat</button>
    </form>
</div>

<?php require 'ComponentsCode/footer.php'; ?>
