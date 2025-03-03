<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Booking</title>
    <link rel="stylesheet" href="css/style.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:ital,wght@0,200..800;1,200..800&family=Delicious+Handrawn&display=swap" rel="stylesheet">
</head>
<body>
    <?php require 'ComponentsCode/search.php'; ?>
    </div>
    <div class = "ourServicesContainer">
        <div class = "ourServices">
            <div class = "left">
                <form id="cat-form" action="#" method="POST">
                    <label for="owner-name">Full Name:</label>
                    <input type="text" id="owner-name" name="owner-name" required>

                    <label for="owner-age">Age:</label>
                    <input type="text" id="owner-age" name="owner-age" required>

                    <label for="cat-id">Please input the cat's reference ID:</label>
                    <input type="text" id="cat-id" name="cat-id">

                    <label for="cat-past">Reason for adopting?:</label>
                    <textarea id="cat-past" name="cat-past" rows="3"></textarea>

                    <label for="donation-date">Preferred Booking Date:</label>
                    <input type="date" id="donation-date" name="donation-date" required>

                    <label for="owner-contact">Contact Information:</label>
                    <input type="text" id="owner-contact" name="owner-contact" required>

                    <button type="submit">Submit Booking Form</button>
                </form>
            </div>
        </div>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>
</html>