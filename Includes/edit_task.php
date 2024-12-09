<?php 

    require("../config.php");
    session_start();

    $id = $_POST['taskId'];
    
    $task_title = $_POST['task_title'];
    $task_description = $_POST['task_description'];
    $due_date = $_POST['due_date'];
    $category = $_POST['category'];

    $query = "  UPDATE 
                    tasks
                SET
                    task_title = '{$task_title}', 
                    task_description = '{$task_description}', 
                    task_due_date = '{$due_date}', 
                    task_category = '{$category}'
                WHERE 
                    id = '$id'
                AND 
                    user_id = {$_SESSION['id']}";
    
    if(mysqli_query($conn, $query)){
        echo "Record updated successfully.";
    }else{
        echo "Record not updated";
    }  
