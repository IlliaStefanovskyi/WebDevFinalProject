<body>
    <?php
    $sqlQuery ="SELECT * FROM cats;";
    require 'data/connection.php';
    $result = $connection->query($sqlQuery);
    $rows = $result->fetchAll();

    require 'ComponentsCode/header.php'; 
    ?>
    <div id="petLayoutContainer">
        <?php #iterates trough rows received from database
        require 'ComponentsCode/petCard.php';
        for ($i = 0; $i < count($rows); $i++) {
            addCard($rows[$i]["image"], $rows[$i]["name"], "Male | 1");
        }
        ?>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>

</body>