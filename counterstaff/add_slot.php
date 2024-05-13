<?php
require("../config/dbconnection.php");

// Check if data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $doctorId = $_POST['doctorId'];
    $date = $_POST['date'];
    $timeSlot = $_POST['timeSlot'];

    // Get the current maximum availabilityid from the schedule table
    $query = "SELECT MAX(SUBSTRING_INDEX(availabilityid, 'AV', -1)) AS max_id FROM schedule";
    $result = $con->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $maxId = $row['max_id'];

        // Increment the maximum id by one to generate the next availabilityid
        $nextIdNumber = ($maxId !== null) ? intval($maxId) + 1 : 1;
        $nextAvailabilityId = 'AV' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
    } else {
        // Handle the case when there are no records in the table yet
        // You can set the initial availabilityid value here if needed
        $nextAvailabilityId = 'AV001';
    }
    if ($timeSlot == "11:30AM") {
        $duration = 2;
    } else {
        $duration = 2.5;
    }
    // Perform the insertion query
    $insertQuery = "INSERT INTO pdms.schedule (availabilityid, doctorid, date, starttime, duration) 
    VALUES ('$nextAvailabilityId', '$doctorId', '$date', '$timeSlot', '$duration')";

    // Execute the insertion query
    if ($con->query($insertQuery) === TRUE) {
        // Return success response
        echo "success";
    } else {
        // Return error response
        echo "Error adding slot: " . $con->error;
    }
} else {
    // If data is not received via POST, return error response
    echo "Error: Data not received via POST";
}
