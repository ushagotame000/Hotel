<?php
include('../config/constants.php');
include('../user/checklog.php');
include('../user/bootstrap_headder.php');
include('../user/navbar.php');

$minimumDate = date('Y-m-d', strtotime('+1 day'));

// Fetch available room numbers based on the provided room type
$room_type = $_GET['room_type'];
$sql = "SELECT room_no, rate FROM room WHERE room_type = '$room_type' AND status = 'Available'";
$result = $conn->query($sql);
$roomNumbers = [];
while ($row = $result->fetch_assoc()) {
    $roomNumbers[] = $row;
}

$email = $_GET['email'];

$sql1 = "SELECT username, email, phone FROM users WHERE email = '$email'";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $username = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $fullName = mysqli_real_escape_string($conn, $_POST['uname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $checkinDate = mysqli_real_escape_string($conn, $_POST['checkin']);
    $checkoutDate = mysqli_real_escape_string($conn, $_POST['checkout']);
    $roomType = mysqli_real_escape_string($conn, $_POST['roomType']);
    $selectedRoomNo = mysqli_real_escape_string($conn, $_POST['availableRoom']);

    // Validate dates and other inputs
    // ...

    // Find the selected room details
    $selectedRoom = null;
    foreach ($roomNumbers as $room) {
        if ($room['room_no'] == $selectedRoomNo) {
            $selectedRoom = $room;
            break;
        }
    }

    if ($selectedRoom) {
        // Calculate the total amount
        $ratePerDay = $selectedRoom['rate'];
        $datetime1 = new DateTime($checkinDate);
        $datetime2 = new DateTime($checkoutDate);
        $interval = $datetime1->diff($datetime2);
        $numberOfDays = $interval->days;
        $totalAmount = $ratePerDay * $numberOfDays;

        // Insert the booking information into the booking table
        $sqlBooking = "INSERT INTO booking (room_id, fname, email, phone, checkin_date, checkout_date, status, total_amount)
            VALUES ('$selectedRoomNo', '$fullName', '$email', '$phone', '$checkinDate', '$checkoutDate', 'Pending', $totalAmount)";

        if (mysqli_query($conn, $sqlBooking)) {
            // Update room status to 'Booked'
            $sqlUpdateRoom = "UPDATE room SET status = 'Booked' WHERE room_no = '$selectedRoomNo'";
            mysqli_query($conn, $sqlUpdateRoom);

            echo "<script>
            if (confirm('Room booked successfully. Total Amount: $totalAmount. Do you want to confirm?')) {
                window.location.href = 'history.php';
            } else {
                window.location.href = '../index.php';
            }
                  </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Selected room not found.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
    <link rel="stylesheet" href="../css/book.css">
</head>

<body>
    <div class="booking-form-box">
        <form action="" method="post">
            <div class="booking-form">
                <label for="uname">Full Name</label>
                <input type="text" class="form-control" name="uname" placeholder="Full Name" value="<?php echo $username ?>" required />
                <div class="input-grp">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?php echo $email ?>" required />
                </div>
                <div class="input-grp">
                    <label for="phone">Phone</label>
                    <input type="number" maxlength="10" placeholder="Phone number" class="form-control " name="phone" value="<?php echo $phone ?>" required />
                </div>
                <div class="input-grp">
                    <label for="checkin">Check-in Date</label>
                    <input type="date" name="checkin" class="form-control select-date" min="<?php echo $minimumDate; ?>" required />
                </div>
                <div class="input-grp">
                    <label for="checkout">Check-out Date</label>
                    <input type="date" name="checkout" class="form-control select-date" min="<?php echo $minimumDate; ?>" required />
                </div>
                <div class="input-grp">
                    <label for="roomType">Select Room Type</label>
                    <select class="custom-select" name="roomType" required>
                        <?php
                        if (isset($_GET['room_type'])) {
                            $selectedRoomType = $_GET['room_type'];
                            echo "<option value='$selectedRoomType' selected>$selectedRoomType</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-grp">
                    <label for="availableRoom">Select Available Room</label>
                    <select class="custom-select" name="availableRoom" required>
                        <?php foreach ($roomNumbers as $room) : ?>
                            <option value="<?php echo $room['room_no']; ?>">
                                <?php echo "Room: " . $room['room_no'] . " - Rate: Rs" . $room['rate']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-grp">
                    <input type="submit" class="form-control" value="Book Room" name="submit">
                </div>
            </div>
        </form>
    </div>
</body>

</html>
