<?php 
    require("header.php");
    require("config.php");
    
// getting current time
$t=time();
$date = (date("Y-m-d",$t));
// end

$update_query = "UPDATE 
                    tasks 
                SET 
                    task_status = '2' 
                WHERE 
                    task_due_date < '{$date}' 
                AND
                    user_id = {$_SESSION['id']}";
mysqli_query($conn, $update_query);
mysqli_close($conn);
?>

        <div class="dash-content">


            <div class="activity">
                <div class="title">
                    <div>
                        <i class="uil uil-clock-two"></i>
                        <span class="text">Tasks list</span>
                    </div>
                    <div>
                        <i class="uil uil-plus-circle"></i>
                        <a class = "text" href="./add_task.php">
                            <span>Add Task</span>
                        </a>
                    </div>
                </div>

                
                <div id = "task_filters">
                    <div class = "links">
                        <span class = "checkboxBtn active all">All</span>
                        <!-- <span class = "checkboxBtn">Active</span> -->
                        <span class = "checkboxBtn">Pending</span>
                        <span class = "checkboxBtn">Completed</span>
                        <span class = "checkboxBtn">Incomplete</span>
                    </div>

                    <div class = "options">
                        <div id = "sort-btn">
                            <i class="uil uil-sort"></i>
                            <span>Sort</span>
                        </div>
                    </div>
                </div>
                <div id = "select-sort-options">
                    <select name="sorts" id="sorting-filters">
                        <option value="task_title">sort by name</option>
                        <option value="task_category">sort by category</option>
                        <option value="task_due_date">sort by date</option>
                    </select>
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
    <!-- ajax code -->
    <script>
        $(document).ready(function(){


            // fetching all data and displaying in table
            function loadData(){
                $.ajax({
                    url : "./Includes/fetch_all_data.php",
                    type : "POST",
                    success : function(data){
                        $(".activity-data tbody").html(data);
                    }
                });
            }

            // by default 
            loadData();


            // =============== sorting ===========
            $("#select-sort-options").hide();
            
            $("#sort-btn").on("click", function(){
                $("#select-sort-options").fadeToggle();
            });
            
            $("#select-sort-options").on("change", function(){
                $(this).fadeOut();
            });
            // =============== end sorting ===========
            

            // filter search using checkboxes
            $(document).on("click", ".checkboxBtn", function(){
                
                $(".checkboxBtn").removeClass("active");
                $(this).addClass("active");
                var id = $(this).html();

                if(id == ""){
                    loadData();
                }else{
                    $.ajax({
                        url : "./Includes/filter_tasks_data.php",
                        type : "POST",
                        data : {id : id}, 
                        success : function(data){
                            if(data){
                                // alert(data);
                                $(".activity-data tbody").html(data);
                            }else{
                                $(".activity-data tbody").html("Only single data found");
                            }
                        }
                    });
                }
            });


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
                // alert($("#form-data").serialize());
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


            // filter data based on options
            $(document).on("change", "#sorting-filters", function(){
                var sort_value = $(this).val();

                var sortObj = { sort_value : sort_value};

                if($(".checkboxBtn.active").html() != "All"){
                    var filter = $(".checkboxBtn.active").html();
                    // alert(filter);
                    sortObj["filter"] = filter;
                }


                $.ajax({
                    url : "./Includes/sort_data.php",
                    type : "POST",
                    data : sortObj,
                    success : function(data){
                        $(".activity-data tbody").html(data);
                    }
                });
            });

            
            // =================== search filter
            $("#global-search").on("input", function(){
                var value = $(this).val();

                // search through ajax
                $(".checkboxBtn").removeClass("active");
                $("#task_filters .links .checkboxBtn.all").addClass("active");
                $.ajax({
                    url : "./Includes/global-search.php",
                    method : "POST",
                    data : { search : value},
                    success : function(data){
                        if(data){
                            $(".activity-data tbody").html(data);
                        }else{
                            loadData();
                        }
                    }
                });
            });
        });
    
        
        // filter button + or - 
        $(document).on("click", "#filter-close-open:has(i#plus)", function(){
            $("#filter-close-open").html("<i class='uil uil-minus' id = 'minus'></i>");
            $(".boxes .filter-box").slideDown();
        });
        
        $(document).on("click", "#filter-close-open:has(i#minus)", function(){
            $("#filter-close-open").html("<i class='uil uil-plus' id = 'plus'></i>");
            $(".boxes .filter-box").slideUp();
        });
    </script>

<?php 
    require("footer.php");
?>