<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body{
            background-color: rgb(0, 255, 174);
        }

        #form-section{
            background-color: rgb(46, 219, 104, 0.5);
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            height: 80vh;
            margin: 10vh 10vw;
            border-radius: 25px;
        }

        
        #form-section .form-data{
            /* background-color:blueviolet; */
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-avatar i{
            font-size: 100px;
            width: 100px;
            height: 100px;
        }

        #form-section .form-data .login-form form{
            width: 100%;
        }
        #form-section .form-data .login-title{
            font-size: 40px;
            font-weight: 600;
            text-align: center;
        }

        #form-section .form-data div:not(#error){
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        #form-section .form-data .login-form label{
            /* position: relative; */
            width: 200px;
            height: 40px;
        }


        #form-section .form-data .login-form input{
            /* position: relative; */
            width: 100%;
            height: 40px;
            background-color: transparent;
            outline: none;
            border: none;
            margin: 5px 5px;
            padding-left: 10px;
            border-bottom: 1px solid black;
        }


        #form-section .form-data .login-form input[type="submit"]{
            background-color: rgb(0, 255, 174);;
            border-radius: 50px;
            border: none;
            outline: none;
            padding-left: 0;
        }

        #error{
            text-align: center;
            background-color: red;
            color: white;
            width: 80%;
            height: 50px;
            padding: 10px;
            box-sizing: border-box;
            font-size: 20px;
            border-radius: 10px;
            display: none ;
        }
    </style>
    <script>
        function validateForm() {
            var name = document.getElementById("fname").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            if (name === "") {
                alert("Name must be filled out");
                return false;
            }

            if (email === "") {
                alert("Email must be filled out");
                return false;
            } else if (!isValidEmail(email)) {
                alert("Invalid email address");
                return false;
            }

            if (password === "") {
                alert("Password must be filled out");
                return false;
            }

            return true;
        }

        function isValidEmail(email) {
            var emailRegex = /\S+@\S+\.\S+/;
            return emailRegex.test(email);
        }
    </script>
</head>
<body>

    <section id = "form-section">

        <div class="form-data">
            <div class ="login-title">
                WELCOME
            </div>
            <div id="error"></div>
            <div class="login-form">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" name = "registrationForm" method = "POST">
                    <div>
                        <label for="fname">First Name:</label>
                        <input type="text" name = "firstName" id = "fname" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="lname">Last Name:</label>
                        <input type="text" name = "lastName" id = "lname" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="email">email:</label>
                        <input type="text" name = "email" id = "email" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="user">User Name:</label>
                        <input type="text" name = "username" id = "user" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" name = "password" id = "password" placeholder="Enter your password">
                    </div>
                    <div>
                        <input type="submit" value="Submit" name = "submit">
                    </div>
                </form>
            </div>
            <div>
                Already Registered? 
                <a href="./login.php">
                    Sign In
                </a>
            </div>
        </div>
    </section>

    
<?php 

if(isset($_POST['submit'])){
    include("config.php");

    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if($firstName == "" || $lastName == "" || $email == "" || $username == "" || $password == "" || strlen($password) <= 6){
        echo "
        <script>
            document.getElementById('error').style.display = 'block';
            document.getElementById('error').innerText = 'Please fill the required fields';
        </script>
        ";
    }else{

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $checkQuery = "SELECT * FROM users_data WHERE username = '{$username}' AND password = '{$password}'; ";
        $checkQueryResult = mysqli_query($conn, $checkQuery);

        if(mysqli_num_rows($checkQueryResult) === 1){
            echo "
            <script>
                document.getElementById('error').style.display = 'block';
                document.getElementById('error').innerText = 'The username is already registered. Please login.';
            </script>
            ";
        }else{

            $query = "  INSERT INTO 
                            users_data(firstName, lastName, email, username, password) 
                        VALUES
                            ('$firstName', '$lastName', '$email', '$username', '$password')";

        
            if(mysqli_query($conn, $query)){
                $query2 = "SELECT * FROM users_data WHERE username = '$username' AND password = '$password'";
                $result = mysqli_query($conn, $query2) or die("Query Failed");
                $data = mysqli_fetch_assoc($result);
                if(mysqli_num_rows($result) > 0){
                    ob_start();
                    session_start();
                    session_unset();
                    $_SESSION['id'] = $data['id'];
                    header("Location: index.php");
                    ob_end_clean();
                    exit();
                }else{
                    ob_start();
                    header("Location: login.php");
                    ob_end_clean();
                    exit();
                }
            }else{
                echo "
                <script>
                    document.getElementById('error').style.display = 'block';
                    document.getElementById('error').innerText = 'Query Not run.';
                </script>
                ";
            }
        }
    }
}


?>
</body>
</html>
