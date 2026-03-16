<?php
require_once __DIR__ . '/room_functions.php';
include "admin_navbar.php";

if (isset($_POST["deleteRoom"])) {
    $room_id = $_POST["room_ID"];
    deleteRoom($room_id);
    header("Location: viewRooms.php");
}

$room_id = $_GET['id'];
$room = viewRoom($room_id);

?>
<div>
    <h2 class="centered-header">
        Delete Room <?php echo $room[0]['room_ID']; ?> Details?</h2>
</div>
<div class="main">
    <form method="post">
        <input type="hidden" name="room_ID" value='<?php echo $room[0]["room_ID"]; ?>'>
        <input type="hidden" name="roomNumber" value='<?php echo $room[0]["roomNumber"]; ?>' readonly>
        <input type="hidden" name="PricePerNight" value='<?php echo $room[0]["PricePerNight"]; ?>' readonly>
        <input type="hidden" name="satus" value='<?php echo $room[0]["status"]; ?>' readonly>
        <input type="submit" name="deleteRoom" value="Delete Room">
    </form>

</div>