<?php
require("../config/dbconnection.php");

// Check if data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the next check-in ID from the database
    $query = "SELECT MAX(SUBSTRING_INDEX(checkinoutid, 'CK', -1)) AS max_id FROM empcheckinout";
    $result = $con->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $maxId = $row['max_id'];

        // Increment the maximum ID by one
        $nextIdNumber = ($maxId !== null) ? intval($maxId) + 1 : 1;

        // Format the next ID with leading zeros
        $nextCheckinId = 'CK' . str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT);
    } else {
        // Handle the case when there are no records in the table yet
        // You can set the initial check-in ID value here if needed
        $nextCheckinId = 'CK0001';
    }

    // Return the next check-in ID as the response
    echo $nextCheckinId;
} else {
    // If data is not received via POST, return an error response
    echo "Error: Data not received via POST";
}
?>
