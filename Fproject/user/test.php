<?php
// Database connection
$host = 'your_host';
$username = 'your_username';
$password = 'your_password';
$database = 'your_database';
$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get user input
    $roomType = $_POST['room_type'];
    $bedType = $_POST['bed_type'];

    // Check if the room is available
    $checkRoomQuery = "SELECT id, rate FROM room WHERE room_type = '$roomType' AND bed_type = '$bedType' AND status = 'Available'";
    $result = mysqli_query($connection, $checkRoomQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        // Room is available, proceed with booking
        $roomData = mysqli_fetch_assoc($result);
        $roomId = $roomData['id'];
        $bookingRate = $roomData['rate'];  // You may calculate the total rate based on the booking duration

        // Insert booking record
        $insertBookingQuery = "INSERT INTO booking (room_id, user_id, checkin_date, checkout_date, status, total_rate)
                              VALUES ('$roomId', 'user_id_placeholder', 'checkin_date_placeholder', 'checkout_date_placeholder', 'Booked', '$bookingRate')";
        $bookingResult = mysqli_query($connection, $insertBookingQuery);

        if ($bookingResult) {
            // Update room status to 'Booked'
            $updateRoomQuery = "UPDATE room SET status = 'Booked' WHERE id = $roomId";
            mysqli_query($connection, $updateRoomQuery);

            echo "Booking Successful!";
        } else {
            echo "Failed to book the room.";
        }
    } else {
        // Room is not available
        echo "Room not available.";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
</head>
<body>

<form method="post">
    <label for="room_type">Room Type:</label>
    <select name="room_type" id="room_type">
        <option value="standard">Standard</option>
        <option value="deluxe">Deluxe</option>
        <option value="suite">Suite</option>
    </select>

    <label for="bed_type">Bed Type:</label>
    <select name="bed_type" id="bed_type">
        <option value="single">Single</option>
        <option value="double">Double</option>
        <option value="twin">Twin</option>
    </select>

    <button type="submit" name="submit">Book Room</button>
</form>

</body>
</html>
