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
    <?php require 'ComponentsCode/header.php';
    
    $sqlQuery = 
    "
    USE webdevfinalproject;
    SELECT * FROM users;
    ";
    require 'data/connection.php';
    /*$statement = $connection->prepare($sqlQuery);
    $statement -> execute();
    $result = $statement -> fetchAll();
    echo $result[0]["name"];*/

    $result = $connection->query('SELECT * FROM users');
    $rows = $result->fetchAll();
    var_dump($rows[0]["name"]);
    include "classes/User.php";
    $user = new User();
    $user -> name = $rows[0]["name"];
    var_dump($user -> name);

    require 'ComponentsCode/footer.php'; ?>
    <!--
    $pdo = new PDO('mysql:dbname=webdevfinalproject;host=localhost', 'illia', "toforget");
    $result = $pdo->query('SELECT * FROM users');
    $rows = $result->fetchAll();
    var_dump($rows);
    -->
</body>
</html>