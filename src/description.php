<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Descriptions</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require 'ComponentsCode/search.php'; ?>
    
    <?php
    // Include cat data from data.php
    require 'data/data.php';
    
    // Check if a cat name was clicked (using GET parameter)
    $selectedCat = isset($_GET['cat']) ? $_GET['cat'] : null;

    // Cat details array
    $catDetails = [
        "Bob" => ["image" => "img1.jpg", "breed" => "Domestic Shorthair", "color" => "Orange", "gender" => "Male", "age" => "3 years", "weight" => "10 lbs", "desc" => "Bob is a playful and affectionate cat who loves being around people. He enjoys climbing cat trees and chasing toys all day! Bob also has a curious side, always exploring new spots in the house and watching the outside world from the window. He is a social cat who loves cuddles and will follow you around wherever you go! He also enjoys sunbathing near the window and curling up in a warm blanket during cold days."],
        "Larry" => ["image" => "img2.jpg", "breed" => "Black Cat", "color" => "Black", "gender" => "Male", "age" => "2 years", "weight" => "9 lbs", "desc" => "Larry is a curious and adventurous cat. He loves exploring every corner of the house and watching birds from the window. He has a playful personality and enjoys chasing laser pointers and playing hide and seek. Although shy at first, once he warms up, he will be your best friend and a loyal companion. Larry also loves sitting on high shelves and observing everything from above, making him the king of his domain."],
        "Win" => ["image" => "img3.jpg", "breed" => "Tuxedo", "color" => "Black & White", "gender" => "Male", "age" => "4 years", "weight" => "12 lbs", "desc" => "Win is a gentle and loving cat who enjoys cuddling and playing with his favorite stuffed mouse toy. He is known for his calm and relaxed nature, often found lounging in sunny spots around the house. He loves gentle pets and enjoys curling up on your lap for a long nap. He also enjoys watching TV, especially nature documentaries featuring birds and fish!"],
        "Labs" => ["image" => "img4.jpg", "breed" => "Mixed Breed", "color" => "Grey & White", "gender" => "Female", "age" => "1 year", "weight" => "7 lbs", "desc" => "Labs is a shy but sweet kitty who takes time to warm up but will be the most loyal companion once she trusts you. She enjoys playing with feather toys and curling up in cozy spots. She may be a little reserved, but her affectionate side shines when she gets comfortable in her surroundings. She loves nighttime zoomies and enjoys sneaking into small spaces to nap in peace!"],
    ];
    ?>

    <div id="petLayoutContainer">
        <?php foreach ($catDesc as $cat) : ?>
            <a href="description.php?cat=<?= urlencode($cat) ?>#selectedCat" class="petCard">
                <div class="petCardImageContainer">
                    <img class="petCardImage" src="images/<?= $catDetails[$cat]['image'] ?>" alt="<?= $cat ?>">
                </div>
                <div class="petCardDescription">
                    <p class="petNameOnCard"><?= $cat ?></p>
                    <p class="petDataOnCard">Click to see details</p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if ($selectedCat && isset($catDetails[$selectedCat])) : ?>
        <div class="catDetails" id="selectedCat">
            <h1><?= $selectedCat ?></h1>
            <img src="images/<?= $catDetails[$selectedCat]['image'] ?>" alt="<?= $selectedCat ?>" style="width: 200px; border-radius: 10px; margin-bottom: 10px;">
            <p><strong>Breed:</strong> <?= $catDetails[$selectedCat]['breed'] ?></p>
            <p><strong>Color:</strong> <?= $catDetails[$selectedCat]['color'] ?></p>
            <p><strong>Gender:</strong> <?= $catDetails[$selectedCat]['gender'] ?></p>
            <p><strong>Age:</strong> <?= $catDetails[$selectedCat]['age'] ?></p>
            <p><strong>Weight:</strong> <?= $catDetails[$selectedCat]['weight'] ?></p>
            <p><?= $catDetails[$selectedCat]['desc'] ?></p>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("selectedCat").scrollIntoView({ behavior: "smooth" });
            });
        </script>
    <?php endif; ?>

    <?php require 'ComponentsCode/footer.php'; ?>
</body>
</html>
