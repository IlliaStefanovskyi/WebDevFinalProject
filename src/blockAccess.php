<body>
    <?php require 'ComponentsCode/header.php'?>
    <h1>Accesss denied!</h1>
    <p>The page you attempted to access is for clients only, you are logged in as a <?php echo $_SESSION['Type'] ?>.</p>
    <?php require 'ComponentsCode/footer.php';?>
</body>