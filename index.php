<?php 

    $display = "display:none";
    include("header.php");
?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
            </div>

            
            <div class="boxes">
            
                <!-- loading data and displaying here from page load_pending_or_completed_data.php -->


            </div>


            <div class="activity">
                <div class="title">
                    <div>
                        <i class="uil uil-clock-two"></i>
                        <span class="text">Upcoming Tasks</span>
                    </div>
                </div>

                <div id = "result-data">
                    <div class="success-result"></div>
                    <div class="error-result"></div>
                </div>


                <table class="activity-data">
                    <thead>
                        <tr>
                            <th class="data names">
                                <div class="data-title">Title</div>
                            </th>
                            <th class="data email">
                                <div class="data-title">Description</div>
                            </th>
                            <th class="data joined">
                                <div class="data-title">Category</div>
                            </th>
                            <th class="data type">
                                <div class="data-title">Due Date</div>
                            </th>
                            <th class="data status">
                                <div class="data-title">Status</div>
                            </th>
                            <th class="data status" style = "text-align: center">
                                <div class="data-title">Action</div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id = "model">
            <div class="model-box">

            </div>
    </section>

    <!-- ======= external js link ======== -->
    <script src="assets/js/script.js"></script>

    <!-- ======== jquery link ========= -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <!-- ajax code -->
    <script>
        $(document).ready(function(){

            // fetching all data and displaying in table
            function loadData(){
                $.ajax({
                    url : "./Includes/fetch_all_data_by_order.php",
                    type : "POST",
                    success : function(data){
                        $(".activity-data tbody").html(data);
                    }
                });


                // ajax for loading pending tasks and completed tasks
                $.ajax({
                    url : "./Includes/load_pending_or_completed_data.php",
                    type : "POST",
                    success : function(data){
                        $(".boxes").html(data);
                    }
                });
            }


            loadData();


            // deleting records data from table
            $(document).on("click", "#delete", function(){
                var id = $(this).data('did');
                $.ajax({
                    url : "./Includes/delete_data.php",
                    type : "POST",
                    data : {id : id },
                    success : function(data){
                        if(data){
                            $("#result-data .success-result").html(data).slideDown(2000).slideUp(2000);
                            loadData();
                        }else{
                            $("#result-data .success-result").html(data).slideDown(2000).slideUp(2000);
                        }
                    }
                });
            });


            // editing record data from table
            $(document).on("click", "#edit", function(){
                var id = $(this).data('eid');
                // alert(id);
                $("#model").show();

                $.ajax({
                    url : "./Includes/edit_data.php",
                    type : "POST",
                    data : {id : id },
                    success : function(data){
                        if(data){
                            $("#model .model-box").html(data);
                        }else{
                            alert("Something wrong");
                        }
                    }
                });
            });
            
            // closing popup box
            $(document).on("click",".close-btn", function(){
                $("#model").hide();
            });

            // editing data using model box
            $(document).on("click", "#save-data", function(){
                $.ajax({
                    url : "./Includes/edit_task.php",
                    type : "POST",                    
                    data : $("#form-data").serialize(),
                    success : function(data){
                        $("#model").hide();
                        $("#result-data .success-result").html(data).slideDown(2000).slideUp(2000);
                        loadData();
                    }
                });
            });


            
            // Check task to complete mode
            $(document).on("click", "#complete", function(){
                var id = $(this).data('cid');
                // alert(id);
                $.ajax({
                    url : "./Includes/task_modify.php",
                    type : "POST",
                    data : {id : id},
                    success : function(data){
                        $("#result-data .success-result").html(data).slideDown(2000).slideUp(2000);
                        loadData();
                    }
                });
            });
            

            // setting button for profile page
            $("#model-box").hide();
            $("#model-open").on("click", function(){
                $("#model-box").fadeToggle();
            });
        });
    </script>
</body>
</html>