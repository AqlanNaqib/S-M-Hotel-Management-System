<?php
require_once __DIR__ . '/../db_connect.php';

function viewGuest($guest_id)
{
    $db = db_connect();

    $query = 'SELECT * FROM Guest WHERE guest_ID = :guest_ID';
    $stmt = $db->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $db->lastErrorMsg());
    }

    $stmt->bindValue(':guest_ID', $guest_id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    $guest_detail = [];

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $guest_detail[] = $row;
    }

    $result->finalize();
    $db->close();
    return $guest_detail;
}


function deleteGuest($guest_id)
{
    $db = db_connect();

    $query = 'DELETE FROM Guest WHERE guest_ID = :guest_ID';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':guest_ID', $guest_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}

function updateGuest($guest_id, $firstName, $middleName, $lastName, $email, $phoneNumber, $address)
{
    $db = db_connect();

    $query = 'UPDATE Guest 
              SET firstName = :firstName,
                  middleName = :middleName,
                  lastName = :lastName,
                  email = :email,
                  phoneNo = :phoneNo,
                  address = :address
              WHERE guest_ID = :guest_ID';

    $stmt = $db->prepare($query);
    $stmt->bindValue(':firstName', $firstName, SQLITE3_TEXT);
    $stmt->bindValue(':middleName', $middleName, SQLITE3_TEXT);
    $stmt->bindValue(':lastName', $lastName, SQLITE3_TEXT); 
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':phoneNo', $phoneNumber, SQLITE3_TEXT);
    $stmt->bindValue(':address', $address, SQLITE3_TEXT);
    $stmt->bindValue(':guest_ID', $guest_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}

function addGuest($firstName, $middleName, $lastName, $email, $phoneNumber, $address)
{
    $db = db_connect();

    $query = 'INSERT INTO Guest (firstName, middleName, lastName, email, phoneNo, address)
              VALUES (:firstName, :middleName, :lastName, :email, :phoneNo, :address)';

    $stmt = $db->prepare($query);
    $stmt->bindValue(':firstName', $firstName, SQLITE3_TEXT);
    $stmt->bindValue(':middleName', $middleName, SQLITE3_TEXT);
    $stmt->bindValue(':lastName', $lastName, SQLITE3_TEXT); 
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':phoneNo', $phoneNumber, SQLITE3_TEXT);
    $stmt->bindValue(':address', $address, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

    $db->close();
}