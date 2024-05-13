<?php
require("../config/dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST request
    $doctorId = $_POST['doctorId'];
    $date = $_POST['date'];
    $timeSlot = $_POST['timeSlot'];

    // Construct the query to remove the slot
    $query = "DELETE FROM `pdms`.`schedule` WHERE `doctorid` = '$doctorId' AND `date` = '$date' AND `starttime` = '$timeSlot'";

    // Execute the query
    if ($con->query($query) === TRUE) {
        echo "success";
    } else {
        echo "Error removing slot: " . $con->error;
    }
} else {
    // If data is not received via POST, return error response
    echo "Error: Data not received via POST";
}
?>
