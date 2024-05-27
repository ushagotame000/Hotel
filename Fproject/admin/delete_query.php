<?php
include('../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the delete action was confirmed
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // Use prepared statement to prevent SQL injection
        $sql = "DELETE FROM message WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the statement
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $_SESSION['delete'] = "User deleted successfully";
            header('location:' . siteurl . 'admin/query.php');
            exit();
        } else {
            $_SESSION['delete'] = "Failed to delete";
            header('location:' . siteurl . 'admin/query.php');
            exit();
        }
    } else {
        // Display the confirmation box
        echo "
        <script>
            var confirmed = confirm('Are you sure you want to delete this Query?');
            if (confirmed) {
                window.location.href = 'delete_query.php?id=$id&confirm=true';
            } else {
                window.location.href = 'query.php';
            }
        </script>
        ";
    }
} else {
    // Handle the case where 'id' is not set
    $_SESSION['delete'] = "Invalid or missing  ID";
    header('location:' . siteurl . 'admin/query.php');
    exit();
}
?>
