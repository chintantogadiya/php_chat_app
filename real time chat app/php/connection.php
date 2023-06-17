<?php 
    $conn = mysqli_connect("localhost", "root", "", "chat");
    if(!$conn){
        echo "connection successfull." . mysqli_connect_error();
    } 
?>