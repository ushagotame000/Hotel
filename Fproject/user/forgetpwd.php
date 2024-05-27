<?php
    include('./bootstrap_headder.php');
    include('./navbar.php');
?>
<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-lg-6">
                <form method="post">
                    <h3 class="text-center mb-4">Change Password</h3>
                    <?php
                        if (isset($_SESSION['chg'])) {
                            echo '<p class="text-danger">' . $_SESSION['chg'] . '</p>';
                            unset($_SESSION['chg']);
                        }
                    ?>
                    <div class="mb-3">
                        <label for="uname" class="form-label">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter your Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone No.</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your Phone NO." required>
                    </div>
                    <div class="mb-3">
                        <label for="pass1" class="form-label">New password</label>
                        <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Enter your New Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass2" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirm your New Password" required>
                    </div>
                    <input type="submit" class="btn btn-primary form-control" name="submit" value="Change Password">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $uname = $_POST['uname'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $pass1 = $_POST['pass1'];
                    $pass2 = $_POST['pass2'];

                    // Hash the entered passwords
                    $hashed_pass1 = password_hash($pass1, PASSWORD_DEFAULT);
                    $hashed_pass2 = password_hash($pass2, PASSWORD_DEFAULT);

                    // Check if the new passwords match
                    if ($pass1 !== $pass2) {
                        $_SESSION['chg'] = "Passwords do not match";
                        header("location:" . siteurl . 'admin/changepwd.php');
                        exit();
                    }

                    // Perform necessary validations and checks here

                    // Update the password in the user table
                    $sql = "UPDATE users SET password_hash ='$hashed_pass2' WHERE username='$uname' AND email='$email' AND phone='$phone'";
                    $res = mysqli_query($conn, $sql);

                    if ($res) {
                        $_SESSION['chg'] = "Password Changed Successfully";
                        header('location:' . siteurl . 'user/ulogin.php');
                        exit();
                    } else {
                        $_SESSION['chg'] = "Failed to change password";
                        header('location:' . siteurl . 'user/forgetpwd.php');
                        exit();
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
