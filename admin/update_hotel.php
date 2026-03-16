<?php
require_once __DIR__ . '/hotel_functions.php';
include(__DIR__ . '/admin_navbar.php');

if (isset($_POST['update_hotel'])) 
{
    $hotel_id = $_POST['hotelID'];
    $hotelName = $_POST['hotelName'];
    $hotelAddress = $_POST['hotelAddress'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $hotelTelNo = $_POST['hotel_telNo'];
    updateHotel($hotel_id, $hotelName, $hotelAddress, $city, $postcode, $hotelTelNo);
    header("Location: viewHotel.php");
}
    

$hotel_id = $_GET['id'];
$hotel = viewHotel($hotel_id);
?>
<div>
    <link rel="stylesheet" href="admin.css" />
    <h2 class="centered-header">
        Update Hotel <?php echo $hotel[0]['hotelID']; ?> Details?
    </h2>
</div>

<div class="main">
    <form method="post" class="update-form-table">
        <input type="hidden" name="hotelID" value="<?php echo $hotel[0]['hotelID']; ?>">
        <label>Hotel name:</label>
        <input type="text" name="hotelName" value="<?php echo $hotel[0]['hotelName']; ?>" required>
        <label>Hotel Address:</label>
        <input type="text" name="hotelAddress" value="<?php echo $hotel[0]['hotelAddress']; ?>" required>
        <label>City:</label>
        <input type="text" name="city" value="<?php echo $hotel[0]['city']; ?>" required>
        <label>Postcode:</label>
        <input type="text" name="postcode" value="<?php echo $hotel[0]['postcode']; ?>" required>
        <label>Hotel tel no:</label>
        <input type="text" name="hotel_telNo" value="<?php echo $hotel[0]['hotel_telNo']; ?>" required>
        <input type="submit" name="update_hotel" value="Update Hotel">
    </form>
</div>
