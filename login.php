<?php
    if(isset($_POST['submit'])){
        include("config.php");
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);

        $query = "SELECT * FROM users_data WHERE username = '$username'";
        $result = mysqli_query($conn, $query) or die("Query Failed");
        $data = mysqli_fetch_assoc($result);

        
        if($data && password_verify($password, $data['password'])){
            session_start();
            session_unset();
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);
            $_SESSION['id'] = $data['id'];
            header("Location: ./index.php");
            exit();
        }else{
            header("Location: ./login.php?error=invalid_credentials");
            exit();
        }

        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    
    <section id = "form-section">
        <div class = "illustration-img">
            <img src="./assets/images/Login-rafiki.png" alt="Image Not found">
        </div>
        <div class = "form-data">
            <div class = "login-avatar">
                <i class="uil uil-user-circle"></i>
            </div>
            <div class ="login-title">
                WELCOME
            </div>
            <div class = "login-form">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div>
                        <i class="uil uil-user"></i>
                        <input type="text" name = "username" placeholder="Enter Your Username">
                    </div>
                    <div>
                        <!-- <label for="">Username</label> -->
                        <i class="uil uil-lock"></i>
                        <input type="password" name = "pass" placeholder="Enter Your Password">
                    </div>
                    <div>
                        <input type="submit" value="Login" name = "submit">
                    </div>
                </form>

            </div>
            <div>
                New User? 
                <a href="./registration.php">
                    Sign Up
                </a>
            </div>
        </div>
    </section>
    
</body>
</html>