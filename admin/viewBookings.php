<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="admin.css" />
</head>
<body>
    <?php
    include("admin_navbar.php");
    ?>
    <div>
        <h2 class="centered-header">S&M Hotel Bookings</h2>
    </div>
    <div class="main">
        <?php
        $dbPath = __DIR__ . '/../SM_Hotel.db';
        $db = new SQLite3($dbPath);

        // pagination
        $records_per_page = 4;
        $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($current_page < 1) 
            $current_page = 1;

        // calculate the offset
        $offset = ($current_page - 1 ) * $records_per_page;

        // count total records for pagination links
        $total_query = "SELECT COUNT(*) as count FROM Booking";
        $total_result = $db->query($total_query);
        $total_row = $total_result->fetchArray(SQLITE3_ASSOC);
        $total_records = $total_row['count'];
        $total_pages = ceil($total_records / $records_per_page);

        $select_query = "SELECT * FROM Booking LIMIT $records_per_page OFFSET $offset";
        $result = $db->query($select_query);
        echo "<table>";
        echo "<tr>
              <th>Booking ID</th>
              <th>Check In Date</th>
              <th>Check Out Date</th>
              <th>booking Status</th>
              <th>total Amount</th>
              <th>payment Method</th>
              <th>payment Status</th> 
              <th class='actions'>Actions</th></tr>";
                

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $booking_id = $row['booking_ID'];
            $checkInDate = $row['checkInDate'];
            $checkOutDate = $row['checkOutDate'];
            $bookingStatus = $row['bookingStatus'];
            $totalAmount = $row['totalAmount'];
            $paymentMethod = $row['paymentMethod'];
            $paymentStatus = $row['paymentStatus'];
            echo "<tr> 
                    <td>$booking_id</td> 
                    <td>$checkInDate</td>
                    <td>$checkOutDate</td>
                    <td>$bookingStatus</td>
                    <td>$totalAmount</td>
                    <td>$paymentMethod</td>
                    <td>$paymentStatus</td>
                    <td class='actions'>
                        <a href='update_booking.php?id=$booking_id'>Update</a>
                        <a href='delete_booking.php?id=$booking_id'>Delete</a>
                    </td>
                </tr>";
        }
        echo "</table>";
        // pagination links
        echo "<div class='pagination'>";
        if ($current_page > 1) {
            $prev_page = $current_page - 1;
            echo "<a href='?page=$prev_page'>Previous</a>";
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                echo "<strong>$i</strong>";
            } else {
                echo "<a href='?page=$i'>$i</a>";
            }
        }
        if ($current_page < $total_pages) {
            $next_page = $current_page + 1;
            echo "<a href='?page=$next_page'>Next</a>";
        }
        echo "</div>";
        $db->close();
        ?>
    </div>
</body>
</html>