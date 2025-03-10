<?php 
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "webdevfinalproject";
    $conn = "";

    $conn = mysqli_connect($db_server,
                            $db_user,
                            $db_pass,
                            $db_name,);

    // try {conn = mysqli_connect($db_server,
    //                              $db_user,
    //                              $db_pass,
    //                              $db_name,); 
    // }  (incase current method doesnt work)

    if($conn){
        echo"You are connected!";
    }

    // catch(mysqli_sql_exception){
    // echo"could not connect!";
    // }
    
    else{
        echo"Could not connect!";
    }
?>                         
