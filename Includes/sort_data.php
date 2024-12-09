<?php

require("../config.php");
session_start();

$sort_value = $_POST['sort_value'];

if(isset($_POST['filter'])){
    if($_POST['filter'] == "Pending"){
        $_POST['filter'] = "0";
    }else if($_POST['filter'] == "Completed"){
        $_POST['filter'] = "1";
    }else {
        $_POST['filter'] = "2";
    }
    $query = "SELECT * FROM tasks WHERE user_id = {$_SESSION['id']} AND task_status = {$_POST['filter']} ORDER BY {$sort_value}";
    $fetch_tasks = mysqli_query($conn, $query) or die("Query FAiled 1 ");
}else{
    $query = "SELECT * FROM tasks WHERE user_id = {$_SESSION['id']} ORDER BY {$sort_value}";
    $fetch_tasks = mysqli_query($conn, $query) or die("Query FAiled 2");
}

include("display_tasks_common.php");
