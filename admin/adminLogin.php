<?php
session_start();

// check if admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_dashboard.php");
    exit();
}

// include admin functions
require_once 'admin_functions.php';

// login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // validate data
    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        // use the verifyAdmin function
        $admin = verifyAdmin($username, $password);
        
        if ($admin) {
            // login successful
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['adminID'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['hotelID'] = $admin['hotelID'];
            $_SESSION['login_time'] = time();
            
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | S&M Hotel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body class="admin-body">
    <div class="container">
        
        <!--Home Button-->
        <div class="admin-back-wrapper">
            <a href="../index.php" class="admin-back-btn">Back to Homepage</a>
        </div>

        <!--Login Section (prevent xss)-->
        <section class="admin-login-section">
            <div class="admin-login-card">
                <h1 class="admin-login-title">Admin Login</h1>
                
                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <form action="" method="post" class="admin-login-form">
                    <div class="input box">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required 
                               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>

                    <div class="input box">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="button box">
                        <input type="submit" value="Login">
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>