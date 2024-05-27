<?php
    include('./ad_nav.php');
?>
</head>
<body>
<main class="mt-5 pt-3" >
<div class="container pt-4 px-4" >
    <div class="bg-light text-center rounded p-4">
    <?php
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
    ?>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Rooms</h6>
            <a href="add_room.php">Add Room</a>
        </div>
        <div class="table-responsive " style="padding-bottom:250px;">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">S.N.</th>
                        <th scope="col">Room Number</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Bed Type</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM room";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE){
                        $count = mysqli_num_rows($res);
                        $sn = 1;

                        if($count > 0){
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $room_no = $rows ['room_no'];
                                $room_type = $rows ['room_type'];
                                $bed_type = $rows ['bed_type'];
                                $rate = $rows ['rate'];
                                $status = $rows ['status'];
                    ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $room_no ?></td>
                        <td><?php echo $room_type ?></td>
                        <td><?php echo $bed_type ?></td>
                        <td><?php echo $rate ?></td>
                        <td><?php echo $status ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="<?php echo siteurl;?>admin/update_room.php?id=<?php echo $id;?>">Update</a>
                            <a class="btn btn-sm btn-danger" href="<?php echo siteurl;?>admin/delete_room.php?id=<?php echo $id;?>">Delete</a>
                            <div class="btn-group" style="postion: static;">
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Action
    </button>
    <ul class="dropdown-menu">

        <li><a class="dropdown-item" href="<?php echo siteurl;?>admin/change_status.php?id=<?php echo $id;?>&status=Available">Set Available</a></li>
        <li><a class="dropdown-item" href="<?php echo siteurl;?>admin/change_status.php?id=<?php echo $id;?>&status=Booked">Set Booked</a></li>
        <li><a class="dropdown-item" href="<?php echo siteurl;?>admin/change_status.php?id=<?php echo $id;?>&status=Unavailable">Set Unavailable</a></li>
    </ul>
</div>

                        </td>
                    </tr>
                    <?php
                        }
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</main>
</body>
