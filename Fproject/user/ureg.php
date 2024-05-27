<?php
    include('../config/constants.php');
    include('./bootstrap_headder.php');
?>
<link rel="stylesheet" href="../css/ulog.css">

</head>

<body>
    <div class="container" >
        <div class="loginBox">
            <h3>Sign up</h3>
            <h6>
                    <?php
                      if(isset($_SESSION['created'])){
                        echo $_SESSION['created'];
                        unset($_SESSION['created']);
                      }
                      if(isset($_SESSION['failed'])){
                        echo $_SESSION['failed'];
                        unset($_SESSION['failed']);
                      }
                      
                    ?>
                  </h6>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="uname" class="form-label">Full Name</label>
                    <div class="inputBox">
                        <input id="uname" type="text" name="uname" class="form-control" placeholder="Full Name">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="inputBox">
                        <input id="email" type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone no</label>
                    <div class="inputBox">
                        <input id="phone" type="text" name="phone" maxlength="10" class="form-control" placeholder="Phone Number">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <div class="inputBox">
                        <input id="pass" type="password" name="pass" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="cpass" class="form-label">Confirm Password</label>
                    <div class="inputBox">
                        <input id="cpass" type="password" name="cpass" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" name="submit"value="Signup">
            </form>
            <?php
    if (isset($_POST['submit'])) {
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        // Check if password and confirm password match
        if ($pass == $cpass) {
            // Hash the password
            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

            // INSERT IN SQL
            $sql = "INSERT INTO users SET 
            username = '$uname',
            email = '$email',
            phone = '$phone',
            password = '$hashedPass'";

            // db conn
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if ($res == TRUE) {
                $_SESSION['created'] = "User Created";
                header("location:" . siteurl . 'user/ulogin.php');
            } else {
                $_SESSION['created'] = "Try Again";
                header("location:" . siteurl . 'user/ureg.php');
            }
        } else {
            $_SESSION['failed'] = "Password and confirm password do not match";
            header("location:" . siteurl . 'user/ureg.php');
        }
    }
    ?>

                <p style="color: #0d6efd;"><a href="ulogin.php">Login</a></p>
        </div>
    </div>
</body>