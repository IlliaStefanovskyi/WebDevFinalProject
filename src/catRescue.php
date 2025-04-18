<?php require 'ComponentsCode/header.php'; 
$rescue = "";
if(!isset($_SESSION["Active"])){
    header("location:login.php");
    exit;
}
if($_SESSION['Type'] != "client"){
    header("location:blockAccess.php"); 
            exit; 
}

//if new rescue is created
if(isset($_POST["submitDonation"]) && !isset($_GET["rescId"])){
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

//if old rescue is being edited
if(isset($_POST["submitDonation"]) && isset($_GET["rescId"])){

    require_once 'data/connection.php';
    require_once 'data/safety.php';

    $sqlQuery = "UPDATE rescues 
    SET location = :loc, 
    desCatName = :dcn, 
    descriptionOfCat = :doc, 
    descriptionOfEvent = :doe 
    WHERE  rescueId = :id";

    $statement = $connection->prepare($sqlQuery);
    $statement -> bindValue(':loc', makeSafe($_POST["rescLocation"]));
    $statement -> bindValue(':dcn', makeSafe($_POST["desName"]));
    $statement -> bindValue(':doc', makeSafe($_POST["catRescDesc"]));
    $statement -> bindValue(':doe', makeSafe($_POST["rescEventDesc"]));
    $statement -> bindValue(':id',makeSafe($_GET['rescId']));
    $statement -> execute();

    //redirects to my account page
    header("location:account.php"); 
    exit; 
}

//receives rescue data and puts it to an object
if(isset($_GET["rescId"])){
    require_once 'data/connection.php';
    require_once 'data/safety.php';
    $sqlQuery = "SELECT * FROM rescues WHERE rescueId = :id ";
    $statement = $connection->prepare($sqlQuery);
    $statement -> bindValue(":id", makeSafe($_GET["rescId"]));
    $statement -> execute();
    $values = $statement -> fetch(PDO::FETCH_ASSOC);

    require_once("classes/Rescue.php");

    $rescue = new Rescue(... array_values($values));
}
function setValue($value){
    if(isset($_GET["rescId"]))
        echo 'value="' . makeSafe($value) . '"';
}
?>
<body>
<div class=footerAway>
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
                    <input type="text" id="rescLocation" name="rescLocation" <?php if($rescue) setValue($rescue -> location) ?> required>

                    <!--date is set by currdate() function -->

                    <label for="desName">Desired name:</label>
                    <input type="text" id="desName" name="desName" <?php if($rescue) setValue($rescue -> desCatName) ?>>

                    <label for="catRescDesc">Description of cat:</label>
                    <textarea id="catRescDesc" name="catRescDesc" rows="4"><?php if($rescue) echo $rescue -> descriptionOfCat?></textarea>

                    <label for="rescEventDesc">Description of event:</label>
                    <textarea id="rescEventDesc" name="rescEventDesc" rows="4"><?php if($rescue) echo $rescue -> descriptionOfEvent ?></textarea>

                    <!-- status by default is pending, until it's reviewed by an employee -->

                    <button type="submit" name = "submitDonation" class = "buttonLink">Submit Rescue Form</button>
                </form>
            </div>
        </div>
    </div>
    <div>
    <?php require 'ComponentsCode/footer.php'; ?>
    </div>
</div>
</body>