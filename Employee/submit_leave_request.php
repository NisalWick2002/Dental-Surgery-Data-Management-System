<?php
// Include your database connection file if necessary
require("../config/dbconnection.php");
session_start();

// Check if data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $empleaveid = $_POST['empleaveid'];
    $employeeid = $_SESSION['employeeid']; // Assuming you've stored the employee ID in session
    $leavetypeid = $_POST['leavetypeid'];
    $reason = $_POST['reason'];
    $date = $_POST['date']; // Assuming the date is provided in the format 'YYYY-MM-DD'

    // Get the current system date
    $requestdate = date('Y-m-d');

    // Prepare and execute the SQL statement to insert leave request data into the database
    $query = "INSERT INTO employeeleave (empleaveid, employeeid, leavetypeid, reason, date, status, requestdate) 
              VALUES ('$empleaveid', '$employeeid', '$leavetypeid', '$reason', '$date', 'pending', '$requestdate')";
    
    if ($con->query($query) === TRUE) {
        // Return success response
        echo "Leave request submitted successfully!";
    } else {
        // Return error response
        echo "Error: " . $query . "<br>" . $con->error;
    }
} else {
    // If data is not received via POST, return error response
    echo "Error: Data not received via POST";
}
?>

