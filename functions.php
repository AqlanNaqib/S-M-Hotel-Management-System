<?php 

function createDB(){
    return $db = new SQLite3(filename: "SM_Hotel.db");
}

function insertData() { 
    $db = createDB();
    $insertData = "INSERT INTO Admin (hotelID,username, password) VALUES ('1','aqlan', 'aqlan123')";
    if($db->query($insertData)){ 
        echo "Data has been inserted successfully. <br>";
    } else { 
        echo "Error in inserting data. <br>".$db->lastErrorMsg();

    }
} 


$query = "SELECT name FROM sqlite_master WHERE type='table' AND name='Admin';";
$results = $db->query($query);
echo "--------------------------------<br>";
if ($results) {
    echo "Tables in the database: <br>";
    echo "--------------------------------<br>";
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        echo $row['name'] . "<br>";
    }
} else {    
    echo "Error retrieving tables: " . $db->lastErrorMsg() . "<br>";
}
echo "--------------------------------<br>";







$db->close()
/*if($db){
    echo"Database has been created successfully. <br>";
}
else{
    echo"Error in creating database. <br>".$db->lastErrorMsg();
}

$insertData = "INSERT INTO Admin (hotelID,username, password) VALUES ('1','aqlan', 'aqlan123')";
if($db->query($insertData)){
    echo"Data has been inserted successfully. <br>";
}
else{
    echo"Error in inserting data. <br>".$db->lastErrorMsg();
}

$update = $db->query("UPDATE Admin SET role = 'Manager' WHERE username = 'aqlan'");
if($update){
    echo"Data has been updated successfully. <br>";
}
else{
    echo"Error in updating data. <br>".$db->lastErrorMsg();
}

*/

?>