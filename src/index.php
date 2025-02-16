<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:ital,wght@0,200..800;1,200..800&family=Delicious+Handrawn&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    require 'petCard.php';
    $catDesc = array("Bob","Larry","Win","Labs");
    for($i = 0; $i < count($catDesc); $i++){
        addCard("images/img". ($i + 1). ".jpg",$catDesc[$i],"Male | 1", "Notes");
    }
    ?>
</body>
</html>
