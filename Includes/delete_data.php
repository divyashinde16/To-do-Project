<?php 

    require("../config.php");

    session_start();

    $id = $_POST['id'];

    $query = "DELETE FROM tasks WHERE id = {$id} AND user_id = {$_SESSION['id']}";

    if(mysqli_query($conn, $query)){
        echo "Record Successfully Deleted";
    }else{
        echo "Can't Delete Record.";
    }
