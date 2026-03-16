<?php
require_once __DIR__ . '/booking_functions.php';
include "admin_navbar.php";

if (isset ($_POST["deleteBooking"])) {
    $booking_id = $_POST["booking_id"];
    deleteBooking($booking_id);
    header("Location: viewBookings.php");
}

$booking_id = $_GET['id'];
$booking = viewBookings($booking_id);

?>
<div>
    <h2 class="centered-header" >
        Delete Booking <?php echo $booking[0]['booking_ID']; ?> Details?</h2>
</div>
<div class="main">
    <form method="post">
        <input type="hidden" name="booking_id" value="<?php echo $booking[0]['booking_ID']; ?>">
        <input type="hidden" name="checkInDate" value="<?php echo $booking[0]['checkInDate']; ?>" readonly>
        <input type="hidden" name="checkOutDate" value="<?php echo $booking[0]['checkOutDate']; ?>"readonly>
        <input type="hidden" name="bookingStatus" value="<?php echo $booking[0]['bookingStatus']; ?>"readonly>
        <input type="hidden" name="totalAmount" value="<?php echo $booking[0]['totalAmount']; ?>"readonly>
        <input type="hidden" name="paymentMethod" value="<?php echo $booking[0]['paymentMethod']; ?>"readonly>
        <input type="hidden" name="paymentStatus" value="<?php echo $booking[0]['paymentStatus']; ?>"readonly>
        <input type="submit" name="deleteBooking" value="Delete Booking">
    </form>
</div>