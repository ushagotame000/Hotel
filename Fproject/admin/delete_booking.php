<?php
    include('../config/constants.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        // Delete the booking from the database
        $sql = "DELETE FROM booking WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if($res){
            $_SESSION['delete'] = "<div class='success'>Booking deleted successfully.</div>";
            header('location: ../admin/history.php'); // Redirect to the booking list page
        } else {
            $_SESSION['delete'] = "<div class='error'>Failed to delete booking.</div>";
            header('location: ../admin/history.php'); // Redirect to the booking list page
        }
    } else {
        $_SESSION['delete'] = "<div class='error'>Invalid request.</div>";
        header('location: ../admin/history.php'); // Redirect to the booking list page
    }
?>
