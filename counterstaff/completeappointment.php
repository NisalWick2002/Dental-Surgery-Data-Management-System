<?php
require("../config/dbconnection.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appid = $_POST['appid'];
    $totalamount = $_POST['totalamount'];
    $balance = $_POST['balance'];
    $paidamount = $_POST['paidamount'];

    //get the current max id from payment table 
    $query = "select max(paymentid) as current_payment_id from payment";
    $result = $con->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $current_payment_id = $row['current_payment_id'];
        if ($current_payment_id == null) {
            $next_payment_id = "PT0001";
        } else {
            $next_payment_id = increment_payment_id($current_payment_id);
        }

        $query = "INSERT INTO `pdms`.`payment` 
                (`paymentid`, `totalamount`, `paidamount`, `balance`) 
                VALUES ('$next_payment_id', '$totalamount', '$paidamount', '$balance');";

        if ($con->query($query) === TRUE) {
            $query = "UPDATE `pdms`.`appointment` SET `paymentid` = '$next_payment_id', 
           `status` = 'Completed' WHERE (`appointmentid` = '$appid');";
            if ($con->query($query) === TRUE) {
                echo "Appointment is successfull!";
            } else {
                echo "Error: " . $query . "<br>" . $con->error;
            }
        } else {
            echo "Error: " . $query . "<br>" . $con->error;
        }
    } else {
        echo "Error: Couldn't fetch next payment id";
    }
} else {
    // If data is not received via POST, return error response
    echo "Error: Data not received via POST";
}


function increment_payment_id($current_payment_id)
{
    $numeric_part = (int) substr($current_payment_id, 2);
    $next_numeric_part = $numeric_part + 1;
    $next_payment_id = 'PT' . sprintf("%04d", $next_numeric_part);
    return $next_payment_id;
}
