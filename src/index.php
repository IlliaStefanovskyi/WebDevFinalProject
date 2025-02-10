<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    $catDesc = array("Bob","Larry","Win","Labs","DooDoo");
    for($i = 0; $i < count($catDesc); $i++){
        echo'<img src = "images/img1.jpg" height = 100>
            <p>', $catDesc[$i], '</p>';
    }
    ?>

</body>
</html>
