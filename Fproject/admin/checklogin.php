<?php
if(!isset($_SESSION['admin'])){
    $_SESSION['no-log'] = "Please login to access Admin Pannel";

    header('location:'.siteurl.'admin/ad_login.php');
}

?>
