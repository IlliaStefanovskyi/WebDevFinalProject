<?php
    if (isset($_POST['submit'])) {
        try {
            require_once 'data/connection.php';
            require_once 'data/safety.php';
            $new_user = array(
                "email" => makeSafe($_POST['email']),
                "password" => makeSafe($_POST['password']),
                "name" => makeSafe($_POST['name']),
                "phonenum" => makeSafe($_POST['phonenum']),
                "address" => makeSafe($_POST['address'])
            );
            $sql = sprintf("INSERT INTO %s (%s) values (%s)", "clients", 
            implode(", ",array_keys($new_user)), ":" . 
            implode(", :", array_keys($new_user)));

            $statement = $connection->prepare($sql);
            $statement->execute($new_user);
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    if (isset($_POST['submit']) && $statement) {
        echo $new_user['name'] . ' successfully added';
    }
?>
<body>
    <?php require 'ComponentsCode/header.php'; ?>
    <div class="loginContainerOuter">
        <div class="loginContainer">
            
            <!--<form method = "post" class = "left">
                <h3>Log in</h3>
                <p>Email</p>
                <input type = "email" name = "loginEmail" required>
                <p>Password</p>
                <input type = "password" name = "loginPassword" required>
                <div>
                    <button type = "submit">Enter</button>
                </div>
            </form>-->
        
            <form method = "post" class = "right">
                <h3>Sign up</h3>
                <p>Full name</p>
                <input type = "text" name = "name" required>
                <p>Aircode</p>
                <input type = "text" name = "address" required>
                <p>Phone number</p>
                <input type = "text" name = "phonenum" required>
                <p>Email</p>
                <input type = "email" name = "email" required>
                <p>Password</p>
                <input type = "password" name = "password" required>
                <p>Confirm password</p>
                <input type = "password" name = "passwordConf" required>
                <div>
                    <button name = "submit">Create account</button>
                </div>
            </form>
            
        </div>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>