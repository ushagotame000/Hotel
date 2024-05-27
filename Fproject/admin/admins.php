<?php
    include('./ad_nav.php');
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
           
            <h6 class="mb-0">Admins</h6>
            <a href="add-admin.php">Add admin</a>
        </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    
                                    <th scope="col">S.N.</th>
                                    <th scope="col">UserName</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $sql = "SELECT * FROM admins";
                                    $res = mysqli_query($conn, $sql);
                                    if($res == TRUE){
                                        $count = mysqli_num_rows($res);
                                        $sn =1;

                                    if($count>0){
                                        while($rows=mysqli_fetch_assoc($res)){
                                          $admin_id = $rows['admin_id'];
                                          $a_uname = $rows ['a_uname'];
                                          $email = $rows['email'];
                                  
                                          ?>
                                          <tr>
                                          <td><?php echo $sn++ ?></td>
                                          <td><?php echo $a_uname ?></td>
                                          <td><?php echo $email ?></td>
                                          <td>
                                          <a class="btn btn-sm btn-primary" href="<?php echo siteurl;?>admin/update-admin.php?admin_id=<?php echo $admin_id;?>">Update</a>
                                        <a class="btn btn-sm btn-warning" href="<?php echo siteurl;?>admin/changepwd.php?admin_id=<?php echo $admin_id;?>">Change Password</a>
                                        <a class="btn btn-sm btn-danger" href="<?php echo siteurl;?>admin/delete-admin.php?admin_id=<?php echo $admin_id;?>">Delete</a>
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