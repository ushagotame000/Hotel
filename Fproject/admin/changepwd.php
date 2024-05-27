<?php
include('./ad_nav.php');
?>

</head>
<?php

if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
}
?>
<body>

<main class="mt-5 pt-3">
    <div class="container">

        <div class="row justify-content-center mt-5">
            <div class="col-lg-6">
                <form method="post">
                    <h3 class="text-center mb-4">Change Password</h3>
                    <p>
                        <?php
                        if (isset($_SESSION['chg'])) {
                            echo $_SESSION['chg'];
                            unset($_SESSION['chg']);
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
                        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirm your New Password" required>
                    </div>

                    <input type="submit" class="btn btn-primary" name="submit" value="Change Password">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $cpass = $_POST['cpass'];
                    $pass1 = $_POST['pass1'];
                    $pass2 = $_POST['pass2'];

                    // Hash the entered passwords
                    $hashed_cpass = password_hash($cpass, PASSWORD_DEFAULT);
                    $hashed_pass1 = password_hash($pass1, PASSWORD_DEFAULT);
                    $hashed_pass2 = password_hash($pass2, PASSWORD_DEFAULT);

                    // Check if the new passwords match
                    if ($pass1 !== $pass2) {
                        $_SESSION['chg'] = "Passwords do not match";
                        header("location:" . siteurl . 'admin/changepwd.php');
                        exit();
                    }

                    // Perform necessary validations and checks here

                    // Update the password in the database
                    $sql = "UPDATE admins SET password_hash ='$hashed_pass2' WHERE admin_id='$admin_id'";
                    $res = mysqli_query($conn, $sql);

                    if ($res) {
                        $_SESSION['chg'] = "Password Changed Successfully";
                        header('location:' . siteurl . 'admin/ad_login.php');
                        exit();
                    } else {
                        $_SESSION['chg'] = "Failed to change password";
                        header('location:' . siteurl . 'admin/changepwd.php');
                        exit();
                    }
                }
                ?>
              
            </div>
        </div>
    </div>

</main>

</body>
</html>
