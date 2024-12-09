<?php
require("../config.php");


session_start();

$query = "SELECT * FROM tasks  WHERE user_id = {$_SESSION['id']} ORDER BY task_due_date ASC";
$fetch_tasks = mysqli_query($conn, $query) or die("Query FAiled");

include("display_tasks_common.php");
