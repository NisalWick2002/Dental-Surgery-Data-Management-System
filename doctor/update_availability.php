<?php
// Include your database connection file
require("../config/dbconnection.php");

session_start();

// Get the doctor ID and date from the request
$doctorid = $_POST['doctorid'];
$date = $_POST['date'];

// Construct the SQL query to fetch available slots
$query = "SELECT starttime FROM pdms.schedule 
where doctorid='$doctorid' and date='$date';";

// Execute the query
$result = $con->query($query);

// Initialize an array to store available slots
$availableSlots = array();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Fetch each row and add starttime to available slots array
    while ($row = $result->fetch_assoc()) {
        $availableSlots[] = $row['starttime'];
    }
}

// Convert the available slots array to JSON format
$availableSlotsJSON = json_encode($availableSlots);

// Set the appropriate headers to indicate JSON content
header('Content-Type: application/json');

// Output the JSON data
echo $availableSlotsJSON;

// Close the database connection
$con->close();
