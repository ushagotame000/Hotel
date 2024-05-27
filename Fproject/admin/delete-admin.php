<?php 
    include('../config/constants.php');
?>

<?php
    $admin_id = $_GET['admin_id'];
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        $sql = "DELETE FROM admins WHERE admin_id=$admin_id";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['delete'] = "Admin deleted successfully";
            header('location: ' . siteurl . 'admin/admins.php');
        } else {
            $_SESSION['delete'] = "Failed to delete";
            header('location: ' . siteurl . 'admin/admins.php');
        }
    } else {
        // Display the confirmation box
        echo "
        <script>
            var confirmed = confirm('Are you sure you want to delete this admin?');
            if (confirmed) {
                window.location.href = 'delete-admin.php?admin_id=$admin_id&confirm=true';
            } else {
                window.location.href = 'admins.php';
            }
        </script>
        ";
    }
?>

?>