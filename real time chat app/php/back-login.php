<?php
    session_start();
    include_once "connection.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($email) && !empty($password)){
        // let's check user entered email & password matched to the database  any table row email & password 
        $sql = mysqli_query($conn,"SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
        if(mysqli_num_rows($sql) > 0){ //if the user credentials matched
            $row = mysqli_fetch_assoc($sql);
            // when user logout his status will be offline now right but he/she login then we will again change his status to active now
            $status = "Active now";
            $sql2 = mysqli_query($conn,"UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            // updating user status to active now if user login successfully
            if($sql2){
                $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique id in othe file
                echo "success";
            }
            
        } else {
            echo "email or password is incorrect!";
        }
    }else{
        echo "All input fields are required.";
    }
?>