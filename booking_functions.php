<?php
require_once('db_connect.php');

// add user info to guest table and return guest ID
function addGuest($first_name, $middle_name, $last_name, $email, $phone, $address) 
{
    $db = db_connect();
    
    // check if guest already exist with this email
    $check_stmt = $db->prepare("SELECT guest_ID FROM Guest WHERE email = :email");
    $check_stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $check_stmt->execute();
    $existing_guest = $result->fetchArray(SQLITE3_ASSOC);
    
    if ($existing_guest) {
        // update existing guest records
        $update_stmt = $db->prepare("UPDATE Guest SET firstName = :first_name, middleName = :middle_name, lastName = :last_name, phoneNo = :phone, address = :address WHERE guest_ID = :guest_id");
        $update_stmt->bindValue(':first_name', $first_name, SQLITE3_TEXT);
        $update_stmt->bindValue(':middle_name', $middle_name, SQLITE3_TEXT);
        $update_stmt->bindValue(':last_name', $last_name, SQLITE3_TEXT);
        $update_stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
        $update_stmt->bindValue(':address', $address, SQLITE3_TEXT);
        $update_stmt->bindValue(':guest_id', $existing_guest['guest_ID'], SQLITE3_INTEGER);
        $update_stmt->execute();
        $db->close();
        return $existing_guest['guest_ID'];
    } else {
        
        // create new guest
        $stmt = $db->prepare('INSERT INTO Guest (firstName, middleName, lastName, email, phoneNo, address) 
                             VALUES (:first_name, :middle_name, :last_name, :email, :phone, :address)');
        $stmt->bindValue(':first_name', $first_name, SQLITE3_TEXT);
        $stmt->bindValue(':middle_name', $middle_name, SQLITE3_TEXT);
        $stmt->bindValue(':last_name', $last_name, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
        $stmt->bindValue(':address', $address, SQLITE3_TEXT);
        
        if ($stmt->execute()) {
            $guest_id = $db->lastInsertRowID();
            $db->close();
            return $guest_id;
        } else {
            $db->close();
            return false;
        }
    }
}

// display hotels in dropdown list
function dropdownHotels($selected = '')
{
    $db = db_connect();
    $query = "SELECT hotelID, hotelName, city FROM Hotel ORDER BY hotelName";
    $results = $db->query($query);

    echo '<select name="hotel_id" id="hotel_id" required>';
    echo '<option value="">Select a Hotel</option>';

    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $is_selected = ($selected == $row['hotelID']) ? 'selected' : '';
        echo '<option value="' . htmlspecialchars($row['hotelID']) . '" ' . $is_selected . '>' . 
             htmlspecialchars($row['hotelName']) . ' (' . htmlspecialchars($row['city']) . ')</option>';
    }

    echo '</select>';
    $db->close();
}

// display room types in dropdown list
function dropdownRoomTypes($selected = '')
{
    $db = db_connect();
    $query = "SELECT roomType_ID, typeName, maxOccupancy FROM RoomType ORDER BY typeName";
    $results = $db->query($query);

    echo '<select name="room_type_id" id="room_type_id" required>';
    echo '<option value="">Select a Room Type</option>';

    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $is_selected = ($selected == $row['roomType_ID']) ? 'selected' : '';
        echo '<option value="' . htmlspecialchars($row['roomType_ID']) . '" ' . $is_selected . '>' . 
             htmlspecialchars($row['typeName']) . ' (Max ' . htmlspecialchars($row['maxOccupancy']) . ' guests)</option>';
    }

    echo '</select>';
    $db->close();
}

