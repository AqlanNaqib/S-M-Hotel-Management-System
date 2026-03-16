<?php
require_once __DIR__ . '/../db_connect.php';

function viewHotel($hotel_id)
{
    $db = db_connect();

    $query = 'SELECT * FROM Hotel WHERE hotelID = :hotel_id';
    $stmt = $db->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $db->lastErrorMsg());
    }

    $stmt->bindValue(':hotel_id', $hotel_id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    $hotel_detail = [];

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $hotel_detail[] = $row;
    }

    $result->finalize();
    $db->close();
    return $hotel_detail;
}


function deleteHotel($hotel_id)
{
    $db = db_connect();

    $query = 'DELETE FROM Hotel WHERE hotelID = :hotel_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':hotel_id', $hotel_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}

function updateHotel($hotel_id,  $hotelName, $hotelAddress, $city, $postcode, $hotelTelNo)

{
    $db = db_connect();

    $query = 'UPDATE Hotel 
              SET  hotelName= :hotelName,
                  hotelAddress = :hotelAddress,
                  city = :city,
                  postcode = :postcode,
                  hotel_telNo = :hotelTelNo
              WHERE hotelID = :hotel_id';

    $stmt = $db->prepare($query);
    $stmt->bindValue(':hotelName', $hotelName, SQLITE3_TEXT);
    $stmt->bindValue(':hotelAddress', $hotelAddress, SQLITE3_TEXT);
    $stmt->bindValue(':city', $city, SQLITE3_TEXT);
    $stmt->bindValue(':postcode', $postcode, SQLITE3_TEXT);
    $stmt->bindValue(':hotelTelNo', $hotelTelNo, SQLITE3_TEXT);
    $stmt->bindValue(':hotel_id', $hotel_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}

function addHotel($hotelName, $hotelAddress, $city, $postcode, $hotelTelNo)
{
    $db = db_connect();

    $query = 'INSERT INTO Hotel (hotelName, hotelAddress, city, postcode, hotel_telNo)
              VALUES (:hotelName, :hotelAddress, :city, :postcode, :hotelTelNo)';

    $stmt = $db->prepare($query);
    $stmt->bindValue(':hotelName', $hotelName, SQLITE3_TEXT);
    $stmt->bindValue(':hotelAddress', $hotelAddress, SQLITE3_TEXT);
    $stmt->bindValue(':city', $city, SQLITE3_TEXT);
    $stmt->bindValue(':postcode', $postcode, SQLITE3_TEXT);
    $stmt->bindValue(':hotelTelNo', $hotelTelNo, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}
