<?php
require_once __DIR__ . '/booking_functions.php';
include(__DIR__ . '/admin_navbar.php');

if (isset($_POST['update_booking'])) 
{
    $booking_id = $_POST['booking_id'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $bookingStatus = $_POST['bookingStatus'];
    $totalAmount = $_POST['totalAmount'];
    $paymentMethod = $_POST['paymentMethod'];
    $paymentStatus = $_POST['paymentStatus'];
    updateBooking($booking_id, $checkInDate, $checkOutDate, $bookingStatus, $totalAmount, $paymentMethod, $paymentStatus);
    header("Location: viewBookings.php");
}
    

$booking_id = $_GET['id'];
$booking = viewBookings($booking_id);
?>
<div>
    <link rel="stylesheet" href="admin.css" />
    <h2 class="centered-header">
        Update Booking <?php echo $booking[0]['booking_ID']; ?> Details?
    </h2>
</div>

<div class="main">
    <form method="post" class= "update-form-table">
        <input type="hidden" name="booking_id" value="<?php echo $booking[0]['booking_ID']; ?>">
        <label>Check In Date:</label>
        <input type="text" name="checkInDate" value="<?php echo $booking[0]['checkInDate']; ?>" required>
        <label>Check Out Date:</label>
        <input type="text" name="checkOutDate" value="<?php echo $booking[0]['checkOutDate']; ?>" required>
        <label>Booking Status:</label>
        <input type="text" name="bookingStatus" value="<?php echo $booking[0]['bookingStatus']; ?>" required>
        <label>Total Amount:</label>
        <input type="text" name="totalAmount" value="<?php echo $booking[0]['totalAmount']; ?>" required>
        <label>Payment Method:</label>
        <input type="text" name="paymentMethod" value="<?php echo $booking[0]['paymentMethod']; ?>" required>
        <label>Payment Status:</label>
        <input type="text" name="paymentStatus" value="<?php echo $booking[0]['paymentStatus']; ?>" required>
        <input type="submit" name="update_booking" value="Update Booking">
    </form>
</div>
