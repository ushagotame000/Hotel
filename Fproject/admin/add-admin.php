<?php
    include('./ad_nav.php');
?>
</head>

<body>
<main class="mt-5 pt-3">
<div class="container">

    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <form method="post">
                <h3 class="text-center mb-4">Add Admin</h3>
                <p>       <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?></p>
                <div class="mb-3">
                    <label for="name" class="form-label">UserName</label>
                    <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="pass1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Enter your Password">
                </div>
                <div class="mb-3">
                    <label for="pass2" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirm your password">
                </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Add admin">
            
                </form>
                <?php
if(isset($_POST['submit'])){
            $uname = $_POST['uname'];
            $email = $_POST['email'];
            $pass = $_POST['pass1'];
            $cpass = $_POST['pass2'];

            // Check if the passwords match
            if ($pass !== $cpass) {
                $_SESSION['add'] = "Passwords do not match";
                header("location:".siteurl.'admin/add-admin.php');
                exit();
            }

            // Encrypt the password
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // INSERT IN SQL
            $sql = "INSERT INTO admins (a_uname, email, password_hash) VALUES ('$uname', '$email', '$hashed_password')";

            // db conn
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if($res == TRUE){
                $_SESSION['add'] = "Admin Added";
                header("location:".siteurl.'admin/admins.php');
                exit();
            }
            else{
                $_SESSION['add'] = "Failed to add";
                header("location:".siteurl.'admin/add-admin.php');
                exit();
            }
        }
        ?>
        </div>
    </div>
</div>

</main>



</body>