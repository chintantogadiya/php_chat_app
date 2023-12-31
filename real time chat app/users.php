<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {
        header("location: login.php");        
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                    include_once "php/connection.php";
                    // now select all data of current logged in user using session
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");  
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    }
                ?>
                <div class="content">
                    <img src="php/profiles/<?php echo $row['profile'];?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname']. ' '.$row['lname'];?></span>
                        <p><?php echo $row['status'];?></p>
                    </div>
                </div>
                <!-- echo $_SESSION['unique_id'] this is also work -->
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']?>" class="logout">Logout</a>
            </header>  
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter a name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="user-list">
                
            </div>
        </section>
    </div>
    <script src="js/users.js"></script>
</body>

</html>