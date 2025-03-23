<?php require 'ComponentsCode/header.php'; ?>
<?php
    if(isset($_POST['submitSignIn'])){
        require_once 'data/connection.php';
        require_once 'data/safety.php';
        $email = makeSafe($_POST['email']);
        $password = makeSafe($_POST['password']);
        //will return only one id if input is valid
        $sqlQuery = "SELECT clientId FROM clients WHERE email = :email AND password = :password;";
        $statement = $connection -> prepare($sqlQuery);
        $statement -> bindValue(':email',$email);
        $statement -> bindValue(':password',$password);
        $statement -> execute();
        $idChecker = $statement->fetch(PDO::FETCH_ASSOC);
        //if matches found
        if($idChecker){
            //store email as username to the session, since it's unique to each user
            $_SESSION['Username'] = $_POST['email'];
            //session for access to pages
            $_SESSION['Active'] = true;
        }else{
            echo "Wrong email or password!";
        }
    }
    if (isset($_POST['submitSignUp'])) {
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

            //store email as username to the session, since it's unique to each user
            $_SESSION['Username'] = $_POST['email'];
            //session for access to pages
            $_SESSION['Active'] = true;

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    //redirects to account if already logged in
    if (isset($_SESSION['Active']) && $_SESSION['Active']) {
        header("location:account.php"); 
            exit; 
    }
?>
<body>
    <div class="loginContainerOuter">
        <div class="loginContainer">
            
            <form method = "post" class = "left">
                <h3>Log in</h3>
                <p>Email</p>
                <input type = "email" name = "email" required>
                <p>Password</p>
                <input type = "password" name = "password" required>
                <div>
                    <button name = "submitSignIn" type = "submit">Enter</button>
                </div> 
            </form>
        
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
                    <button name = "submitSignUp" type = "submit">Create account</button>
                </div>
            </form>
            
        </div>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>