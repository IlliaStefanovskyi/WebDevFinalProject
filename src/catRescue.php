<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Donate</title>
    <link rel="stylesheet" href="css/style.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:ital,wght@0,200..800;1,200..800&family=Delicious+Handrawn&display=swap" rel="stylesheet">
</head>
<body>
    <?php require 'ComponentsCode/header.php'; ?>
    </div>
    <div class = "ourServicesContainer">
        <div class = "ourServices">
            <div class = "left">
                <form id="cat-form" action="#" method="POST">
                    <label for="cat-name">Pet Name:</label>
                    <input type="text" id="cat-name" name="cat-name" required>

                    <label for="cat-age">Pet Age:</label>
                    <input type="text" id="cat-age" name="cat-age" required>

                    <label for="cat-breed">Breed (if possible):</label>
                    <input type="text" id="cat-breed" name="cat-breed">

                    <label for="cat-health">Health Conditions or Medical History:</label>
                    <textarea id="cat-health" name="cat-health" rows="4"></textarea>

                    <label for="owner-name">Your Full name:</label>
                    <input type="text" id="owner-name" name="owner-name" required>

                    <label for="owner-contact">Contact Information:</label>
                    <input type="text" id="owner-contact" name="owner-contact" required>

                    <button type="submit">Submit Donation Form</button>
                </form>
            </div>
        </div>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>
</html>