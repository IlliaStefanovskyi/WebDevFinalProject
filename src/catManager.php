<?php require 'ComponentsCode/header.php'; ?>
<?php 
require_once 'data/connection.php';
require_once 'data/safety.php';

// Only Employees can access
if (!isset($_SESSION["Active"]) || $_SESSION['Type'] != "employee") {
    header("location:login.php");
    exit;
}

// Handle Delete Cat
if (isset($_GET['deleteCat'])) {
    $catId = makeSafe($_GET['deleteCat']);

    $sql = "DELETE FROM cats WHERE catId = :id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':id', $catId);
    $stmt->execute();

    header("location:catManager.php");
    exit;
}

// Get all cats
$sql = "SELECT * FROM cats";
$stmt = $connection->prepare($sql);
$stmt->execute();
$cats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Manage Cats</h1>

<a href="employeeAccount.php" class="buttonLink">Back to Employee Account</a>

<div class="accountPageContainer">
    <h2>All Cats</h2>

    <table>
        <thead>
            <tr>
                <th>Cat ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Breed</th>
                <th>Color</th>
                <th>Weight</th>
                <th>Description</th>
                <th>Inbound Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($cats)): ?>
                <tr><td colspan="10">No cats found.</td></tr>
            <?php else: ?>
                <?php foreach ($cats as $cat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cat['catId']); ?></td>
                        <td><?php echo htmlspecialchars($cat['name']); ?></td>
                        <td><?php echo htmlspecialchars($cat['age']); ?></td>
                        <td><?php echo htmlspecialchars($cat['gender']); ?></td>
                        <td><?php echo htmlspecialchars($cat['breed']); ?></td>
                        <td><?php echo htmlspecialchars($cat['color']); ?></td>
                        <td><?php echo htmlspecialchars($cat['weight']); ?></td>
                        <td><?php echo htmlspecialchars($cat['description']); ?></td>
                        <td><?php echo htmlspecialchars($cat['inboundDate']); ?></td>
                        <td>
                            <a href="catManager.php?deleteCat=<?php echo makeSafe($cat['catId']); ?>" class="buttonLink deleteButton">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
// Confirm before deleting a cat
document.querySelectorAll('.deleteButton').forEach(button => {
    button.addEventListener('click', function(e) {
        if (!confirm("Are you sure you want to delete this cat?")) {
            e.preventDefault();
        }
    });
});
</script>

<?php require 'ComponentsCode/footer.php'; ?>
