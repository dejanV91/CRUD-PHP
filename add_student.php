<?php

    require_once "connection.php";

    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $sql = "INSERT INTO members (first_name, last_name, age, email ) 
            VALUES (?, ?, ?, ?);";

    $run = $conn -> prepare($sql);
    $run -> bind_param("ssis", $fname, $lname, $age, $email);
    
    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($age)) {
        $run -> execute();
        header("location:index.php?success=Student je uspesno dodat!");
    }else {
        header("location:index.php?message=Sva polja moraju biti popunjena!");
    }

?>