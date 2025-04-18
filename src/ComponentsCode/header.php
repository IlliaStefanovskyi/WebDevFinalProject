<?php
    if(isset($_POST["catSearch"])){
        require_once 'data/safety.php';
        $search = urldecode(makeSafe($_POST["catSearch"]));
        header("location:index.php?search=". $search);
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php session_start() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vasylkit</title>
    <link rel="stylesheet" href="css/style.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:ital,wght@0,200..800;1,200..800&family=Delicious+Handrawn&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav class = "mainNavigation">
            <a class = "homePageLinkHeader" href = "index.php">
                <img class = "navImage" src = "images/homePageIcon.png" alt = "Go to home page">
            </a>
            <a class = "headerTextLinks" href = "about.php">About</a>
            <a class = "headerTextLinks" href = "catRescue.php">Cat rescue</a>
            <form method = "post">
                <input class = "searchCatBox" type = "text" name = "catSearch" placeholder = "search cat">
            </form>
            <a class = "accountPageLinkHeader" href = "login.php">
                <img class = "navImage" src = "images/accountPageIcon.png" alt = "Go to home page">
            </a>
        </nav>
    </header>
</body>