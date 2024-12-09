<?php 
    require("../config.php");

    
    session_start();
    $id = $_POST['id'];

    $query = "SELECT * FROM tasks  WHERE id = {$id}";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
?>



<button class = "close-btn">
            X
</button>

<form id = "form-data"  action="" method="POST">
    <div>
        <input type="hidden" id = "taskId" value = "<?php echo $data['id'] ?>" name = "taskId">
    </div>
    <div>
        <label for="taskTitle">Task Title</label>
        <input type="text" id = "taskTitle" name = "task_title" value = "<?php echo $data['task_title']; ?>">
    </div>
    <div>
        <label for="taskDescription">Task Description</label>
        <input type="text" id = "taskDescription" name = "task_description" value = "<?php echo $data['task_description']; ?>">
    </div>
    <div>
        <label for="dueDate">Due Date</label>
        <input type="date" id = "dueDate" name = "due_date" value = "<?php echo $data['task_due_date']; ?>">
    </div>
    <div>
        <label for="category">Category</label>
        <input type="text" id = "category" name = "category" value = "<?php echo $data['task_category']; ?>">
    </div>
    <div>
        <div class = "form-btn">
            <input type="reset" value="Reset">
            <button type="submit" id = "save-data">Save</button>
        </div>
    </div>
</form>