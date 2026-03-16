<?php
require_once __DIR__ . '/hotel_functions.php';
include "admin_navbar.php";

if (isset($_POST["deleteHotel"])) {
    $hotel_id = $_POST["hotel_id"];
    deleteHotel($hotel_id);
    header("Location: viewHotel.php");
}

$hotel_id = $_GET['id'];
$hotel = viewHotel($hotel_id);

?>
<div>
    <h2 class="centered-header">
        Delete Hotel <?php echo $hotel[0]['hotelID']; ?> Details?</h2>
</div>
<div class="main">
    <form method="post">
        <input type="hidden" name="hotel_id" value='<?php echo $hotel[0]["hotelID"]; ?>'>
        <input type="hidden" name="hotelName" value='<?php echo $hotel[0]["hotelName"]; ?>' readonly>
        <input type="hidden" name="hotelAddress" value='<?php echo $hotel[0]["hotelAddress"]; ?>' readonly>
        <input type="hidden" name="city" value='<?php echo $hotel[0]["city"]; ?>' readonly>
        <input type="hidden" name="postcode" value='<?php echo $hotel[0]["postcode"]; ?>' readonly>
        <input type="hidden" name="hotelTelNo" value='<?php echo $hotel[0]["hotel_TelNo"]; ?>' readonly>

        <input type="submit" name="deleteHotel" value="Delete Hotel">
    </form>

</div>