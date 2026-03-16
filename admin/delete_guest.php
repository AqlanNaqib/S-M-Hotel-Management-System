<?php
require_once __DIR__ . '/guest_functions.php';
include "admin_navbar.php";

if (isset ($_POST["deleteGuest"])) {
    $guest_id = $_POST["guest_ID"];
    deleteGuest($guest_id);
    header("Location: viewGuest.php");
}

$guest_id = $_GET['id'];
$guest = viewGuest($guest_id);

?>
<div>
    <h2 class="centered-header" >
        Delete Guest <?php echo $guest[0]['guest_ID']; ?> Details?</h2>
</div>
<div class="main">
    <form method="post">
        <input type="hidden" name="guest_ID" value="<?php echo $guest[0]['guest_ID']; ?>">
        <input type="hidden" name="firstName" value="<?php echo $guest[0]['firstName']; ?>" readonly>
        <input type="hidden" name="middleName" value="<?php echo $guest[0]['middleName']; ?>" readonly>
        <input type="hidden" name="lastName" value="<?php echo $guest[0]['lastName']; ?>" readonly>
        <input type="hidden" name="email" value="<?php echo $guest[0]['email']; ?>" readonly>
        <input type="hidden" name="phoneNo" value="<?php echo $guest[0]['phoneNo']; ?>" readonly>
        <input type="submit" name="deleteGuest" value="Delete Guest">
    </form>
</div>
