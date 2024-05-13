<?php
// Include your database connection file
require("../config/dbconnection.php");


// Get the date, doctor ID, and start time from the request
$date = $_POST['selectedDate'];
$doctorId = $_POST['doctorId'];
$startTime = $_POST['startTime'];

// Construct the SQL query to count appointments
$query = "SELECT COUNT(*) AS AppointmentCount 
FROM appointment 
WHERE appointmentdate = '$date' 
AND doctorid = '$doctorId' 
AND appointmentslot = '$startTime'";

// Execute the query
$result = $con->query($query);

// Initialize a variable to store the count of appointments
$appointmentCount = 0;

// Check if there are any rows returned
if ($result && $result->num_rows > 0) {
    // Fetch the count of appointments
    $row = $result->fetch_assoc();
    $appointmentCount = $row['AppointmentCount'];
}

// Close the database connection
$con->close();

$response = array("AppointmentCount" => $appointmentCount);

// Return the count of appointments as JSON data
echo json_encode($response);
