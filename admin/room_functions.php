<?php
require_once __DIR__ . '/../db_connect.php';

function viewRoom($room_id)
{
    $db = db_connect();

    $query = 'SELECT * FROM Room WHERE room_ID = :room_id';
    $stmt = $db->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $db->lastErrorMsg());
    }

    $stmt->bindValue(':room_id', $room_id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    $room_detail = [];

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $room_detail[] = $row;
    }

    $result->finalize();
    $db->close();
    return $room_detail;
}


function deleteRoom($room_id)
{
    $db = db_connect();

    $query = 'DELETE FROM Room WHERE room_ID = :room_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':room_id', $room_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}

function updateRoom($room_id, $roomNumber, $PricePerNight, $status)
{
    $db = db_connect();

    $query = 'UPDATE Room 
              SET roomNumber = :roomNumber,
                  PricePerNight = :PricePerNight,
                  status = :status
              WHERE room_ID = :room_id';

    $stmt = $db->prepare($query);
    $stmt->bindValue(':roomNumber', $roomNumber, SQLITE3_TEXT);
    $stmt->bindValue(':PricePerNight', $PricePerNight, SQLITE3_FLOAT);
    $stmt->bindValue(':status', $status, SQLITE3_TEXT);
    $stmt->bindValue(':room_id', $room_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}

function addRoom($hotelID, $roomNumber, $roomType_ID, $PricePerNight, $status)
{
    $db = db_connect();

    $query = 'INSERT INTO Room (hotelID, roomNumber, roomType_ID, PricePerNight, status)
              VALUES (:hotelID, :roomNumber, :roomType_ID, :PricePerNight, :status)';

    $stmt = $db->prepare($query);
    $stmt->bindValue(':hotelID', $hotelID, SQLITE3_INTEGER);
    $stmt->bindValue(':roomNumber', $roomNumber, SQLITE3_TEXT);
    $stmt->bindValue(':roomType_ID', $roomType_ID, SQLITE3_INTEGER);
    $stmt->bindValue(':PricePerNight', $PricePerNight, SQLITE3_FLOAT);
    $stmt->bindValue(':status', $status, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}