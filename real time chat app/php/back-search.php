<?php
    session_start();
    include_once "connection.php";
    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = "";
    // let's select first name or last name of user LIKE user search term
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$_SESSION['unique_id']} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");

    if (mysqli_num_rows($sql) > 0) {
       include "data.php";
    } else{
        $output .= "No user found related to your search term";
    }
    echo $output;
?>