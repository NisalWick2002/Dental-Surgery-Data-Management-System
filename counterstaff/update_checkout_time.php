<?php
// Include your database connection file
require("../config/dbconnection.php");

// Check if data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $chkid = $_POST['chkid'];
    $chkouttime = $_POST['chkouttime'];

    // Prepare the update query
    $updateQuery = "UPDATE pdms.empcheckinout SET checkouttime = '$chkouttime' WHERE checkinoutid = '$chkid'";

    // Execute the update query
    if ($con->query($updateQuery) === TRUE) {
        // Return success response
        echo "Checkout time updated successfully!";
    } else {
        // Return error response
        echo "Error updating checkout time: " . $con->error;
    }
} else {
    // If data is not received via POST, return error response
    echo "Error: Data not received via POST";
}
