<?php
require("../config/dbconnection.php");
session_start();
// Fetch data from POST request
$doctorId = $_POST['doctorId'];
$appointmentDate = $_POST['appointmentDate'];
$appointmentSlot = $_POST['appointmentSlot'];
$queueNo = $_POST['queueNo'];
$patientId = $_SESSION['patientid'];
$appointmentId = $_POST['appointmentId'];
$paymentMethod = $_POST['paymentMethod'];

// SQL query to insert appointment data into the appointment table
$insertQuery = "INSERT INTO `pdms`.`appointment`
            (`appointmentid`, `paymentmethodid`, `patientid`, `doctorid`, `status`,
            `appointmentcharges`, `createddate`, `appointmentdate`
            , `appointmentslot`, `queueno`) 
            VALUES ('$appointmentId', '$paymentMethod', '$patientId', '$doctorId', 'In Progress', '3500', NOW(),
            '$appointmentDate', '$appointmentSlot', '$queueNo')";

// Execute the query
if ($con->query($insertQuery) === TRUE) {
    // If the appointment is successfully created, return a success message
    echo json_encode(array('success' => true));
} else {
    // If there is an error, return an error message
    echo json_encode(array('success' => false, 'error' => 'Failed to create appointment: ' . $con->error));
}

// Close the database connection
$con->close();
