<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Booking</title>
    <link rel="stylesheet" href="admin.css" />
</head>

<body>
    <?php
    // This will embed the NavBar.php file
    include("admin_navbar.php");

    
    require_once("booking_functions.php");
    if (isset($_POST['createBooking'])) {
        addBooking($_POST['CheckInDate'], $_POST['CheckOutDate'], $_POST['bookingStatus'], $_POST['totalAmount'], $_POST['paymentMethod'], $_POST['paymentStatus'], $_POST['guest_ID'], $_POST['room_ID']);
        header('Location: viewBookings.php');
    }
    ?>
    <div>
        <h2 class="centered-header">Create New Booking</h2>
    </div>
    <div class="create-form main">
        <form method="post">
            <input type="text" name="CheckInDate" placeholder="Check in date" required>
            <input type="text" name="CheckOutDate" placeholder="Check out date" required>
            <input type="text" name="bookingStatus" placeholder="Booking Status" required>
            <input type="number" name="totalAmount" min="0" step="0.01" placeholder="Total Amount" required>
            <input type="text" name="paymentMethod" placeholder="Payment Method" required>
            <input type="text" name="paymentStatus" placeholder="Payment Status" required>
            <input type="number" name="guest_ID" placeholder="Guest ID" required>
            <input type="number" name="room_ID" placeholder="Room ID" required>
            <input type="submit" name="createBooking" value="Create Booking">
        </form>
    </div>
</body>
</html>