<?php
    include('./ad_nav.php');
?>
</head>

<body>
<main class="mt-5 pt-3">
<div class="container">

    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <form method="post">
                <h3 class="text-center mb-4">Add Room</h3>
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
                    <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Enter room Number">
                </div>
                <div class="mb-3">
                    <label for="room_type" class="form-label">Room Type</label>
                    <select class="form-select" id="room_type" name="room_type">
                        <option value="standard">Standard</option>
                        <option value="deluxe">Deluxe</option>
                        <option value="suite">Suite</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bed_type" class="form-label">Bed Type</label>
                    <select class="form-select" id="bed_type" name="bed_type">
                        <option value="single">Single</option>
                        <option value="double">Double</option>
                        <option value="twin">Twin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="rate" class="form-label">Rate</label>
                    <input type="text" class="form-control" id="rate" name="rate" placeholder="Enter room rate">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="Available">Available</option>
                        <option value="Booked">Booked</option>
                        <option value="Unavailable">Unavailable</option>
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
                    $sql = "INSERT INTO room(room_no, room_type, bed_type, rate, status) VALUES ('$room_no', '$room_type', '$bed_type', '$rate', '$status')";

                    // db conn
                    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if($res == TRUE){
                        $_SESSION['add'] = "Room Added";
                        header("location:".siteurl.'admin/rooms.php');
                        exit();
                    }
                    else{
                        $_SESSION['add'] = "Failed to add room";
                        header("location:".siteurl.'admin/add_room.php');
                        exit();
                    }
                }
            ?>
        </div>
    </div>
</div>

</main>

</body>
