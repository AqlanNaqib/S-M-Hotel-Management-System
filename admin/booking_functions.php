<?php
require_once __DIR__ . '/../db_connect.php';

function viewBookings($booking_id)
{
    $db = db_connect();

    $query = 'SELECT * FROM Booking WHERE booking_ID = :booking_id';
    $stmt = $db->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $db->lastErrorMsg());
    }

    $stmt->bindValue(':booking_id', $booking_id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    $booking_detail = [];

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $booking_detail[] = $row;
    }

    $result->finalize();
    $db->close();
    return $booking_detail;
}


function deleteBooking($booking_id)
{
    $db = db_connect();

    $query = 'DELETE FROM Booking WHERE booking_ID = :booking_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':booking_id', $booking_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}

function updateBooking($booking_id, $checkInDate, $checkOutDate, $bookingStatus, $totalAmount, $paymentMethod, $paymentStatus)
{
    $db = db_connect();

    $query = 'UPDATE Booking 
              SET checkInDate = :checkInDate,
                  checkOutDate = :checkOutDate,
                  bookingStatus = :bookingStatus,
                  totalAmount = :totalAmount,
                  paymentMethod = :paymentMethod,
                  paymentStatus = :paymentStatus
              WHERE booking_ID = :booking_id';

    $stmt = $db->prepare($query);
    $stmt->bindValue(':checkInDate', $checkInDate, SQLITE3_TEXT);
    $stmt->bindValue(':checkOutDate', $checkOutDate, SQLITE3_TEXT);
    $stmt->bindValue(':bookingStatus', $bookingStatus, SQLITE3_TEXT);
    $stmt->bindValue(':totalAmount', $totalAmount, SQLITE3_FLOAT);
    $stmt->bindValue(':paymentMethod', $paymentMethod, SQLITE3_TEXT);
    $stmt->bindValue(':paymentStatus', $paymentStatus, SQLITE3_TEXT);
    $stmt->bindValue(':booking_id', $booking_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}

function addBooking($checkInDate, $checkOutDate, $bookingStatus, $totalAmount, $paymentMethod, $paymentStatus)
{
    $db = db_connect();

    $query = 'INSERT INTO Booking (checkInDate, checkOutDate, bookingStatus, totalAmount, paymentMethod, paymentStatus)
              VALUES (:checkInDate, :checkOutDate, :bookingStatus, :totalAmount, :paymentMethod, :paymentStatus)';

    $stmt = $db->prepare($query);
    $stmt->bindValue(':checkInDate', $checkInDate, SQLITE3_TEXT);
    $stmt->bindValue(':checkOutDate', $checkOutDate, SQLITE3_TEXT);
    $stmt->bindValue(':bookingStatus', $bookingStatus, SQLITE3_TEXT);
    $stmt->bindValue(':totalAmount', $totalAmount, SQLITE3_FLOAT);
    $stmt->bindValue(':paymentMethod', $paymentMethod, SQLITE3_TEXT);
    $stmt->bindValue(':paymentStatus', $paymentStatus, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}
