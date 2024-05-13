<?php
require("../config/dbconnection.php");
session_start();
$branchid = $_SESSION['branchid'];
$month = $_POST['month'];
$year = $_POST['year'];
$query = "SELECT date, description, amount
            FROM pdms.expense
            WHERE branchid = '$branchid' 
            AND YEAR(date) = '$year' 
            AND MONTHNAME(date) = '$month';";
$result = $con->query($query);
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
