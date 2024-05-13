<?php
// Include the database connection
require("../config/dbconnection.php");

// Check if data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $chkid = $_POST['chkid'];
    $date = $_POST['date'];
    $empid = $_POST['empid'];
    $chkintime = $_POST['chkintime'];

    // Perform the insertion query
    $insertQuery = "INSERT INTO empcheckinout (checkinoutid, date, employeeid, checkintime) 
                    VALUES ('$chkid', '$date', '$empid', '$chkintime')";

    // Execute the insertion query
    if ($con->query($insertQuery) === TRUE) {
        // Return success response
        echo "sucess";
    } else {
        // Return error response
        echo "Error adding check-in record: " . $con->error;
    }
} else {
    // If data is not received via POST, return error response
    echo "Error: Data not received via POST";
}
?>
