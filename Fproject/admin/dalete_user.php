<?php
include('../config/constants.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Check if the delete action was confirmed
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // Use prepared statement to prevent SQL injection
        $sql = "DELETE FROM users WHERE user_id=?";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "i", $user_id);

        // Execute the statement
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $_SESSION['delete'] = "User deleted successfully";
            header('location:' . siteurl . 'admin/user.php');
            exit();
        } else {
            $_SESSION['delete'] = "Failed to delete";
            header('location:' . siteurl . 'admin/user.php');
            exit();
        }
    } else {
        // Display the confirmation box
        echo "
        <script>
            var confirmed = confirm('Are you sure you want to delete this User?');
            if (confirmed) {
                window.location.href = 'delete_user.php?user_id=$user_id&confirm=true';
            } else {
                window.location.href = 'user.php';
            }
        </script>
        ";
    }
} else {
    // Handle the case where 'id' is not set
    $_SESSION['delete'] = "Invalid or missing room ID";
    header('location:' . siteurl . 'admin/user.php');
    exit();
}
?>
