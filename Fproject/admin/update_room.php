<?php
    include('./ad_nav.php');
?>
</head>

<body>
<main class="mt-5 pt-3">
<div class="container">
<?php 
    if(isset($_GET['id'])){
     $id = $_GET['id'];

     $sql = "SELECT * FROM room WHERE id=$id";
     $res = mysqli_query($conn, $sql);

     $count = mysqli_num_rows($res);

     if($count==1){
         $rows = mysqli_fetch_assoc($res);      
      
         $room_no = $rows['room_no'];
         $room_type= $rows['room_type'];
         $bed_type = $rows['bed_type'];
         $rate = $rows['rate'];
         $status = $rows['status'];

     }
     else{
         $_SESSION['no-room-found']="Room not found.";
         header('locaiton:'.siteurl.'admin/rooms.php');
     }
    }

    else{
     header('location:'.siteurl.'admin/rooms.php');
    }
 ?>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <form method="post">
                <h3 class="text-center mb-4">Update Room</h3>
                <p>
                    <?php 
                        if(isset($_SESSION['add'])){
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }
                    ?>
                </p>
                <div class="mb-3">
                    <label for="room_no" class="form-label">Room Number</label>
                    <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Enter room Number" value="<?php echo $room_no?>">
                </div>
                <div class="mb-3">
    <label for="room_type" class="form-label">Room Type</label>
    <select class="form-select" id="room_type" name="room_type">
        <option value="standard" <?php echo ($room_type == 'standard') ? 'selected' : ''; ?>>Standard</option>
        <option value="deluxe" <?php echo ($room_type == 'deluxe') ? 'selected' : ''; ?>>Deluxe</option>
        <option value="suite" <?php echo ($room_type == 'suite') ? 'selected' : ''; ?>>Suite</option>
    </select>
</div>
<div class="mb-3">
    <label for="bed_type" class="form-label">Bed Type</label>
    <select class="form-select" id="bed_type" name="bed_type">
        <option value="single" <?php echo ($bed_type == 'single') ? 'selected' : ''; ?>>Single</option>
        <option value="double" <?php echo ($bed_type == 'double') ? 'selected' : ''; ?>>Double</option>
        <option value="twin" <?php echo ($bed_type == 'twin') ? 'selected' : ''; ?>>Twin</option>
    </select>
</div>
                <div class="mb-3">
                    <label for="rate" class="form-label">Rate</label>
                    <input type="text" class="form-control" id="rate" name="rate" placeholder="Enter room rate" value="<?php echo $rate?>">
                </div>
                <div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-select" id="status" name="status">
        <option value="Available" <?php echo ($status == 'Available') ? 'selected' : ''; ?>>Available</option>
        <option value="Booked" <?php echo ($status == 'Booked') ? 'selected' : ''; ?>>Booked</option>
        <option value="Unavailable" <?php echo ($status == 'Unavailable') ? 'selected' : ''; ?>>Unavailable</option>
    </select>
</div>

                <input type="submit" class="btn btn-primary" name="submit" value="Add Room">
            </form>

            <?php
                if(isset($_POST['submit'])){
                    $room_no=$_POST['room_no'];
                    $room_type = $_POST['room_type'];
                    $bed_type = $_POST['bed_type'];
                    $rate = $_POST['rate'];
                    $status = $_POST['status'];

                    // INSERT IN SQL
                    $sql = "UPDATE room SET room_no='$room_no', room_type='$room_type', bed_type='$bed_type', rate='$rate', status='$status' WHERE id=$id";

                    // db conn
                    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if($res == TRUE){
                        $_SESSION['update'] = "Room Updated Sucessfully";
                        header("location:".siteurl.'admin/rooms.php');
                        exit();
                    }
                    else{
                        $_SESSION['update'] = "Failed to update room";
                        header("location:".siteurl.'admin/rooms.php');
                        exit();
                    }
                }
            ?>
        </div>
    </div>
</div>

</main>

</body>
