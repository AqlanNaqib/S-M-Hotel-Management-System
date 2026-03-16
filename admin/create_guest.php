<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Guest</title>
    <link rel="stylesheet" href="admin.css" />
</head>

<body>
    <?php
    // This will embed the NavBar.php file
    include("admin_navbar.php");

    
    require_once("guest_functions.php");
    if (isset($_POST['createGuest'])) {
        addGuest($_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['email'], $_POST['phoneNo'], $_POST['address']);
        header('Location: viewGuest.php');
    }
    ?>
    <div>
        <h2 class="centered-header">Create New Guest</h2>
    </div>
    <div class="create-form main">
        <form method="post">
            <input type="text" name="firstName" placeholder="First Name" required>
            <input type="text" name="middleName" placeholder="Middle Name">
            <input type="text" name="lastName" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phoneNo" placeholder="Phone Number" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="submit" name="createGuest" value="Create Guest">
        </form>
    </div>
</body>
</html>