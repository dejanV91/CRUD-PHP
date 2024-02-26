<?php

    require_once "connection.php";

    $id = $_GET['id'];
    $sql = "DELETE FROM members WHERE id = $id;";

    $run = $conn -> prepare($sql);
    
    $run -> execute();
    header("location:index.php?message=Uspesno ste obrisali studenta sa id $id");
?>