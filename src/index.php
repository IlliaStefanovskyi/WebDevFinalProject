<body>
    <?php require 'ComponentsCode/header.php'; ?>
    <div id = "petLayoutContainer">
        <?php
        require 'ComponentsCode/petCard.php';
        require 'data/values.php';
        for($i = 0; $i < count($catDesc); $i++){
            addCard("images/img". ($i + 1). ".jpg",$catDesc[$i],"Male | 1", "Notes");
        }
        ?>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>
