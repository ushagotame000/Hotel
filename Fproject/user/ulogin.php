<?php
    include('../config/constants.php');
    include('./bootstrap_headder.php');
?>
<link rel="stylesheet" href="../css/ulog.css">

</head>

<body>
    <div class="container">
        <div class="loginBox">
            <h3>Sign in</h3>
            <h6><?php 
                            if(isset($_SESSION['ulogin'])){
                              echo $_SESSION['ulogin'];
                              unset($_SESSION['ulogin']);
                            }
                            if(isset($_SESSION['no-login'])){
                              echo $_SESSION['no-login'];
                              unset($_SESSION['no-login']);
                            }
                            ?></h6>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="inputBox">
                        <input id="email" type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                </div>
               
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <div class="inputBox">
                        <input id="pass" type="password" name="pass" class="form-control" placeholder="Password">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Login">
            </form>
            <?php 
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['pass'];

        // Retrieve the hashed password from the database
        $sql = "SELECT password FROM users WHERE email='$email'";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_assoc($res);
            $hashedPass = $row['password'];

            // Verify the entered password with the hashed password
            if (password_verify($password, $hashedPass)) {
                $_SESSION['ulogin'] = "Logged in Successfully";
                $_SESSION['umail'] = $email;
                header('location:'.siteurl.'index.php');
            } else {
                $_SESSION['ulogin'] = "Username or Password did not match";
                header('location:'.siteurl.'user/ulogin.php');
            }
        } else {
            $_SESSION['ulogin'] = "Username or Password did not match";
            header('location:'.siteurl.'user/ulogin.php');
        }
    }
    ?>
            <a class="link" href="#">Forget Password<br></a>
            <div class="text-center">
               <p style="color: #0d6efd;"><a href="ureg.php">Signup</a></p>
            </div>
        </div>
    </div>
</body>
