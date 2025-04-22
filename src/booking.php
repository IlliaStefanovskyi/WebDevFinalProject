<div class=footerAway>
    <?php require 'ComponentsCode/header.php'; ?>
    <?php
    if (!isset($_SESSION["Active"])) {
        header("location:login.php");
        exit;
    }
    if ($_SESSION['Type'] != "client") {
        header("location:blockAccess.php");
        exit;
    }
    if (isset($_POST['submit'])) {
        try {
            require_once 'data/connection.php';
            require_once 'data/safety.php';
            //receives user id
            $email = makeSafe($_SESSION['Username']);
            $sqlQuery = "SELECT clientId FROM clients WHERE email = :email;";
            $statement = $connection->prepare($sqlQuery);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $userData = $statement->fetch(PDO::FETCH_ASSOC);

            //receives employee ID's and select a random one
            $sqlQuery = "SELECT employeeId FROM employees;";
            $statement = $connection->prepare($sqlQuery);
            $statement->execute();
            $employeeIDs = $statement->fetchAll(PDO::FETCH_COLUMN);

            $new_booking = array(
                "catId" => makeSafe($_GET['id']),
                "clientId" => makeSafe($userData['clientId']),
                "employeeId" => makeSafe($employeeIDs[array_rand($employeeIDs)]),//random id
                "time" => makeSafe($_POST['bookingDate'])
            );
            $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "bookings",
                implode(", ", array_keys($new_booking)),
                ":" .
                implode(", :", array_keys($new_booking))
            );

            $statement = $connection->prepare($sql);
            $statement->execute($new_booking);

            echo "booking created!!!";

            //Redirects to account page
            header("location:account.php");
            exit;

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    ?>

    <body>
        <div class="ourServicesContainer">
            <div class="ourServices">
                <div class="left">
                    <form id="cat-form" action="#" method="post">
                        <label for="donation-date">Select booking date and time:</label>
                        <?php
                        //receives current date
                        $currDate = date('Y-m-d\TH:i');
                        ?>
                        <input type="datetime-local" id="donation-date" name="bookingDate" min = "<?php echo $currDate ?>" required>

                        <button type="submit" name="submit" class="buttonLink">Submit Booking Form</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <?php require 'ComponentsCode/footer.php'; ?>
</div>