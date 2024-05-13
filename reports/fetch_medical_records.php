<?php
require("../config/dbconnection.php");

// Check if the necessary POST parameters are provided
if (isset($_POST['medicalrecordid'])) {
    // Retrieve the medical record ID and sanitize it to prevent SQL injection
    $medicalrecordid = $con->real_escape_string($_POST['medicalrecordid']);

    // Construct the SQL query to retrieve medical record data
    $query = "SELECT m.*,
    CONCAT(p.firstname, ' ', p.lastname) AS patientname,
    CONCAT(d.firstname, ' ', d.lastname) AS doctorname,
    YEAR(CURDATE()) - YEAR(p.dob) - 
    (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(p.dob, '%m%d')) AS age 
    FROM medicalrecord m join patient p on 
    m.patientid = p.patientid
    join doctor d on d.doctorid = m.doctorid
    WHERE medicalrecordid = '$medicalrecordid'";

    // Execute the query
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        // Initialize an array to store the retrieved records
        $records = array();

        // Check if any records were found
        if ($result->num_rows > 0) {
            // Fetch each row and add it to the records array
            while ($row = $result->fetch_assoc()) {
                $record = array(
                    "patientname" => $row['patientname'],
                    "doctorname" => $row['doctorname'],
                    "specialnotes" => $row['specialnotes'],
                    "presentingcomplaints" => $row['presentingcomplaints'],
                    "date" => $row['date'],
                    "treatments" => $row['treatments'],
                    "age" => $row['age']
                );
                $records[] = $record;
            }
        }

        // Close the database connection
        $con->close();

        // Encode the records array into JSON format
        $recordsJSON = json_encode($records);

        // Set the appropriate headers to indicate JSON content
        header('Content-Type: application/json');

        // Output the JSON data
        echo $recordsJSON;
    } else {
        // If the query failed, return an error response
        echo json_encode(array("error" => "Failed to execute query."));
    }
} else {
    // If the required POST parameters are not provided, return an error response
    echo json_encode(array("error" => "Missing medical record ID."));
}
