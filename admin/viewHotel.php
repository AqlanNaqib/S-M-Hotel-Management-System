<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Hotels</title>
    <link rel="stylesheet" href="admin.css" />
</head>

<body>
    <?php
    include("admin_navbar.php");
    ?>
    <div>
        <h2 class="centered-header">S&M Hotel Location</h2>
    </div>
    <div class="main">
        <?php
        $dbPath = __DIR__ . '/../SM_Hotel.db';
        $db = new SQLite3($dbPath);
        
        // pagination can be added here in the future
        $records_per_page = 4;
        $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($current_page < 1) 
            $current_page = 1;

        // calculate the offset
        $offset = ($current_page - 1 ) * $records_per_page;

        // count total records for pagination links
        $total_query = "SELECT COUNT(*) as count FROM Hotel";
        $total_result = $db->query($total_query);
        $total_row = $total_result->fetchArray(SQLITE3_ASSOC);
        $total_records = $total_row['count'];
        $total_pages = ceil($total_records / $records_per_page);

        $select_query = "SELECT * FROM Hotel LIMIT $records_per_page OFFSET $offset";
        $result = $db->query($select_query);
        echo "<table>";
        echo "<tr>
              <th>Hotel ID</th>
              <th>Hotel Name</th>
              <th>Hotel Address</th>
              <th>City</th>
              <th>Postcode</th>
              <th>Hotel tel no</th> 
              <th class='actions'>Actions</th> </tr>";

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $hotel_id = $row['hotelID'];
            $hotelName = $row['hotelName'];
            $hotelAddress = $row['hotelAddress'];
            $city = $row['city'];
            $postcode = $row['postcode'];
            $hotelTelNo = $row['hotel_telNo'];

            echo "<tr> 
                    <td>$hotel_id</td> 
                    <td>$hotelName</td>
                    <td>$hotelAddress</td>
                    <td>$city</td>
                    <td>$postcode</td>
                    <td>$hotelTelNo</td>
                    <td class='actions'>
                        <a href='update_hotel.php?id=$hotel_id'>Update</a>
                        <a href='delete_hotel.php?id=$hotel_id'>Delete</a>
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