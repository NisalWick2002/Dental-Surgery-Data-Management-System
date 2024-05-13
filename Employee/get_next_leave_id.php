<?php
require("../config/dbconnection.php");
function increment_leave_id($current_leave_id)
{
    // Extract the numerical part of the leave ID
    $numeric_part = (int) substr($current_leave_id, 2);

    // Increment the numerical part
    $next_numeric_part = $numeric_part + 1;

    // Format the next leave ID with leading zeros
    $next_leave_id = 'EL' . sprintf("%04d", $next_numeric_part);

    // Return the next leave ID
    return $next_leave_id;
}
$query = "SELECT MAX(empleaveid) AS current_leave_id FROM employeeleave";
$result = $con->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $current_leave_id = $row['current_leave_id'];
    if ($current_leave_id == null) {
        $next_leave_id = "EL0001";
    } else {
        // Generate the next leave ID
        $next_leave_id = increment_leave_id($current_leave_id);
    }
    // Output the next leave ID
    echo $next_leave_id;
} else {
    echo "Error: " . $con->error;
}

// Close the database connection
$con->close();
