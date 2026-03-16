<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: adminLogin.php");
  exit();
}

// Handle logout
if (isset($_POST['logout'])) {
  // Unset all session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Redirect to admin login page
  header("Location: adminLogin.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>S&M Hotel Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="admin.css" />
</head>

<body class="bgColor">
  <header>
    <div class="header">
      <div>
        <a class="navbar-brand" href="admin_dashboard.php">S&M Hotel Management System </a>
      </div>
      
      <div class="dropdown">
        <button class="dropbtn">Bookings
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="create_booking.php">Create New Booking</a>
          <a href="viewBookings.php">View Bookings</a>
        </div>
      </div>

      <div class="dropdown">
        <button class="dropbtn">Guests
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="create_guest.php">Create New Guest</a>
          <a href="viewGuest.php">View Guests</a>
        </div>
      </div>

      <div class="dropdown">
        <button class="dropbtn">Rooms
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="create_room.php">Create New Room</a>
          <a href="viewRooms.php">View Rooms</a>
        </div>
      </div>

      <div class="dropdown">
        <button class="dropbtn">Hotels
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="create_hotel.php">Create New Hotel</a>
          <a href="viewHotel.php">View Hotels</a>
        </div>
      </div>

      <form method="POST" class="logout-form">
          <button type="submit" name="logout">Logout</button>
      </form>

    </div>
  </header>
</body>

</html>