<?php 

    $display = "display:none";
    include("header.php");

?>
    <section id = "form-section">
        <div class="login-form">
            <form action="./Includes/update_registration_data.php" method = "POST" enctype="multipart/form-data">
                <div>
                    <label for="preview">Profile Preview: </label>
                    <?php 
                        if($userInfo['profile_pic']){
                        ?>
                            <img src="./Uploads/<?php echo $userInfo['profile_pic'] ?>" id="previewImg" alt="Profile pic" width="100px" height="100px">
                        <?php
                        }else{
                            echo "Please Select Profile pic";
                            echo `<img src="#" id="previewImg" alt="Preview Image" style="display: none; max-width: 300px; max-height: 300px;">`;
                        }
                    ?>
                </div>
                <div>
                    <label for="fname">First Name:</label>
                    <input type="text" name = "firstName" id = "fname" value="<?php echo $userInfo['firstName'] ? $userInfo['firstName'] : "" ; ?>" placeholder="Enter your username">
                </div>
                <div>
                    <label for="lname">Last Name:</label>
                    <input type="text" name = "lastName" id = "lname" value="<?php echo $userInfo['lastName'] ? $userInfo['lastName'] : "" ; ?>" placeholder="Enter your username">
                </div>
                <div>
                    <label for="email">email:</label>
                    <input type="text" name = "email" id = "email" value="<?php echo $userInfo['email'] ? $userInfo['email'] : "" ; ?>" placeholder="Enter your username">
                </div>
                <div>
                    <label for="profile">Profile:</label>
                    <input type='file' name = 'profile' accept="image/*" id = 'profile'>
                </div>
                <div>
                    <label for="user">User Name:</label>
                    <input type="text" name = "username" id = "user" value="<?php echo $userInfo['username'] ? $userInfo['username'] : "" ; ?>" placeholder="Enter your username">
                </div>
                <div class = "form-btn">
                    <input type="reset" value="Reset">
                    <input type="submit" value="Submit" name = "submit">
                </div>
            </form>
        </div>
    </section>

    <!-- ======== jquery link ========= -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // Get reference to the input field and the preview image element
        const uploadInput = document.getElementById('profile');
        const previewImg = document.getElementById('previewImg');

        // Add event listener to the input field
        uploadInput.addEventListener('change', function() {
        // Check if any file is selected
        if (uploadInput.files && uploadInput.files[0]) {
            // Create a FileReader object
            const reader = new FileReader();

            // Set the image file to be read by the FileReader
            reader.readAsDataURL(uploadInput.files[0]);

            // Set up the onload event to set the src attribute of the preview image
            reader.onload = function(e) {
            previewImg.src = e.target.result; // Set the src attribute with the data URL
            previewImg.style.display = 'block'; // Make the preview image visible
            };
        }
        });

    </script>

    <?php
        include("footer.php");
    ?>