<?php

    require("../config.php");

    session_start();
    $filters = $_POST['id'];

    if ($filters == "All") {
        $filters_data = "all";
    } elseif ($filters == "Pending") {
        $filters_data = "0";
    } elseif ($filters == "Completed") {
        $filters_data = "1";
    } else {
        $filters_data = "2";
    }


// $filters_data = implode(', ', $filters);

    if ($filters_data != "all") {
        // if not selected all
        $query = "SELECT * FROM tasks  WHERE user_id = {$_SESSION['id']} AND task_status In ($filters_data) ORDER BY task_due_date ASC";
    } else {
        // else all
        $filters_data = "0, 1, 2";
        $query = "SELECT * FROM tasks  WHERE user_id = {$_SESSION['id']} AND task_status In ($filters_data) ORDER BY task_due_date ASC";
    }


    $fetch_tasks = mysqli_query($conn, $query) or die("Query FAiled");


    include("display_tasks_common.php");
