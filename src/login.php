<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my account</title>
    <link rel="stylesheet" href="css/style.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:ital,wght@0,200..800;1,200..800&family=Delicious+Handrawn&display=swap" rel="stylesheet">
</head>
<body>
    <?php require 'ComponentsCode/header.php'; ?>
    <div class = "loginContainerOuter">
        <div class = "loginContainer">
            
            <form method = "post" class = "left">
                <h3>Log in</h3>
                <p>Email</p>
                <input type = "email" name = "loginEmail" required>
                <p>Password</p>
                <input type = "password" name = "loginPassword" required>
                <div>
                    <button type = "submit">Enter</button>
                </div>
            </form>
        
            <form method = "post" class = "right">
                <h3>Sign up</h3>
                <p>Full name</p>
                <input type = "text" name = "name" required>
                <p>Aircode</p>
                <input type = "text" name = "address" required>
                <p>Phone number</p>
                <input type = "text" name = "phoneNum" required>
                <p>Email</p>
                <input type = "email" name = "email" required>
                <p>Password</p>
                <input type = "password" name = "password" required>
                <p>Confirm password</p>
                <input type = "password" required>
                <div>
                    <button type = "submit">Create account</button>
                </div>
            </form>
            
        </div>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>
</html>