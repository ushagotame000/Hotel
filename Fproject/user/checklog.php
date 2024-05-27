<?php
if(!isset($_SESSION['umail'])){
    $_SESSION['no-login'] = "Please login to access Webpage";

    header('location:'.siteurl.'user/ulogin.php');
}

?>
