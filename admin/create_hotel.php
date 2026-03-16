<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Hotel</title>
    <link rel="stylesheet" href="admin.css" />
</head>

<body>
    <?php
    // This will embed the NavBar.php file
    include("admin_navbar.php");

    
    require_once("hotel_functions.php");
    if (isset($_POST['createHotel'])) {
        addHotel($_POST['hotelName'], $_POST['hotelAddress'], $_POST['city'], $_POST['postcode'], $_POST['hotel_telNo']);
        header('Location: viewHotel.php');
    }
    ?>
    <div>
        <h2 class="centered-header">Create New Hotel</h2>
    </div>
    <div class="create-form main">
        <form method="post">
            <input type="text" name="hotelName" placeholder="Hotel Name" required>
            <input type="text" name="hotelAddress" placeholder="Hotel Address" required>
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="postcode" placeholder="Postcode" required>
            <input type="text" name="hotel_telNo" placeholder="Hotel Telephone Number" required>
            <input type="submit" name="createHotel" value="Create Hotel">
        </form>
    </div>
</body>
</html>