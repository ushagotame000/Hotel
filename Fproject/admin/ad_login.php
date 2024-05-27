<?php
    include('../config/constants.php');
    include('../user/bootstrap_headder.php');

?>
<link rel="stylesheet" href="../css/admin.css">
</head>
<body class="bg-primary">
<div class="container-fluid vh-100" style="margin-top:50px">
            <div class="" style="margin-top:20px">
                <div class="rounded d-flex justify-content-center">
                    <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-dark">
                        <div class="text-center">
                            <h3 class="text-primary">Admin Account</h3>
                            <p style="color:red;">
                            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
              }
            if(isset($_SESSION['no-log'])){
                echo $_SESSION['no-log'];
                unset($_SESSION['no-log']);
              }
            ?>
            
                            </p>
                        </div>
                        <div class="p-4">
                            <form action="" method="post">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-person-plus-fill text-white"></i></span>
                                    <input type="text" class="form-control" name="uname" placeholder="Username">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-key-fill text-white"></i></span>
                                    <input type="password" class="form-control" name="pass" placeholder="password">
                                </div>
                                <div class="d-grid col-12 mx-auto">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Login">
                                </div>
                                
                            </form>
                            <?php 
                     if(isset($_POST['submit'])){
                    $uname = $_POST['uname'];
                    $password = $_POST['pass'];

                    $sql = "SELECT * FROM admins WHERE a_uname='$uname'";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count==1){
                     $row = mysqli_fetch_assoc($res);
                        $hashed_password = $row['password_hash'];
                        if (password_verify($password, $hashed_password)) {
                            $_SESSION['login']="Logged in Successfully";
                            $_SESSION['admin']= $uname;
                         header('location:'.siteurl.'admin/dash.php');
                        } else {
                          $_SESSION['login']="Username or Password did not match";
                         header('location:'.siteurl.'admin/ad_login.php');
                        }
                    }           
                    else{
                        $_SESSION['login']="Username or Password did not match";
                        header('location:'.siteurl.'admin/ad_login.php');
                    }
                }           
                ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>