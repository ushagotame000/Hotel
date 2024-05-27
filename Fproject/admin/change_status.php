<?php
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['status'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $status = mysqli_real_escape_string($conn, $_GET['status']);

        $updateSql = "UPDATE room SET status = '$status' WHERE id = $id";

        $updateResult = mysqli_query($conn, $updateSql);

        if($updateResult){
           $_SESSION['update'] = "Status Updated Sucessfully";
           header("location:".siteurl.'admin/rooms.php');
        } else {
            $_SESSION['update'] = "Failed to Update Status";
           header("location:".siteurl.'admin/rooms.php');
        }
    } 

    mysqli_close($conn);
?>
