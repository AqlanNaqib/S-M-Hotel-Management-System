<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Guests</title>
    <link rel="stylesheet" href="admin.css" />
</head>

<body>
    <?php
    include("admin_navbar.php");
    ?>
    <div>
        <h2 class="centered-header">S&M Hotel Guests</h2>
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
        $total_query = "SELECT COUNT(*) as count FROM Guest";
        $total_result = $db->query($total_query);
        $total_row = $total_result->fetchArray(SQLITE3_ASSOC);
        $total_records = $total_row['count'];
        $total_pages = ceil($total_records / $records_per_page);
        
        $select_query = "SELECT * FROM Guest LIMIT $records_per_page OFFSET $offset";
        $result = $db->query($select_query);
        echo "<table>";
        echo "<tr>
              <th>Guest ID</th>
              <th>First Name</th>
              <th>Middle Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Address</th> 
              <th class='actions'>Actions</th> </tr>";

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $guest_id = $row['guest_ID'];
            $firstName = $row['firstName'];
            $middleName = $row['middleName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $phoneNumber = $row['phoneNo'];
            $address = $row['address'];
            echo "<tr> 
                    <td>$guest_id</td>
                    <td>$firstName</td>
                    <td>$middleName</td>
                    <td>$lastName</td>
                    <td>$email</td>
                    <td>$phoneNumber</td>
                    <td>$address</td>
                    <td class='actions'>
                        <a href='update_guest.php?id=$guest_id'>Update</a>
                        <a href='delete_guest.php?id=$guest_id'>Delete</a>
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