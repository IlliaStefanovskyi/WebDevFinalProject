<body>
    <div class = footerAway>
        <div>
            <?php require 'ComponentsCode/header.php' ?>
        </div>
        <div class = accessDenied>
            <h1>Access denied!</h1>
            <p>The page you attempted to access is for clients only, you are logged in as an
                <?php echo $_SESSION['Type'] ?>.
            </p>
        </div>
        <div>
            <?php require 'ComponentsCode/footer.php'; ?>
        </div>
    </div>
</body>