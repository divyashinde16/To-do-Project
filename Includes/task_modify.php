<?php 

    include("../config.php");
    
    session_start();
    $id = $_POST['id'];

    $query = "UPDATE 
                    tasks
                SET
                    task_status = '1'
                WHERE
                    id = '$id'  
                AND
                    user_id = {$_SESSION['id']}
                ";

    if(mysqli_query($conn, $query)){
        echo "Task Completed";
    }else{
        echo "Please Try again";
    }
    