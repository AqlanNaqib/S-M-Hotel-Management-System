<?php
require_once __DIR__ . '/room_functions.php';
include(__DIR__ . '/admin_navbar.php');

if (isset($_POST['update_room'])) 
{
    $room_id = $_POST['room_ID'];
    $roomNumber = $_POST['roomNumber'];
    $PricePerNight = $_POST['PricePerNight'];
    $status = $_POST['status'];
    updateRoom($room_id, $roomNumber, $PricePerNight, $status);
    header("Location: viewRooms.php");
}
    

$room_id = $_GET['id'];
$room = viewRoom($room_id);
?>
<div>
    <link rel="stylesheet" href="admin.css" />
    <h2 class="centered-header">
        Update Room <?php echo $room[0]['room_ID']; ?> Details?
    </h2>
</div>

<div class="main">
    <form method="post" class="update-form-table">
        <input type="hidden" name="room_ID" value="<?php echo $room[0]['room_ID']; ?>">
        <label>Room Number:</label>
        <input type="text" name="roomNumber" value="<?php echo $room[0]['roomNumber']; ?>" required>
        <label>Price per night:</label>
        <input type="text" name="PricePerNight" value="<?php echo $room[0]['PricePerNight']; ?>" required>
        <label>Status:</label>
        <input type="text" name="status" value="<?php echo $room[0]['status']; ?>" required>
        <input type="submit" name="update_room" value="Update Room">
    </form>
</div>
