<?php
function db_connect() {
    $dbPath = __DIR__ . '/SM_Hotel.db';
    return new SQLite3($dbPath);
}
?>
