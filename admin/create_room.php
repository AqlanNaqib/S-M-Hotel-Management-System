<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Room</title>
    <link rel="stylesheet" href="admin.css" />
</head>

<body>
    <?php
    // This will embed the NavBar.php file
    include("admin_navbar.php");

    
    require_once("room_functions.php");
    if (isset($_POST['createRoom'])) {
        addRoom($_POST['hotelID'], $_POST['roomNumber'], $_POST['roomType_ID'], $_POST['PricePerNight'], $_POST['status']);
        header('Location: viewRooms.php');
    }
    ?>
    <div>
        <h2 class="centered-header">Create New Room</h2>
    </div>
    <div class="create-form main">
        <form method="post">
            <input type="number" name="hotelID" placeholder="Hotel ID" required>
            <input type="text" name="roomNumber" placeholder="Room Number" required>
            <input type="number" name="roomType_ID" placeholder="Room Type ID" required>
            <input type="number" name="PricePerNight" min="0" step="0.01" placeholder="Price Per Night" required>
            <input type="text" name="status" placeholder="Status" required>
            <input type="submit" name="createRoom" value="Create Room">
        </form>
    </div>
</body>
</html>