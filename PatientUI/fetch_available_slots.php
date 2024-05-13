<?php
require("../config/dbconnection.php");


$date = $_POST['date'];
$doctorid = $_POST['doctorid'];


$query = "SELECT * FROM schedule WHERE date = '$date' AND doctorid = '$doctorid'";


$result = $con->query($query);


$slots = array();

if ($result->num_rows > 0) {
    // Fetch each row and add it to the records array
    while ($row = $result->fetch_assoc()) {
        $slot = array(
            "availabilityid" => $row['availabilityid'],
            "date" => $row['date'],
            "starttime" => $row['starttime'],
            "duration" => $row['duration'],
            "doctorid" => $row['doctorid']
        );
        $slots[] = $slot;
    }
}

// Close the database connection
$con->close();

// Encode the records array into JSON format
$recordsJSON = json_encode($slots);

// Set the appropriate headers to indicate JSON content
header('Content-Type: application/json');

// Output the JSON data
echo $recordsJSON;
