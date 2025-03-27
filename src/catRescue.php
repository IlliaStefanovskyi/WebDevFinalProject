<?php require 'ComponentsCode/header.php'; 
if(!isset($_SESSION["Active"])){
    header("location:login.php");
    exit;
}

if(isset($_POST["submitDonation"])){
    try {
        require_once 'data/connection.php';
        require_once 'data/safety.php';

        //receives user id
        $email = makeSafe($_SESSION['Username']);
        $sqlQuery = "SELECT clientId FROM clients WHERE email = :email;";
        $statement = $connection -> prepare($sqlQuery);
        $statement -> bindValue(':email',$email);
        $statement -> execute();
        $userData = $statement->fetch(PDO::FETCH_ASSOC);

        //sends form
        $new_rescue = array(
            "clientId" => makeSafe($userData['clientId']),
            "location" => makeSafe($_POST['rescLocation']),
            "desCatName" => makeSafe($_POST['desName']),
            "descriptionOfCat" => makeSafe($_POST['catRescDesc']),
            "descriptionOfEvent" => makeSafe($_POST['rescEventDesc']),
            "status" => makeSafe("Pending")
        );
        $sql = sprintf(
            "INSERT INTO rescues (%s, date) VALUES (%s, CURDATE())",
            implode(", ", array_keys($new_rescue)), ":".
                    implode(", :", array_keys($new_rescue))
        );
        $statement = $connection->prepare($sql);
        $statement->execute($new_rescue);

        //redirects to my account page
        header("location:account.php"); 
        exit; 

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<body>
    </div>
    <div class = "ourServicesContainer">
        <div class = "ourServices">
            <div class = "rescueDesc">
                <h1>How does rescue work?</h1>
                <p>Fill in the form and wait for the employee to review it, if we 
                    are satisfied with the data, the status will change to reviewed 
                    and you will be contacted via email or phone to progress with 
                    donation. Images of cat are made and added by the employee.</p>
                <p>You can view the rescues with status and other related data 
                    <a class = "inTextLink" href = "account.php">here</a>.</p>
            </div>
            <div class = "left">
                <form id="cat-form" method="post">
                    <label for="rescLocation">Location:</label>
                    <input type="text" id="rescLocation" name="rescLocation" required>

                    <!--date is set by currdate() function -->

                    <label for="desName">Desired name:</label>
                    <input type="text" id="desName" name="desName">

                    <label for="catRescDesc">Description of cat:</label>
                    <textarea id="catRescDesc" name="catRescDesc" rows="4"></textarea>

                    <label for="rescEventDesc">Description of event:</label>
                    <textarea id="rescEventDesc" name="rescEventDesc" rows="4"></textarea>

                    <!-- status by default is pending, until it's reviewed by an employee -->

                    <button type="submit" name = "submitDonation">Submit Rescue Form</button>
                </form>
            </div>
        </div>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>