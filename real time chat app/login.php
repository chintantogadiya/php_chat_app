<!-- let's redirect user to users.php if he already logged in on the same browser and try to accessing login or signup page -->
<?php
    session_start();
    if (isset($_SESSION['unique_id'])) {
        // if the user logged in 
        header("location:users.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App</header>
            <form action="#">
                <div class="errorText"></div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field submit">
                    <input type="submit" name="submit" value="Login">
                </div>
            </form>
            <div class="link">Not yet signed up? <a href="signup.php">signup now</a></div>
        </section>
    </div>
    <script src="js/pass-hide-show.js"></script>
    <script src="js/login.js"></script>
</body>

</html>