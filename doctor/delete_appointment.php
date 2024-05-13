<?php

// Include your database connection file
require("../config/dbconnection.php");

// Check if appointmentID is set and not empty
if (isset($_POST['appointmentID']) && !empty($_POST['appointmentID'])) {
    // Sanitize the appointmentID to prevent SQL injection
    $appointmentID = $con->real_escape_string($_POST['appointmentID']);

    // Construct the SQL query to delete the appointment
    $query = "DELETE FROM appointment WHERE appointmentid = '$appointmentID'";

    // Execute the query
    if ($con->query($query)) {
        // Appointment deleted successfully
        echo json_encode(["success" => true]);
    } else {
        // Failed to delete appointment
        echo json_encode(["success" => false, "message" => "Failed to delete appointment"]);
    }
} else {
    // Invalid or missing appointmentID
    echo json_encode(["success" => false, "message" => "Invalid or missing appointmentID"]);
}

// Close the database connection
$con->close();
