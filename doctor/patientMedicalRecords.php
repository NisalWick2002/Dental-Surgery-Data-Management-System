<?php
require("../config/dbconnection.php");
session_start();
$docid = $_SESSION['doctorid'];

$getMRecquery = "SELECT medicalrecordid,
                patientid,
                (SELECT CONCAT(firstname, ' ', lastname) 
                FROM patient WHERE patientid = m.patientid) 
                AS patientname,
                (SELECT CONCAT(firstname, ' ', lastname) 
                FROM doctor WHERE doctorid = m.doctorid) 
                AS doctorname,
                date
                FROM medicalrecord m;";

$allRecords = $con->query($getMRecquery);
while ($record = $allRecords->fetch_assoc()) {
    $medicalRecords[] = $record;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Medical Records</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="medicalRecords.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/637ae4e7ce.js" crossorigin="anonymous"></script>
    <script src="/bootstrap-5.3.2/dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="/bootstrap-5.3.2/dist/css/bootstrap.min.css" type="text/css">
</head>

<body>
    <nav>
        <ul>
            <li>
                <a href="#">
                    <i class="fa-solid fa-bars sideBarIcon"></i>
                    <span class="nav-item">PSW Dental</span>
                </a>
            </li>
            <li>
                <a href="dashboard.php" class="nav-list-item">
                    <i class="fas fa-home sideBarIcon"></i>
                    <span class="nav-item">Home</span>
                </a>
            </li>
            <li>
                <a href="patientMedicalRecords.php" class="nav-list-item">
                    <i class="fas fa-user sideBarIcon"></i>
                    <span class="nav-item">Patient Medical Record</span>
                </a>
            </li>
            <li>
                <a href="addMedicalRecord.php" class="nav-list-item">
                    <i class="fas fa-wallet sideBarIcon"></i>
                    <span class="nav-item">Add Medical Record</span>
                </a>
            </li>
            <li>
                <a href="Pappointments.php" class="nav-list-item">
                    <i class="fas fa-chart-bar sideBarIcon"></i>
                    <span class="nav-item">MY Appointments</span>
                </a>
            </li>
            <li>
                <a href="doctorSchedule.php" class="nav-list-item">
                    <i class="fas fa-tasks sideBarIcon"></i>
                    <span class="nav-item">My Schedule</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout nav-list-item">
                    <i class="fas fa-sign-out-alt sideBarIcon"></i>
                    <span class="nav-item">Log out</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="top">
        <p class="">Patient Medcial Records</p>
        <a href="addMedicalRecord.php">
            <button class="btn btn-primary addexpense" id="addexpense">Add Record</button>
        </a>
    </div>
    <div class="bottom">
        <input name="" id="searchValue" class="form-control" type="text" placeholder="eg :2024/05/02"></input>
        <input name="" id="searchValue2" class="form-control" type="text" placeholder="eg :Patient Name"></input>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="small">Record ID</th>
                    <th class="small">Patient ID</th>
                    <th class="large">Patient Name</th>
                    <th class="medium">Date</th>
                    <th class="large">Doctor Name</th>
                    <th class="medium">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </table>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var records = <?php echo json_encode($medicalRecords); ?>;
    console.log(records);
    // var records = [{
    //         mrid: "MR001",
    //         pid: "P001",
    //         date: "2023/05/08",
    //         name: "Pubudu",
    //         docname: "Dr. Silva"
    //     },
    //     {
    //         mrid: "MR002",
    //         pid: "P002",
    //         date: "2023/05/08",
    //         name: "Pamod",
    //         docname: "Dr. Amali"
    //     },
    //     {
    //         mrid: "MR003",
    //         pid: "P003",
    //         date: "2023/05/09",
    //         name: "Kamal",
    //         docname: "Dr. Perera"
    //     },
    //     {
    //         mrid: "MR004",
    //         pid: "P001",
    //         date: "2023/05/10",
    //         name: "Pubudu",
    //         docname: "Dr. Silva"
    //     },
    //     {
    //         mrid: "MR005",
    //         pid: "P002",
    //         date: "2023/05/11",
    //         name: "Pamod",
    //         docname: "Dr. Niroshana"
    //     },
    // ]

    $('.logout').click(function() {
        // Send an AJAX request to logout
        $.ajax({
            type: 'POST', // or 'GET' depending on your server-side implementation
            url: '../user/logout.php', // URL to your logout endpoint
            success: function(response) {
                window.location.href = '../user/login.php';
            },
            error: function(xhr, status, error) {
                console.error('Error occurred while logging out:', error);
            }
        });
    });

    // Add event listener after filling the table
    function addEventListenerToButtons() {
        // Get all elements with the class name '.btn-viewrecord'
        var buttons = document.querySelectorAll('.btn-viewrecord');

        // Loop through each button and add event listener
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'medicalRecord.php';


                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'medicalrecordid';
                hiddenInput.value = this.dataset.recordid;

                form.appendChild(hiddenInput);

                document.body.appendChild(form);
                form.submit();

                document.body.removeChild(form);
            });
        });
    }

    function fillTable(data) {
        var tbody = document.querySelector(".table tbody");
        tbody.innerHTML = "";
        // Loop through the data and create table rows
        data.forEach(function(item) {
            var row = document.createElement("tr");

            row.innerHTML = `
                    <td class="small">${item.medicalrecordid}</td>
                    <td class="small">${item.patientid}</td>
                    <td class="large">${item.patientname}</td>
                    <td class="medium">${item.date}</td>
                    <td class="large">${item.doctorname}</td>
                    <td class="medium"><button class="btn btn-outline-info btn-viewrecord" data-recordid="${item.medicalrecordid}">View Record</button></td>
                `;
            tbody.appendChild(row);
        });
    }


    document.addEventListener("DOMContentLoaded", function() {
        var searchValue = document.getElementById("searchValue");
        var searchValue2 = document.getElementById("searchValue2");

        var tbody = document.querySelector(".table tbody");


        fillTable(records);
        addEventListenerToButtons();
        // Add an event listener to capture changes in the input value
        searchValue2.addEventListener("input", function() {
            // Get the value entered by the user
            var inputValue = searchValue2.value.trim().toLowerCase();
            var inputValue2 = searchValue.value.trim().toLowerCase();
            // Get all the rows in the table body
            var tableRows = document.querySelectorAll(".table tbody tr");

            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                var cellContent = row.cells[2].textContent.toLowerCase();
                var cellcontent2 = row.cells[3].textContent.toLowerCase();
                // Check if the cell content includes the search value
                if (cellContent.includes(inputValue) && cellcontent2.includes(inputValue2)) {
                    // Show the row if it matches the search value
                    row.style.display = "";
                } else {
                    // Hide the row if it doesn't match the search value
                    row.style.display = "none";
                }
            });
        });

        // Add an event listener to capture changes in the input value
        searchValue.addEventListener("input", function() {
            // Get the value entered by the user
            var inputValue = searchValue.value.trim().toLowerCase();
            var inputValue2 = searchValue2.value.trim().toLowerCase();
            // Get selected criteria
            var tableRows = document.querySelectorAll(".table tbody tr");

            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                // Get the cell content based on the selected criteria
                var cellContent = row.cells[3].textContent.toLowerCase();
                var cellcontent2 = row.cells[2].textContent.toLowerCase();

                // Check if the cell content includes the search value
                if (cellContent.includes(inputValue) && cellcontent2.includes(inputValue2)) {
                    // Show the row if it matches the search value
                    row.style.display = "";
                } else {
                    // Hide the row if it doesn't match the search value
                    row.style.display = "none";
                }
            });
        });

    });
</script>

</html>