<?php
include('../config/constants.php');
include('../user/bootstrap_headder.php');
include('./navbar.php');

?>
</head>
<?php

if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

if (isset($_POST['submit'])) {
    $cpass = $_POST['cpass'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    // Check if new passwords match
    if ($pass1 !== $pass2) {
        $_SESSION['chg'] = "Passwords do not match";
        header("location:" . siteurl . 'user/changepwd.php');
        exit();
    }

    // Hash the entered passwords
    $hashed_cpass = password_hash($cpass, PASSWORD_DEFAULT);
    $hashed_pass2 = password_hash($pass2, PASSWORD_DEFAULT);

    // Validate user's current password
    $sql = "SELECT * FROM users WHERE email='$email'";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $hashed_password = $row['password'];

            // Verify the entered password with the hashed password
            if (password_verify($cpass, $hashed_password)) {
                // Update user's password
                $sql2 = "UPDATE users SET password ='$hashed_pass2' WHERE email='$email'";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION['change'] = "Password Changed Successfully";
                    header('location:' . siteurl . 'user/ulogin.php');
                    exit();
                } else {
                    $_SESSION['change'] = "Failed to change password";
                    header('location:' . siteurl . 'user/changepwd.php');
                    exit();
                }
            } else {
                $_SESSION['pwd-not-match'] = "Current Password is incorrect";
                header('location:' . siteurl . 'user/changepwd.php?email=' . $email);
                exit();
            }
        }
    }
}

?>



<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6">
                <form method="post">
                    <h3 class="text-center mb-4">Change Password</h3>
                    <h6>
                        <?php
                        if(isset($_SESSION['pwd-not-match'])){
                            echo $_SESSION['pwd-not-match'];
                            unset($_SESSION['pwd-not-match']);
                          }
                        ?>
                    </h6>
                    <p>
                        <?php
                        if (isset($_SESSION['change'])) {
                            echo $_SESSION['change'];
                            unset($_SESSION['change']);
                        }
                        ?>
                    </p>
                    <div class="mb-3">
                        <label for="cpass" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="cpass" name="cpass" placeholder="Enter your Current password" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass1" class="form-label">New password</label>
                        <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Enter your New Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass2" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Enter your Password" required>
                    </div>
                    <input type="submit" class="btn btn-primary form-control" name="submit" value="Change Password">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
