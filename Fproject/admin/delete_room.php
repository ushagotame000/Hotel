<?php
include('../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the delete action was confirmed
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // Use prepared statement to prevent SQL injection
        $sql = "DELETE FROM room WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the statement
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $_SESSION['delete'] = "Room deleted successfully";
            header('location:' . siteurl . 'admin/rooms.php');
            exit();
        } else {
            $_SESSION['delete'] = "Failed to delete";
            header('location:' . siteurl . 'admin/rooms.php');
            exit();
        }
    } else {
        // Display the confirmation box
        echo "
        <script>
            var confirmed = confirm('Are you sure you want to delete this Room?');
            if (confirmed) {
                window.location.href = 'delete_room.php?id=$id&confirm=true';
            } else {
                window.location.href = 'rooms.php';
            }
        </script>
        ";
    }
} else {
    // Handle the case where 'id' is not set
    $_SESSION['delete'] = "Invalid or missing room ID";
    header('location:' . siteurl . 'admin/rooms.php');
    exit();
}
?>
