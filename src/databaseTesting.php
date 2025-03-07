<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>catRescue</title>
    <link rel="stylesheet" href="css/style.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:ital,wght@0,200..800;1,200..800&family=Delicious+Handrawn&display=swap" rel="stylesheet">
</head>
<body>
    <?php require 'ComponentsCode/header.php'; ?>
    <?php 
    $pdo = new PDO('mysql:dbname=webdevfinalproject;host=localhost', 'illia', "toforget");
    $result = $pdo->query('SELECT * FROM users');
    $rows = $result->fetchAll();
    var_dump($rows);
    ?>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>
</html>