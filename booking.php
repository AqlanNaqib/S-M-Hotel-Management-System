<?php
require_once('booking_functions.php');

$message = '';
$booking_result = null;
$available_rooms = [];
$show_rooms = false;

// handle room search
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_rooms'])) {
    $hotel_id = $_POST['hotel_id'];
    $room_type_id = $_POST['room_type_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    $available_rooms = getAvailableRooms($hotel_id, $room_type_id, $check_in, $check_out);
    $show_rooms = true;
}

// handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_booking'])) {
    $result = processCompleteBooking(
        $_POST['first_name'],
        $_POST['middle_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['room_id'],
        $_POST['check_in'],
        $_POST['check_out'],
        $_POST['payment_method']
    );

    $booking_result = $result;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&M Hotel Booking</title>
    <link rel="stylesheet" href="style/booking.css">
</head>

<body>
    <a href="index.php" class="back-btn">← Back to Homepage</a>
    <div class="container">
        <div class="header">
            <h1>S&M Hotel Booking System</h1>
            <p>Book your stay with us</p>
        </div>

        <?php if ($booking_result): ?>
            <?php if ($booking_result['success']): ?>
                <div class="success-box">
                    <h2>Booking Successful</h2>
                    <p><strong>Booking ID:</strong> <?php echo $booking_result['booking_id']; ?></p>
                    <p><strong>Guest ID:</strong> <?php echo $booking_result['guest_id']; ?></p>
                    <p><strong>Total Amount:</strong> £<?php echo number_format($booking_result['total_amount'], 2); ?></p>
                    <p>Thank you for your booking!</p>
                    <a href="booking1.php" class="btn">📋 Book Another Room</a>
                </div>
            <?php else: ?>
                <div class="error-box">
                    <h2>Booking Failed</h2>
                    <p><?php echo $booking_result['message']; ?></p>
                    <a href="booking1.php" class="btn">🔄 Try Again</a>
                </div>
            <?php endif; ?>
        <?php else: ?>

            <div class="booking-form">
                <!-- search for available rooms -->
                <form method="POST" id="searchForm">
                    <div class="form-section">
                        <h2>Search Available Rooms</h2>

                        <div class="form-group">
                            <label for="hotel_id">Select Hotel *</label>
                            <?php dropdownHotels(isset($_POST['hotel_id']) ? $_POST['hotel_id'] : ''); ?>
                        </div>

                        <div class="form-group">
                            <label for="room_type_id">Select Room Type *</label>
                            <?php dropdownRoomTypes(isset($_POST['room_type_id']) ? $_POST['room_type_id'] : ''); ?>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="check_in">Check-in Date *</label>
                                <input type="date" id="check_in" name="check_in"
                                    value="<?php echo isset($_POST['check_in']) ? $_POST['check_in'] : ''; ?>"
                                    min="<?php echo date('Y-m-d'); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="check_out">Check-out Date *</label>
                                <input type="date" id="check_out" name="check_out"
                                    value="<?php echo isset($_POST['check_out']) ? $_POST['check_out'] : ''; ?>"
                                    min="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>

                        <button type="submit" name="search_rooms" class="btn-submit">
                            Search Available Rooms
                        </button>
                    </div>
                </form>

                <!-- show available rooms and booking form -->
                <?php if ($show_rooms): ?>
                    <?php if (count($available_rooms) > 0): ?>
                        <form method="POST" id="bookingForm">
                            <input type="hidden" name="hotel_id" value="<?php echo $_POST['hotel_id']; ?>">
                            <input type="hidden" name="room_type_id" value="<?php echo $_POST['room_type_id']; ?>">
                            <input type="hidden" name="check_in" value="<?php echo $_POST['check_in']; ?>">
                            <input type="hidden" name="check_out" value="<?php echo $_POST['check_out']; ?>">

                            <div class="form-section">
                                <h2>Available Rooms</h2>
                                <div class="rooms-list">
                                    <?php foreach ($available_rooms as $room): ?>
                                        <div class="room-option">
                                            <input type="radio"
                                                id="room_<?php echo $room['room_ID']; ?>"
                                                name="room_id"
                                                value="<?php echo $room['room_ID']; ?>"
                                                required>
                                            <label for="room_<?php echo $room['room_ID']; ?>">
                                                <strong>Room <?php echo $room['roomNumber']; ?></strong> -
                                                <?php echo $room['typeName']; ?> -
                                                £<?php echo number_format($room['PricePerNight'], 2); ?>/night
                                                <br>
                                                <small><?php echo $room['description']; ?></small>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="form-section">
                                <h2>Guest Information</h2>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="first_name">First Name *</label>
                                        <input type="text" id="first_name" name="first_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" id="middle_name" name="middle_name">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="last_name">Last Name *</label>
                                        <input type="text" id="last_name" name="last_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" id="email" name="email" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="phone">Phone Number *</label>
                                        <input type="tel" id="phone" name="phone" pattern="[0-9]{10,15}" required>
                                        <small>10-15 digits</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address *</label>
                                        <textarea id="address" name="address" rows="2" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h2>Payment Information</h2>

                                <div class="form-group">
                                    <label for="payment_method">Payment Method *</label>
                                    <select id="payment_method" name="payment_method" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="Cash">💵 Cash</option>
                                        <option value="Card">💳 Card</option>
                                        <option value="Online">🌐 Online</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" name="submit_booking" class="btn-submit">
                                 Confirm Booking
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="info-box">
                            <h2> No Rooms Available</h2>
                            <p>Sorry, there are no available rooms matching your criteria for the selected dates.</p>
                            <p>Please try different dates or a different room type.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>