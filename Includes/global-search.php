<?php

require("../config.php");


session_start();
$search = $_POST['search'];
if(!empty($search)){
    $query = "SELECT * FROM tasks  WHERE user_id = {$_SESSION['id']} AND (task_category like '%$search%' OR task_title like '%$search%' OR task_description like '%$search%') ORDER BY task_due_date";
    $fetch_tasks = mysqli_query($conn, $query) or die("Query FAiled");
}else{
    $query = "SELECT * FROM tasks  WHERE user_id = {$_SESSION['id']} ORDER BY task_due_date";
    $fetch_tasks = mysqli_query($conn, $query) or die("Query FAiled");
}


include("display_tasks_common.php");
