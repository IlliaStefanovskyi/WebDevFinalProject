<?php require 'ComponentsCode/header.php'; ?>
<?php
//loging out
if (isset($_POST["logout"])) {
    require_once 'ComponentsCode/logout.php';
}
?>
<h1>Employee</h1>
<h1>Log out</h1>
<form method="post">
    <button name="logout" type="logout">Logout</button>
</form>
<?php require 'ComponentsCode/footer.php'; ?>