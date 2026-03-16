<?php
session_start();

// make sure only logged in admins can access
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

// connect to database
require_once '../db_connect.php';
$db = db_connect();

// array will hold all the data for our charts
$response = [];

// Chart 1: bookings are confirmed, cancelled, or completed
try {
    $query = "SELECT bookingStatus, COUNT(*) as count FROM Booking GROUP BY bookingStatus";
    $result = $db->query($query);

    // empty arrays for the chart
    $response['bookingStatus'] = [
        'labels' => [],
        'values' => []
    ];

    // loop through results and add them to our arrays
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $response['bookingStatus']['labels'][] = $row['bookingStatus'];
        $response['bookingStatus']['values'][] = (int)$row['count'];
    }
} catch (Exception $e) {
    // send empty data if goes wrong
    $response['bookingStatus'] = ['labels' => [], 'values' => []];
}

// Chart 2: How much money we made from each payment status
try {
    $query = "SELECT paymentStatus, SUM(totalAmount) as total 
              FROM Booking 
              GROUP BY paymentStatus";

    $result = $db->query($query);

    // empty arrays for revenue data
    $response['monthlyRevenue'] = [
        'labels' => [],
        'values' => []
    ];

    // get each payment status and its total revenue
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $response['monthlyRevenue']['labels'][] = $row['paymentStatus'];
        $response['monthlyRevenue']['values'][] = (float)$row['total'];
    }
} catch (Exception $e) {
    // ff there's an error, send empty arrays
    $response['monthlyRevenue'] = ['labels' => [], 'values' => []];
}

// Chart 3: how many rooms are available, occupied, or under maintenance
try {
    $query = "SELECT status, COUNT(*) as count FROM Room GROUP BY status";
    $result = $db->query($query);

    $response['roomStatus'] = [
        'labels' => [],
        'values' => []
    ];

    // add each room status to our chart data
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $response['roomStatus']['labels'][] = $row['status'];
        $response['roomStatus']['values'][] = (int)$row['count'];
    }
} catch (Exception $e) {
    $response['roomStatus'] = ['labels' => [], 'values' => []];
}

// Chart 4: Which room types are most popular
try {
    // query joins three tables 
    $query = "SELECT 
                rt.typeName,
                COUNT(b.booking_ID) as booking_count
              FROM Booking b
              JOIN Room r ON b.room_ID = r.room_ID
              JOIN RoomType rt ON r.roomType_ID = rt.roomType_ID
              GROUP BY rt.typeName
              ORDER BY booking_count DESC";

    $result = $db->query($query);

    $response['roomTypes'] = [
        'labels' => [],
        'values' => []
    ];

    // Get each room type and how many times it's been booked
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $response['roomTypes']['labels'][] = $row['typeName'];
        $response['roomTypes']['values'][] = (int)$row['booking_count'];
    }
} catch (Exception $e) {
    $response['roomTypes'] = ['labels' => [], 'values' => []];
}


$db->close();

// send JSON
header('Content-Type: application/json');
echo json_encode($response);
?>