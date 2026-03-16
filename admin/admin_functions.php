<?php
// admin_functions.php
require_once __DIR__ . '/../db_connect.php';
// define createDB 
if (!function_exists('createDB')) {
    function createDB() {
        try {

            $dbPath = __DIR__ . '/../SM_Hotel.db'; 
            $db = new SQLite3($dbPath);
            

            $db->exec("PRAGMA foreign_keys = ON;");
            $db->exec("PRAGMA journal_mode = WAL;");
            
            return $db;
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}


function verifyAdmin($username, $password) {
    $db = createDB();
    
    $sql = "SELECT * FROM Admin WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    
    $admin = $result->fetchArray(SQLITE3_ASSOC);
    $stmt->close();
    $db->close();
    
    if ($admin && $password === $admin['password']) {
        return $admin;
    }
    
    return false;
}

?>