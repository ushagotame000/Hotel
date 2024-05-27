
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="/images/MarkupTag-white-logo.png" alt="" class="img-fluid" />Hotel Orange</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        View More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">ae</a></li>
                        <li><a class="dropdown-item" href="#">ae</a></li>
                        <li><a class="dropdown-item" href="#">ae</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./user/contactus.php">Contact Us</a>
                </li>
            </ul>
           <div class="d-flex">
                <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Account
                </button>
                <?php
             if(isset($_SESSION['ulogin'])){
                $email = $_SESSION['umail'];
                echo "
                <ul class='dropdown-menu' aria-labelledby='loginDropdown'>
                <li><a class='dropdown-item' href='http://localhost/Fproject/user/changepwd.php?email=$email'>Change Password</a></li>
                <li><a class='dropdown-item' href='http://localhost/Fproject/user/history.php?email=$email'>Booking History</a></li>
                <li><a class='dropdown-item' href='http://localhost/Fproject/user/ulogout.php'>Logout</a></li>
            </ul>
                ";
               
                }
                else{
                echo "
                <ul class='dropdown-menu' aria-labelledby='loginDropdown'>
                <li><a class='dropdown-item' href='http://localhost/Fproject/user/ulogin.php'>Login</a></li>
                <li><a class='dropdown-item' href='http://localhost/Fproject/user/ureg.php'>Sign Up</a></li>
           
            </ul>
                ";
    
                }
                ?>
             
            </div>
        </div>

     


        </div>
    </div>
</nav>