// get available rooms based on hotel, room type, and dates
function getAvailableRooms($hotel_id, $room_type_id, $check_in, $check_out)
{
    $db = db_connect();
    
    // get all rooms matching hotel and room type
    $query = "SELECT r.room_ID, r.roomNumber, r.PricePerNight, rt.typeName, rt.description
              FROM Room r
              JOIN RoomType rt ON r.roomType_ID = rt.roomType_ID
              WHERE r.hotelID = :hotel_id 
              AND r.roomType_ID = :room_type_id
              AND r.status = 'Available'";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':hotel_id', $hotel_id, SQLITE3_INTEGER);
    $stmt->bindValue(':room_type_id', $room_type_id, SQLITE3_INTEGER);
    $results = $stmt->execute();

    $available_rooms = [];

    while ($room = $results->fetchArray(SQLITE3_ASSOC)) {
        // check if this room is available 
        $check_stmt = $db->prepare("SELECT COUNT(*) as count FROM Booking 
                                    WHERE room_ID = :room_id 
                                    AND bookingStatus != 'Cancelled'
                                    AND (
                                        (checkInDate < :check_out AND checkOutDate > :check_in)
                                    )");
        
        $check_stmt->bindValue(':room_id', $room['room_ID'], SQLITE3_INTEGER);
        $check_stmt->bindValue(':check_in', $check_in, SQLITE3_TEXT);
        $check_stmt->bindValue(':check_out', $check_out, SQLITE3_TEXT);
        
        $check_result = $check_stmt->execute();
        $booking_data = $check_result->fetchArray(SQLITE3_ASSOC);
        
        // if count = 0, room is available
        if ($booking_data['count'] == 0) {
            $available_rooms[] = $room;
        }
    }

    $db->close();
    return $available_rooms;
}

// booking process function
function processCompleteBooking($first_name, $middle_name, $last_name, $email, $phone, $address, $room_id, $check_in, $check_out, $payment_method)
{
    // validate dates so that checkin>checkout
    $check_in_date = new DateTime($check_in);
    $check_out_date = new DateTime($check_out);
    $today = new DateTime();
    $today->setTime(0, 0, 0);
    
    if ($check_in_date < $today) {
        return [
            'success' => false,
            'message' => "Check-in date cannot be in the past"
        ];
    }
    
    if ($check_out_date <= $check_in_date) {
        return [
            'success' => false,
            'message' => "Check-out date must be after check-in date"
        ];
    }
    
    // add guest and get guest ID
    $guest_id = addGuest($first_name, $middle_name, $last_name, $email, $phone, $address);
    
    if (!$guest_id) {
        return [
            'success' => false,
            'message' => "Error: Could not add guest to database"
        ];
    }
    
    // create booking with the guest ID and room ID
    $booking_result = createBooking($guest_id, $room_id, $check_in, $check_out, $payment_method);
    
    if ($booking_result['success']) {
        return [
            'success' => true,
            'message' => "Booking successful!",
            'booking_id' => $booking_result['booking_id'],
            'guest_id' => $guest_id,
            'total_amount' => $booking_result['total_amount']
        ];
    } else {
        return [
            'success' => false,
            'message' => $booking_result['message']
        ];
    }
}

// create booking
function createBooking($guest_id, $room_id, $check_in, $check_out, $payment_method)
{
    $db = db_connect();
    
    // check if room is still available
    $check_stmt = $db->prepare("SELECT COUNT(*) as count FROM Booking 
                                WHERE room_ID = :room_id 
                                AND bookingStatus != 'Cancelled'
                                AND (
                                    (checkInDate < :check_out AND checkOutDate > :check_in)
                                )");
    
    $check_stmt->bindValue(':room_id', $room_id, SQLITE3_INTEGER);
    $check_stmt->bindValue(':check_in', $check_in, SQLITE3_TEXT);
    $check_stmt->bindValue(':check_out', $check_out, SQLITE3_TEXT);
    
    $check_result = $check_stmt->execute();
    $booking_data = $check_result->fetchArray(SQLITE3_ASSOC);
    
    if ($booking_data['count'] > 0) {
        $db->close();
        return [
            'success' => false,
            'message' => "Sorry, this room has just been booked by someone else. Please select another room."
        ];
    }
    
    // calculate total amount automatic
    $stmt = $db->prepare("SELECT PricePerNight FROM Room WHERE room_ID = :room_id");
    $stmt->bindValue(':room_id', $room_id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $room = $result->fetchArray(SQLITE3_ASSOC);
    
    if (!$room) {
        $db->close();
        return [
            'success' => false,
            'message' => "Error: Room not found"
        ];
    }
    
    $check_in_date = new DateTime($check_in);
    $check_out_date = new DateTime($check_out);
    $nights = $check_in_date->diff($check_out_date)->days;
    
    if ($nights < 1) {
        $db->close();
        return [
            'success' => false,
            'message' => "Error: Invalid date range"
        ];
    }
    
    $total_amount = $room['PricePerNight'] * $nights;
    
    // insert into booking table
    $insert_stmt = $db->prepare("INSERT INTO Booking (guest_ID, room_ID, checkInDate, checkOutDate, bookingStatus, totalAmount, paymentMethod, paymentStatus) 
                         VALUES (:guest_id, :room_id, :check_in, :check_out, 'Confirmed', :total_amount, :payment_method, 'Completed')");
    
    $insert_stmt->bindValue(':guest_id', $guest_id, SQLITE3_INTEGER);
    $insert_stmt->bindValue(':room_id', $room_id, SQLITE3_INTEGER);
    $insert_stmt->bindValue(':check_in', $check_in, SQLITE3_TEXT);
    $insert_stmt->bindValue(':check_out', $check_out, SQLITE3_TEXT);
    $insert_stmt->bindValue(':total_amount', $total_amount, SQLITE3_FLOAT);
    $insert_stmt->bindValue(':payment_method', $payment_method, SQLITE3_TEXT);
    
    if ($insert_stmt->execute()) {
        $booking_id = $db->lastInsertRowID();
        
        // update room status to occupied
        $update_stmt = $db->prepare("UPDATE Room SET status = 'Occupied' WHERE room_ID = :room_id");
        $update_stmt->bindValue(':room_id', $room_id, SQLITE3_INTEGER);
        $update_stmt->execute();
        
        $db->close();
        return [
            'success' => true,
            'booking_id' => $booking_id,
            'total_amount' => $total_amount
        ];
    } else {
        $db->close();
        return [
            'success' => false,
            'message' => "Error: Could not create booking in database"
        ];
    }
}




?>