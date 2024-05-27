<?php
include('./ad_nav.php');



$sql = "SELECT room_id, COUNT(*) AS booking_count
        FROM booking
        GROUP BY room_id
        ORDER BY booking_count DESC
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $mostBookedRoomType = $row['room_id'];
} else {
    $mostBookedRoomType = "N/A"; // Set a default value if the query fails
}

// Booking Overview
$todayBookings = getBookingCount($conn, 'today');
$weekBookings = getBookingCount($conn, 'week');
$monthBookings = getBookingCount($conn, 'month');

// Revenue Information
$todayRevenue = getRevenue($conn, 'today');
$weekRevenue = getRevenue($conn, 'week');
$monthRevenue = getRevenue($conn, 'month');
$maintenanceRooms = getMaintenanceRooms($conn);

function getBookingCount($conn, $interval)
{
    $startDate = '';
    $endDate = '';

    // Set start and end dates based on the interval
    switch ($interval) {
        case 'today':
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');
            break;
        case 'week':
            $startDate = date('Y-m-d', strtotime('-1 week'));
            $endDate = date('Y-m-d');
            break;
        case 'month':
            $startDate = date('Y-m-d', strtotime('-1 month'));
            $endDate = date('Y-m-d');
            break;
    }

    $query = "SELECT COUNT(*) AS count FROM booking WHERE checkin_date BETWEEN '$startDate' AND '$endDate'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    } else {
        return 0;
    }
}

function getRevenue($conn, $interval)
{
    $startDate = '';
    $endDate = '';

    // Set start and end dates based on the interval
    switch ($interval) {
        case 'today':
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');
            break;
        case 'week':
            $startDate = date('Y-m-d', strtotime('-1 week'));
            $endDate = date('Y-m-d');
            break;
        case 'month':
            $startDate = date('Y-m-d', strtotime('-1 month'));
            $endDate = date('Y-m-d');
            break;
    }

    $query = "SELECT SUM(total_amount) AS revenue FROM booking WHERE checkin_date BETWEEN '$startDate' AND '$endDate'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['revenue'];
    } else {
        return 0;
    }
}

function getMaintenanceRooms($conn)
{
    $query = "SELECT room_no, room_type, bed_type, rate FROM room WHERE status = 'Unavailable'";
    $result = mysqli_query($conn, $query);

    $maintenanceRooms = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $maintenanceRooms[] = $row;
        }
    }

    return $maintenanceRooms;
}

?>

<!-- offcanvasawaaf -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body py-5">
                        <h5>Booking Overview</h5>
                        <p>Today: <?php echo $todayBookings; ?></p>
                        <p>This Week: <?php echo $weekBookings; ?></p>
                        <p>This Month: <?php echo $monthBookings; ?></p>
                    </div>
                    <div class="card-footer d-flex">
                        View Details
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body py-5">
                        <h5>Revenue Information</h5>
                        <p>Today: Rs.<?php echo $todayRevenue; ?></p>
                        <p>This Week: Rs.<?php echo $weekRevenue; ?></p>
                        <p>This Month: Rs.<?php echo $monthRevenue; ?></p>
                    </div>
                    <div class="card-footer d-flex">
                        View Details
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="card bg-danger text-white h-100">
                    <div class="card-body py-3">
                        <h5>Maintenance Status</h5>
                        <ul>
                            <?php foreach ($maintenanceRooms as $room) : ?>
                                <li><?php echo "Room " . $room['room_no'] . " - " . $room['room_type'] . " (" . $room['bed_type'] . ") - Rate: Rs." . $room['rate']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-footer d-flex">
                        View Details
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
