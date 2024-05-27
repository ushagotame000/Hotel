<?php
    include('../config/constants.php');

    session_destroy();

    header('location:'.siteurl.'admin/ad_login.php');

 ?>