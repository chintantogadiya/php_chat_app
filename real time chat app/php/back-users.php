<?php
    session_start();
    include_once "connection.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$_SESSION['unique_id']}");
    $output = '';
    if (mysqli_num_rows($sql) == 1) {
        // if there is only one row in database then definitely this is a current logged in user so we tell there is no user to chat if users is equal to 1 
        $output .= "No users are available to chat.";
    } else if(mysqli_num_rows($sql) > 0) {
        include "data.php";
    }
    echo $output;
?>