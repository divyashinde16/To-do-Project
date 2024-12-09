<?php
// Always start the session first
session_start();

require("config.php");

// Check if the user is logged out
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: login.php");
    exit(); // It's good practice to exit after a header redirect
}

// Check if the session is not active (PHP_SESSION_NONE)
if (session_status() === PHP_SESSION_NONE) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
} elseif (session_status() === PHP_SESSION_ACTIVE) {
    // Check if the 'id' session variable is set
    if (isset($_SESSION['id'])) {
        // Sanitize the user input to prevent SQL injection
        $userId = mysqli_real_escape_string($conn, $_SESSION['id']);
        // Query the database to retrieve user information

        $userData = mysqli_query($conn, "SELECT * FROM users_data WHERE id = $userId");
        
        // Check if the query was successful
        if ($userData) {
            $userInfo = mysqli_fetch_assoc($userData);
        } else {
            die("Database query error: " . mysqli_error($conn));
        }
    } else {
        // Redirect to the login page if the 'id' session variable is not set
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- =====  CSS ========= -->
    <link rel="stylesheet" href="./assets/css/style2.css">
    
    <!-- =====  CSS ========= -->
    <link rel="stylesheet" href="./assets/css/registration.css">
    
    <!-- ===== Iconscout CSS ====== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    

    <!-- ======== jquery link ========= -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <title>Dashboard</title>
</head>
<body>
    
    <nav>
        <div class="logo-name">
            <div class = "logo-image">
                <img src="assets/images/logo.png" alt="">
            </div>

            <span class="logo_name">To&nbsp;Do&nbsp;App</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="./index.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="./add_task.php">
                        <i class="uil uil-plus-circle"></i>
                        <span class="link-name">Add&nbsp;Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="./view_task.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">View&nbsp;Tasks</span>
                    </a>
                </li>

            </ul>

            <ul class="logout-mode">
                <li class = "logout-btns">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST">
                        <div>
                            <i class="uil uil-signout"></i>
                            <input type="submit" name = "logout" value="Logout">
                        </div>
                    </form>
                </li>
                <li class = "mode">
                    <a href="">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>



    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box" style="<?php echo $display ?? "" ?>">
                <i class="uil uil-search"></i>
                <input type="text" id = "global-search" class="input-values" placeholder="Search here....">
            </div>
            <div id = "model-open">
                <div>
                    <?php 
                        echo $userInfo['username'];
                    ?>
                </div>
                <img src="./Uploads/<?php echo $userInfo['profile_pic'] ?>">                    
                <i class="uil uil-angle-down"></i>
            </div>
        </div>
        <div id="model-box">
            <a href = "./setting_page.php">Settings</a>
        </div>
        