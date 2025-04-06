<?php require 'ComponentsCode/header.php'; ?>
<body>
    <?php 
    if (isset($_GET['id'])){
        require_once 'data/connection.php';
        require_once 'data/safety.php';
        $id = makeSafe($_GET['id']);#ensures id is protected
        $sqlQuery ="SELECT * FROM cats WHERE catId = :id;";
        $statement = $connection -> prepare($sqlQuery);
        $statement -> bindValue(':id',$id);
        $statement -> execute();
        $catArr = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    require_once 'classes/Cat.php';#converts array to an object
    $cat = new Cat(...array_values($catArr[0]));
    ?>
    <div class=bigDescContainer>
        <div class="upperContainerForDesc">
            <div class="catImageContainer">
                <img src="<?php echo $cat->image; ?>" alt="cat image">
            </div>
            <div class="catDetailsContainer">
                <h1><?php echo $cat->name; ?>, <?php echo $cat->age; ?></h1>
                <p>Gender: <?php echo $cat->gender; ?></p>
                <p>Breed: <?php echo $cat->breed; ?></p>
                <p>Color: <?php echo $cat->color; ?></p>
                <p>weight: <?php echo $cat->weight; ?></p>
                <a href="booking.php?id=<?php echo makeSafe($cat->catId); ?>">
                    <button class = "buttonLink">Book an appointment</button> 
                </a>
            </div>
        </div>
        <div class = "lowerContainerForDesc">
            <p><?php echo $cat->description; ?> </p>
        </div>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>