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
                <a href="Pappointments.php" class="nav-list-item">
                    <i class="fas fa-user sideBarIcon"></i>
                    <span class="nav-item">My Appointments</span>
                </a>
            </li>
            <li>
                <a href="PNewAppointment.php" class="nav-list-item">
                    <i class="fas fa-wallet sideBarIcon"></i>
                    <span class="nav-item">New Appointment</span>
                </a>
            </li>
            <li>
                <a href="MedicalRecords.php" class="nav-list-item">
                    <i class="fas fa-chart-bar sideBarIcon"></i>
                    <span class="nav-item">Medical Records</span>
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
        <a href="PNewAppointment.php"><button class="btn btn-primary">Make Appointment</button></a>
    </div>
    <div class="bottom">
        <select id="searchCriteria" class="form-select">
            <option value="date">Date</option>
            <option value="doctorName">Doctor Name</option>
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
                    <th>Doctor Name</th>
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
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #D9D9D9; width: 600px;">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editModalLabel">Appointment Details</h5>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="appointmentID" id="idlabel">Appointment ID:</label>
                            <input type="text" class="form-control" id="appointmentID" readonly>
                        </div>
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="text" class="form-control" id="date" readonly>
                        </div>
                        <div class="form-group">
                            <label for="time">Time:</label>
                            <input type="text" class="form-control" id="time" readonly>
                        </div>
                        <div class="form-group">
                            <label for="doctorName">Doctor Name:</label>
                            <input type="text" class="form-control" id="doctorName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Amount">Payment Amount:</label>
                            <input type="text" class="form-control" id="Amount" readonly>
                        </div>
                        <div class="form-group">
                            <label for="PMethod">Payment Method:</label>
                            <input type="text" class="form-control" id="PMethod" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Qno">Queue No:</label>
                            <input type="text" class="form-control" id="Qno" readonly>
                        </div>
                    </form>
                </div>
                <div class="footer">
                    <button type="button" class="btn btn-primary" id="cancelAppointment">Cancel Appointment</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
<?php include("../config/includes.php"); ?>
<script>
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

        // Get the cacel button inside the modal
        var cancelButton = document.getElementById("cancelAppointment");

        // Get the close button inside the modal
        var closeButton = document.getElementById("close");

        // Add click event listener to the close button
        closeButton.addEventListener("click", function() {
            // Hide the modal
            $('#editModal').modal('hide');
        });
        cancelButton.addEventListener("click", function() {
            // Show a SweetAlert confirmation dialog
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
                    // Get the modal body
                    var modalBody = document.querySelector(".modal-body");
                    // Get the appointment ID from the modal body
                    var appointmentID = modalBody.querySelector("#appointmentID").value;
                    // Get the table body
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

                            // Hide the modal
                            $('#editModal').modal('hide');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred while deleting appointment:', error);
                        }
                    });
                    // Hide the modal
                    $('#editModal').modal('hide');
                }
            });

        });

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
                searchDateInput.placeholder = "e.g. Dr.";
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
        $.ajax({
            type: "GET",
            url: "fetch_appointments.php", // Update the URL to your backend script
            success: function(appointmentsJSON) {
                // Parse the JSON response
                var appointments = appointmentsJSON;

                // Reference to the table body
                var tableBody = $("#appointmentTableBody");

                // Clear existing table rows
                tableBody.empty();

                // Iterate over the appointments and append rows to the table
                appointments.forEach(function(appointment) {
                    // Construct table row HTML
                    var rowHtml = "<tr>" +
                        "<td>" + appointment.appointmentID + "</td>" +
                        "<td>" + appointment.date + "</td>" +
                        "<td>" + appointment.time + "</td>" +
                        "<td>" + appointment.queueNo + "</td>" +
                        "<td>" + appointment.doctorName + "</td>" +
                        "<td>" + appointment.status + "</td>" +
                        "<td><button class='btn btn-outline-info btn-view' style='width:100px; margin-top: 0px;'>View</button></td>" +
                        "</tr>";

                    // Append the row to the table body
                    tableBody.append(rowHtml);
                });
                var viewButtons = document.querySelectorAll(".btn-view");
                // Iterate over each view button and attach a click event listener
                viewButtons.forEach(function(button) {
                    button.addEventListener("click", function() {
                        // Find the parent row of the button that was clicked
                        var row = this.closest("tr");
                        var appointmentID = row.cells[0].textContent;
                        currentAppointment = findAppointmentById(appointments, appointmentID);

                        var date = currentAppointment.date;
                        var time = currentAppointment.time;
                        var queueNo = currentAppointment.queueNo;
                        var doctorName = currentAppointment.doctorName;
                        var status = currentAppointment.status;
                        var charge = currentAppointment.charge;
                        var paymentName = currentAppointment.paymentMethod;

                        // Populate the modal inputs with the values from the row
                        document.getElementById("appointmentID").value = appointmentID;
                        document.getElementById("date").value = date;
                        document.getElementById("time").value = time;
                        document.getElementById("Qno").value = queueNo;
                        document.getElementById("doctorName").value = doctorName;
                        document.getElementById("Amount").value = charge;
                        document.getElementById("PMethod").value = paymentName;
                        var cancelButton = document.getElementById('cancelAppointment');
                        if (status === "Completed") {
                            // Disable the Cancel Appointment button
                            cancelButton.disabled = true;
                        } else {
                            // Enable the Cancel Appointment button
                            cancelButton.disabled = false;
                        }

                        // Open the modal
                        $('#editModal').modal('show');
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error("Error fetching appointments:", error);
            }
        });
    }
</script>

</html>