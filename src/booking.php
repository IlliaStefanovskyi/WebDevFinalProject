<?php require 'ComponentsCode/header.php'; ?>
<?php 
if(!isset($_SESSION["Active"])){
    header("location:login.php");
    exit;
}
if($_SESSION['Type'] != "client"){
    header("location:blockAccess.php"); 
            exit; 
}
if(isset($_POST['submit'])){
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

        //TODO receive employee ID's and select a random one

        $new_booking = array(
            "catId" => makeSafe($_GET['id']),
            "clientId" => makeSafe($userData['clientId']),
            "employeeId" => makeSafe('1'),//edit here!!!
            "time" => makeSafe($_POST['bookingDate'])
        );
        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "bookings", 
        implode(", ",array_keys($new_booking)), ":" . 
        implode(", :", array_keys($new_booking)));

        $statement = $connection->prepare($sql);
        $statement->execute($new_booking);

        echo"booking created!!!";

        //Redirects to account page
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
            <div class = "left">
                <form id="cat-form" action="#" method="post">
                    <label for="donation-date">Select booking date and time:</label>
                    <input type="datetime-local" id="donation-date" name="bookingDate" required>

                    <button type="submit" name = "submit">Submit Booking Form</button>
                </form>
            </div>
        </div>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>