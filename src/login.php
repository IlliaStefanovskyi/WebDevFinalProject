<?php require 'ComponentsCode/header.php'; ?>
<?php
    require_once 'data/connection.php';
    require_once 'data/safety.php';

    if(isset($_POST['submitSignIn'])){
        $email = makeSafe($_POST['email']);
        $password = makeSafe($_POST['password']);

        //client
        $sqlQuery = "SELECT clientId FROM clients WHERE email = :email AND password = :password;";
        $idChecker = lookForUser($sqlQuery,$email,$password, $connection);
        //if matches found
        if($idChecker){
            startSessionNow($email, "client");
        }

        //employee
        $sqlQuery = "SELECT employeeId FROM employees WHERE email = :email AND password = :password;";
        $idChecker = lookForUser($sqlQuery,$email,$password, $connection);
        //if matches found
        if($idChecker){
            startSessionNow($email, "employee");
        }

        //manager
        $sqlQuery = "SELECT managerId FROM managers WHERE email = :email AND password = :password;";
        $idChecker = lookForUser($sqlQuery,$email,$password, $connection);
        //if matches found
        if($idChecker){
            startSessionNow($email, "manager");
        }else{
            echo "Email or password is wrong!";
        }
    }
    if (isset($_POST['submitSignUp'])) {
        try {
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

            startSessionNow($_POST['email'], "client");
        } catch (PDOException $error) {
            if($error->getCode() == 23000){
                echo "This email already exists, please enter a different one or log in!";
            }else
                echo $sql . "<br>" . $error->getMessage();
        }
    }
    //redirects to account if already logged in
    if (isset($_SESSION['Active']) && $_SESSION['Active']) {
        header("location:account.php"); 
            exit; 
    }
    function startSessionNow($email,$userType){
            //store email as username to the session, since it's unique to each user
            $_SESSION['Username'] = $email;
            //session for access to pages
            $_SESSION['Active'] = true;
            //user type session
            $_SESSION['Type'] = $userType;
    }
    function lookForUser($sqlQuery, $email, $password, $connection){
        $statement = $connection -> prepare($sqlQuery);
        $statement -> bindValue(':email',$email);
        $statement -> bindValue(':password',$password);
        $statement -> execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
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
                <p>Age</p>
                <input type = "number" min = 0 max = 100 name = "age" required>
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
    
    <script>
    const loginForm = document.querySelector('.left');
    loginForm.addEventListener('submit', function(e) {
        const email = loginForm.querySelector('input[name="email"]').value.trim();
        const password = loginForm.querySelector('input[name="password"]').value.trim();
        
        if (!email || !password) {
            alert("Email and password are required!");
            e.preventDefault();
        }
    });

    const signupForm = document.querySelector('.right');
    signupForm.addEventListener('submit', function(e) {
        const email = signupForm.querySelector('input[name="email"]').value.trim();
        const password = signupForm.querySelector('input[name="password"]').value.trim();
        const confirmPassword = signupForm.querySelector('input[name="passwordConf"]').value.trim();
        const phone = signupForm.querySelector('input[name="phonenum"]').value.trim();
        const age = signupForm.querySelector('input[name="age"]').value.trim();
        
        if(password.length < 8 || 
        !/[A-Za-z]/.test(password) || 
        !/\d/.test(password)){//password has to be 8 digits in length and contain digits and characters
            alert("Password has to be over 8 digits in length and contain characters and numbers!");
            e.preventDefault();
        }

        if (password !== confirmPassword) {//passwords have to match
            alert("Passwords do not match!");
            e.preventDefault();
        }
        
        if (!/^[0-9]{7,10}$/.test(phone)) {//checks phone number
            alert("Phone number should be digits only (7–10 numbers)!");
            e.preventDefault();
        }

        if(age < 18){//checks for age
            alert("You must be over 18 years of age!");
            e.preventDefault();
        }
        });
    </script>

    <?php require 'ComponentsCode/footer.php'; ?>
</body>