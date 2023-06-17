<?php
    session_start();
    include_once "connection.php";
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        // let's check user email is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //if email is valid
            // let's check that email is already exist in the database or not
           $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
           if(mysqli_num_rows($sql) > 0){ //if email already exist 
            echo "$email - This email alreay exist!!";
           } else {

            // if we specify like `accept = "images\*" ` this. so this will allow only select images
            // and if it will be not work than at back end we have to validate
            //let's check user upload file or not
            if(isset($_FILES['profile'])){ //if file is uploaded
                $profile_name =$_FILES['profile']['name']; //getting user uploaded profile name
                $profile_type = $_FILES['profile']['type'];//getting user uploaded profile type
                $tmp_name = $_FILES['profile']['tmp_name'];//This is temparory name is used to save/move file in our folder
                
                // let's explode profile and get the last extension like jpg, png
                $profile_explode = explode('.',$profile_name);
                $profile_ext = end($profile_explode); //here we get the extension of an user uploaded profile

                $extensions = ['png','jpg','jpeg']; //These are some valid profile ext and we've store them in array
                if(in_array($profile_ext, $extensions) === true){ //if user uploaded profile ext is matched with any array extentions
                    $time = time(); //this will return us current time
                    // we need this time because when you uploading user profile to in our folder we resume user file with current time.
                    // so all the profiles will have a unique name.

                    // let's move the user uploaded profile to our perticular folder

                    // current time will be added before the name of user uploading profile. so if user uploaded two different profiles with the same name then the name os a perticular profile will be unique with adding time.
                    $new_profile = $time.$profile_name;
                    if(move_uploaded_file($tmp_name, "profiles/".$new_profile)){ //if user upload profile move to our folder successfully
                         $status = "Active now"; //once user signed up then his status will be active now
                         $random_id = rand(time(),10000000); //creating a random id for user

                        //  let's insert all user data into table
			
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id,   
                                             fname, lname, email, password, profile, status) VALUES ({$random_id}, '{$fname}','{$lname}', '{$email}', '{$password}', '{$new_profile}', '{$status}')");
                        if($sql2){ //if these data inserted
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique id in other php file
                                echo "success";
                            }
                        }else{
                            echo "Something went wrong!";
                        }
                    }

                }else{
                    echo "Please select a profile - jpeg, jpg, png!";
                }
            } else{
                echo "Please select a profile!";
            }
           }
        } else {
            echo "$email - This is not valid email.";
        }
    } else {
        echo "All input fields are required.";
    }
?>