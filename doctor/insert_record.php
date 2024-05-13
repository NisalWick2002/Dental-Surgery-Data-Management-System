<?php
// Include the database connection file
require("../config/dbconnection.php");

// Check if the data is received via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $medicalrecordid = $_POST['medicalrecordid'];
    $doctorid = $_POST['doctorid'];
    $patientid = $_POST['patientid'];
    $specialnotes = $_POST['specialnotes'];
    $presentingcomplaints = $_POST['presentingcomplaints'];
    $date = $_POST['date'];
    $treatments = $_POST['treatments'];
    $time = $_POST['time'];

    // Prepare the INSERT statement
    $insert_query = "INSERT INTO medicalrecord 
                    (medicalrecordid, doctorid, patientid, specialnotes, presentingcomplaints, date, treatments, time) 
                    VALUES 
                    ('$medicalrecordid', '$doctorid', '$patientid', '$specialnotes', '$presentingcomplaints', '$date', '$treatments', '$time')";

    // Execute the INSERT query
    if ($con->query($insert_query) === TRUE) {
        // If insertion is successful, send success response
        echo "Record added successfully";
    } else {
        // If insertion fails, send error response
        echo "Error: " . $con->error;
    }
} else {
    // If the request method is not POST, send error response
    echo "Invalid request method";
}

// Close the database connection
$con->close();
?>
