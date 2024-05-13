<?php
require("../config/dbconnection.php");
session_start();
$docid = $_SESSION['doctorid'];
$getAppQuery = "select *,(select concat(firstname,' ',lastname) 
                from patient where patientid = ap.patientid) as patientname
                from appointment ap where doctorid='$docid'";

$allRecords = $con->query($getAppQuery);
while ($record = $allRecords->fetch_assoc()) {
    $appointments[] = $record;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="PAppointment.css">
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
                    <span class="nav-item">Add New Record</span>
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
        <p>My Appointments</p>
    </div>
    <div class="bottom">
        <select id="searchCriteria" class="form-select">
            <option value="date">Date</option>
            <option value="doctorName">Patient Name</option>
            <option value="status">Status</option>
        </select>
        <div class="search">
            <input type="text" class="form-control" id="searchDate" placeholder="eg :YYYY/MM/DD">
        </div>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th>AppointmentID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Queue No</th>
                    <th>Patient Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center" style="overflow-y:auto; height:400px; position:absolute " id="appointmentTableBody">
                <!-- <tr>
                    <td>APP006</td>
                    <td>2023/06/11</td>
                    <td>1:30PM</td>
                    <td>11</td>
                    <td>Dr. Vishan</td>
                    <td>In Progress</td>
                    <td><button class="btn btn-outline-info btn-view" style="width:100px; margin-top: 0px;">View
                    </td>
                </tr>
                <tr>
                    <td>APP005</td>
                    <td>2023/06/04</td>
                    <td>8:30AM</td>
                    <td>04</td>
                    <td>Dr. Pamod</td>
                    <td>In Progress</td>
                    <td><button class="btn btn-outline-info btn-view" style="width:100px; margin-top: 0px;">View
                    </td>
                </tr>
                <tr>
                    <td>APP004</td>
                    <td>2023/05/21</td>
                    <td>11:30AM</td>
                    <td>01</td>
                    <td>Dr. Nuwan</td>
                    <td>Completed</td>
                    <td><button class="btn btn-outline-info btn-view" style="width:100px; margin-top: 0px;">View
                    </td>
                </tr>
                <tr>
                    <td>APP003</td>
                    <td>2023/05/29</td>
                    <td>5:30AM</td>
                    <td>08</td>
                    <td>Dr. Silva</td>
                    <td>Completed</td>
                    <td><button class="btn btn-outline-info btn-view" style="width:100px; margin-top: 0px;">View
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>

</body>
<?php include("../config/includes.php"); ?>
<script>
    //function to logout
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


    document.addEventListener("DOMContentLoaded", function() {
        fillTable();

        // Get the input field for the date search
        var searchInput = document.getElementById("searchDate");

        // Add an event listener to capture changes in the input value
        searchInput.addEventListener("input", function() {
            const searchCriteria = document.getElementById("searchCriteria");
            // Get the value entered by the user
            var searchValue = searchInput.value.trim().toLowerCase();
            // Get selected criteria
            const selectedCriteria = searchCriteria.value.toLowerCase();
            // Get all the rows in the table body
            var tableRows = document.querySelectorAll(".table tbody tr");

            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                // Get the cell content based on the selected criteria
                var cellContent;
                if (selectedCriteria === "date") {
                    cellContent = row.cells[1].textContent.toLowerCase();
                } else if (selectedCriteria === "doctorname") {
                    cellContent = row.cells[4].textContent.toLowerCase();
                } else if (selectedCriteria === "status") {
                    cellContent = row.cells[5].textContent.toLowerCase();
                }

                // Check if the cell content includes the search value
                if (cellContent.includes(searchValue)) {
                    // Show the row if it matches the search value
                    row.style.display = "";
                } else {
                    // Hide the row if it doesn't match the search value
                    row.style.display = "none";
                }
            });
        });

        var searchCriteria = document.getElementById("searchCriteria");

        searchCriteria.addEventListener("change", function() {
            var selectedValue = searchCriteria.value;
            var searchDateInput = document.getElementById("searchDate");

            if (selectedValue === "doctorName") {
                searchDateInput.placeholder = "e.g. PatientName";
            } else if (selectedValue === "date") {
                searchDateInput.placeholder = "e.g. YYYY/MM/DD";
            } else if (selectedValue === "status") {
                searchDateInput.placeholder = "e.g. Complete/In Progress";
            }
        });

    });

    // Function to find appointment by ID
    function findAppointmentById(appointments, appointmentId) {
        for (var i = 0; i < appointments.length; i++) {
            if (appointments[i].appointmentID === appointmentId) {
                return appointments[i]; // Return the appointment if found
            }
        }
        return null; // Return null if appointment not found
    }

    function fillTable() {
        var appointments = <?php echo json_encode($appointments); ?>;
        var tableBody = $("#appointmentTableBody");
        tableBody.empty();

        appointments.forEach(function(appointment) {

            var rowHtml = "<tr>" +
                "<td>" + appointment.appointmentid + "</td>" +
                "<td>" + appointment.appointmentdate + "</td>" +
                "<td>" + appointment.appointmentslot + "</td>" +
                "<td>" + appointment.queueno + "</td>" +
                "<td>" + appointment.patientname + "</td>" +
                "<td>" + appointment.status + "</td>" +
                "<td><button class='btn btn-outline-info btn-cancel' style='width:100px; margin-top: 0px;'>Cancel</button></td>" +
                "</tr>";

            tableBody.append(rowHtml);
        });
        var viewButtons = document.querySelectorAll(".btn-cancel");
        viewButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Find the parent row of the button that was clicked
                var row = this.closest("tr");
                var appointmentID = row.cells[0].textContent;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This appointment will be canceled!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var tableBody = document.querySelector(".table tbody");
                        $.ajax({
                            type: "POST",
                            url: "delete_appointment.php", // Adjust the URL to your server-side script
                            data: {
                                appointmentID: appointmentID
                            },
                            success: function(success) {
                                // Remove the corresponding row from the table
                                var rows = tableBody.querySelectorAll("tr");
                                rows.forEach(function(row) {
                                    if (row.cells[0].textContent === appointmentID) {
                                        row.remove();
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error occurred while deleting appointment:', error);
                            }
                        });
                    }
                });
            });
        });
    }
</script>

</html>