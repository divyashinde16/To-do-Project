<?php
if (isset($_POST['submit'])) {
    include("../config.php");
    session_start();
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Check if a file has been uploaded
    if (!empty($_FILES['profile']['name'])) {
        $profile_name = $_FILES['profile']['name'];
        $temp_name = $_FILES['profile']['tmp_name'];

        $folder_name = "../Uploads/" . $profile_name;
        move_uploaded_file($temp_name, $folder_name);
    } else {
        // No file uploaded, keep the existing profile picture
        $profile_name = '';
    }

    // Build the SQL query
    $query = "UPDATE users_data
              SET firstName = '$firstName', 
                  lastName = '$lastName', 
                  email = '$email',
                  username = '$username'";

    // Check if a new profile picture was provided
    if (!empty($profile_name)) {
        $query .= ", profile_pic = '$profile_name'";
    }

    $query .= " WHERE id = '{$_SESSION['id']}'";

    if (mysqli_query($conn, $query)) {
        $message = "Successfully update data.";
        $message = urlencode($message);
        header("Location: ../setting_page.php?message=$message");
        exit();
    } else {
        echo "Something went wrong.";
        exit();
    }
}
