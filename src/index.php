<body>
    <?php
    $sqlQuery ="SELECT * FROM cats;";
    require_once 'data/connection.php';
    $result = $connection->query($sqlQuery);
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    require 'ComponentsCode/header.php'; 
    ?>
    <div id="petLayoutContainer">
        <?php 
        #creates an array of Cat instances
        require_once 'classes/Cat.php';
        $catInstanceArr = array();
        foreach($rows as $row){
            $catInstanceArr[] = new Cat(...array_values($row));
        }
        #iterates trough cat class instances
        require_once 'ComponentsCode/petCard.php';
        for ($i = 0; $i < count($catInstanceArr); $i++) {
            addCard(
            $catInstanceArr[$i]->image, 
            $catInstanceArr[$i]->name, 
            "{$catInstanceArr[$i]->gender} | {$catInstanceArr[$i]->age}",
            $catInstanceArr[$i]->catId
            );
        }
        ?>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>

</body>