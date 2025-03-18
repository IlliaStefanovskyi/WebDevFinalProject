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

    $result = $connection->query('SELECT * FROM clients');
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