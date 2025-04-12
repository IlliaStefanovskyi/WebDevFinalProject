<body>
    <?php
    require '../ComponentsCode/header.php';
    require_once '../classes/Cat.php';

    //creating cat instance
    $cat = new Cat(
        1,
        "../images/img1.jpg",
        "Lala",
        2,
        "Female",
        "Maine Coon",
        "Silver Tabby",
        4.75,
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec scelerisque velit, vel aliquet tortor. 
    Vestibulum et euismod ante, maximus tincidunt odio. Suspendisse sodales scelerisque lacinia. Praesent mi 
    libero, molestie sed orci nec, luctus auctor mi. Maecenas in nisi eget enim vulputate convallis id quis purus. 
    Nam tempus iaculis elementum.",
        "2025-02-10"
    );
    //editing cat
    $cat->name = "Tara";
    ?>

    <img src="<?php echo $cat->image; ?>" alt="cat image">

    <div class="catDetailsContainer">
        <h1><?php echo $cat->name; ?>, <?php echo $cat->age; ?></h1>
        <p>Gender: <?php echo $cat->gender; ?></p>
        <p>Breed: <?php echo $cat->breed; ?></p>
        <p>Color: <?php echo $cat->color; ?></p>
        <p>weight: <?php echo $cat->weight; ?></p>
        <p><?php echo $cat->description; ?> </p>
    </div>
</body>