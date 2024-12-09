<?php 

    require("../config.php");
    
    session_start();
    $user_id = $_SESSION['id'];

    $task_title = $_POST['task_title'];
    $task_description = $_POST['task_description'];
    $due_date = $_POST['due_date'];
    $category = $_POST['category'];


    // applied validations
    if($task_title == ""){
        echo 0;
    }elseif($task_description == ""){
        echo 1;
    }elseif($category == ""){
        echo 2;
    }else{

        $sql = "INSERT INTO 
                    tasks(user_id, task_title, task_description, task_due_date, task_category) 
                VALUES
                    ('{$user_id}', '{$task_title}', '{$task_description}', '{$due_date}', '{$category}')";

        if(mysqli_query($conn, $sql)){
            echo "Data Inserted Successfully";
        }else{
            echo "Can't Insert Data";     
        }
    }

