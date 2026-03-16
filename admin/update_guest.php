<?php
require_once __DIR__ . '/guest_functions.php';
include(__DIR__ . '/admin_navbar.php');

if (isset($_POST['update_guest'])) 
{
    $guest_id = $_POST['guest_ID'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $address = $_POST['address'];
    updateGuest($guest_id, $firstName, $middleName, $lastName, $email, $phoneNo, $address);
    header("Location: viewGuest.php");
}
    

$guest_id = $_GET['id'];
$guest = viewGuest($guest_id);
?>
<div>
    <link rel="stylesheet" href="admin.css" />
    <h2 class="centered-header">
        Update Guest <?php echo $guest[0]['guest_ID']; ?> Details?
    </h2>
</div>

<div class="main">
    <form method="post" class="update-form-table">
        <input type="hidden" name="guest_ID" value="<?php echo $guest[0]['guest_ID']; ?>">
        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo $guest[0]['firstName']; ?>" required>
        <label>Middle Name:</label>
        <input type="text" name="middleName" value="<?php echo $guest[0]['middleName']; ?>">
        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo $guest[0]['lastName']; ?>" required>
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $guest[0]['email']; ?>" required>
        <label>Phone Number:</label>
        <input type="text" name="phoneNo" value="<?php echo $guest[0]['phoneNo']; ?>" required>
        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $guest[0]['address']; ?>" required>
        <input type="submit" name="update_guest" value="Update Guest">
    </form>
</div>
