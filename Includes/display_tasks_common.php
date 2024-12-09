<?php 

if (mysqli_num_rows($fetch_tasks) > 0) {
    while ($tasks_list_data = mysqli_fetch_assoc($fetch_tasks)) {
?>


        <tr>
            <td class="data names">
                <div class="data-list"><?php echo $tasks_list_data['task_title'] ?></div>
            </td>
            <td class="data email">
                <div class="data-list"><?php echo $tasks_list_data['task_description'] ?></div>
            </td>
            <td class="data joined">
                <div class="data-list"><?php echo $tasks_list_data['task_category'] ?></div>
            </td>
            <td class="data type">
                <div class="data-list"><?php echo $tasks_list_data['task_due_date'] ?></div>
            </td>
            <td class="data status">
                <div class="data-list"><?php echo $tasks_list_data['task_status'] == 0 ? "Pending" : "Completed" ?></div>
            </td>
            <td class="data status">

                <div class="data-list">
                    <button id = "complete" data-cid = "<?php echo $tasks_list_data['id']; ?>">
                        <i class="uil uil-check"></i>
                        <!-- Edit -->
                    </button>
                    <button id = "edit" data-eid = "<?php echo $tasks_list_data['id']; ?>">
                        <i class="uil uil-edit"></i>
                        <!-- Edit -->
                    </button>
                    <button id = "delete" data-did = "<?php echo $tasks_list_data['id'];  ?>">
                        <i class="uil uil-trash-alt"></i>
                        <!-- Delete -->
                    </button>
                </div>
            </td>
        </tr>
    <?php
    }
} else {
    ?>

    <tr>
        <td class="data names" colspan="5" style="text-align: center">
            <div class="data-list">No records Found</div>
        </td>
    </tr>
<?php
}
?>