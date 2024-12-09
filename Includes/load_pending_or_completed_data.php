<?php 
    require("../config.php");

    
    session_start();

    $query = "SELECT * FROM tasks  WHERE user_id = {$_SESSION['id']}";
    $fetch_tasks = mysqli_query($conn, $query) or die("Query FAiled");

    $query2 = "SELECT count(task_status) as status FROM tasks WHERE task_status = '1' AND user_id = {$_SESSION['id']}";
    $fetch_extra_tasks_into = mysqli_query($conn,$query2) or die("Query Failed2");

    $data = mysqli_fetch_assoc($fetch_extra_tasks_into);
    
    
    $query3 = "SELECT count(task_status) as status FROM tasks WHERE task_status = '0' AND user_id = {$_SESSION['id']}";
    $fetch_extra_tasks_into2 = mysqli_query($conn,$query3) or die("Query Failed3");

    $data2 = mysqli_fetch_assoc($fetch_extra_tasks_into2);
    
    
    $query4 = "SELECT count(task_status) as status FROM tasks WHERE task_status = '2' AND user_id = {$_SESSION['id']}";
    $fetch_extra_tasks_into3 = mysqli_query($conn,$query4) or die("Query Failed3");

    $data3 = mysqli_fetch_assoc($fetch_extra_tasks_into3);
    
    
?>

<div class="box box1">
    <span class="text">Total Tasks :</span>
    <span class="number"><?php echo mysqli_num_rows($fetch_tasks) ?></span>
</div>

<div class="box box2">
    <span class="text">Completed Tasks :</span>
    <span class="number">
        <?php 
            echo $data['status'];
        ?>
    </span>
</div>

<div class="box box3">
    <span class="text">Pending Tasks :</span>
    <span class="number">
        <?php 
            echo $data2['status'];
        ?>
    </span>
</div>

<?php if(isset($data3['status']) && $data3['status'] != 0): ?>

<div class="box box3">
    <span class="text">Incomplete Tasks :</span>
    <span class="number">
        <?php 
            echo $data3['status'];
        ?>
    </span>
</div>
<?php endif; ?>