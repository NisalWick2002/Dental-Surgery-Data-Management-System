<?php

// Include your database connection file
require("../config/dbconnection.php");

// Start a session if not already started
if (!session_id()) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect or handle unauthorized access
    exit("Unauthorized access");
}

// Get the current patient's ID from the session
$patientId = $_SESSION['patientid'];

// Construct the SQL query to fetch appointments data
$query = "SELECT a.*, d.lastname, pm.name as paymentname
        FROM appointment AS a
        JOIN doctor AS d ON a.doctorid = d.doctorid
        JOIN paymentmethod AS pm ON a.paymentmethodid = pm.paymentmethodid
        WHERE a.patientid = '$patientId'
        ORDER BY a.appointmentdate ASC";

// Execute the query
$result = $con->query($query);

// Initialize an array to store appointments data
$appointments = array();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Fetch each row and add it to the appointments array
    while ($row = $result->fetch_assoc()) {
        // Construct an array representing an appointment
        $appointment = array(
            "appointmentID" => $row['appointmentid'],
            "date" => $row['appointmentdate'],
            "time" => $row['appointmentslot'],
            "queueNo" => $row['queueno'],
            "doctorName" => $row['lastname'],
            "status" => $row['status'],
            "charge" => $row['appointmentcharges'],
            "paymentMethod" => $row['paymentname']
        );

        // Add the appointment to the appointments array
        $appointments[] = $appointment;
    }
}

// Convert the appointments array to JSON format
$appointmentsJSON = json_encode($appointments);

// Set the appropriate headers to indicate JSON content
header('Content-Type: application/json');

// Output the JSON data
echo $appointmentsJSON;

// Close the database connection
$con->close();
