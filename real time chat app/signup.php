<!-- let's redirect user to users.php if he already logged in on the same browser and try to accessing login or signup page -->
<?php
    session_start();
    if (isset($_SESSION['unique_id'])) {
        // if the user logged in 
        header("location:users.php");
    }
?>
<?php
    include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App</header>
            <form action="#" method="POST" enctype="multipart/file-data" autocomplete="off">
                <div class="errorText"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname"placeholder="first name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="last name" required>
                    </div>
                    </div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field profile">
                        <label>Select Profile</label>
                        <input type="file" name="profile" id="file-upload" required>
                    </div>
                    <div class="field submit">
                        <input type="submit" name="submit" value="signup">
                    </div>
            </form>
            <div class="link">Already signed up? <a href="login.php">login now</a></div>
        </section>
    </div>
    <script src="js/pass-hide-show.js"></script>
    <script src="js/signup.js"></script>
</body>
</html>