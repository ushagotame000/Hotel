<?php
    include('../config/constants.php'); 


    if(isset($_GET['id']) && isset($_GET['status'])){
        $id = $_GET['id'];
        $status = $_GET['status'];

        $sql = "UPDATE booking SET status = '$status' WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if($res){
            $_SESSION['update'] = "Status Updated Sucessfully";
           header("location:".siteurl.'admin/history.php');
        } else {
            $_SESSION['update'] = "Failed to Update status";
           header("location:".siteurl.'admin/history.php');
        }
    } else {
        $_SESSION['update'] = "Invalid Request";
           header("location:".siteurl.'admin/history.php');
    }
?>

           
