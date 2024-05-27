<?php
    include('../admin/ad_nav.php');
?>
</head>
<body>
<main class="mt-5 pt-3">
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <?php
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Booking History</h6>
            </div>
            <div class="table-responsive " style="padding-bottom:250px;">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">S.N.</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone No.</th>
                            <th scope="col">Room No.</th>
                            <th scope="col">CheckIn Date</th>
                            <th scope="col">CheckOut Date</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM booking";
                            $res = mysqli_query($conn, $sql);
                            if($res == TRUE){
                                $count = mysqli_num_rows($res);
                                $sn = 1;

                                if($count > 0){
                                    while($rows = mysqli_fetch_assoc($res)){
                                        $id = $rows['id'];
                                        $fname = $rows['fname'];
                                        $email = $rows['email'];
                                        $phone = $rows['phone'];
                                        $room_id = $rows['room_id'];
                                        $checkin_date = $rows['checkin_date'];
                                        $checkout_date = $rows['checkout_date'];
                                        $total_amount = $rows['total_amount'];
                                        $status = $rows['status'];
                        ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $fname ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $phone ?></td>
                            <td><?php echo $room_id ?></td>
                            <td><?php echo $checkin_date ?></td>
                            <td><?php echo $checkout_date ?></td>
                            <td><?php echo $total_amount ?></td>
                            <td><?php echo $status ?></td>
                            <td>
                            <a class="btn btn-sm btn-danger" href="<?php echo siteurl;?>admin/delete_booking.php?id=<?php echo $id;?>">Delete</a>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Change Status
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?php echo siteurl;?>admin/change_user_status.php?id=<?php echo $id;?>&status=Confirmed">Confirmed</a></li>
                                        <li><a class="dropdown-item" href="<?php echo siteurl;?>admin/change_user_status.php?id=<?php echo $id;?>&status=Cancelled">Cancelled</a></li>
                                        <li><a class="dropdown-item" href="<?php echo siteurl;?>admin/change_user_status.php?id=<?php echo $id;?>&status=Pending">Pending</a></li>
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
