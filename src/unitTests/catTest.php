<body>
    <?php
    require_once '../classes/Cat.php';

    //creating cat instance
    $cat = new Cat(
        1,
        "../images/img1.jpg",
        "Lala",
        1,
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
    $cat -> catId = 2;
    $cat -> image = "../images/img2.jpg";
    $cat->name = "Tara2";
    $cat -> age = 2;
    $cat -> gender = "Male";
    $cat -> breed = "Whatever";
    $cat -> color = "black";
    $cat -> weight = 5;
    $cat -> description = "Cat description updated corectlly";
    ?>
    <!-- values retreival -->
    <h1>Cat data</h1>
    <img src="<?php echo $cat->image; ?>" alt="cat image">
    <p>id: <?php echo $cat->catId; ?></p>
    <p>Name: <?php echo $cat->name; ?></p>
    <p>Age: <?php echo $cat->age; ?></p>
    <p>Gender: <?php echo $cat->gender; ?></p>
    <p>Breed: <?php echo $cat->breed; ?></p>
    <p>Color: <?php echo $cat->color; ?></p>
    <p>weight: <?php echo $cat->weight; ?></p>
    <p>description: <?php echo $cat->description; ?> </p>
</body>