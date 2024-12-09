<?php

require("../config.php");


session_start();

// getting current time
$t=time();
$date = (date("Y-m-d",$t));
// end

$query = "SELECT * FROM tasks  WHERE user_id = {$_SESSION['id']} AND task_due_date >= '{$date}' AND task_status = 0 ORDER BY task_due_date";
$fetch_tasks = mysqli_query($conn, $query) or die("Query FAiled");


include("display_tasks_common.php");

