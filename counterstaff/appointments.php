<?php
require("../config/dbconnection.php");

session_start();
$empid = $_SESSION['employeeid'];
$query = "SELECT appointmentid,appointmentdate,appointmentslot,paymentmethodid,
        (select concat(firstname,' ',lastname) from patient where patientid=ap.patientid) as patientname,
        (select concat(firstname,' ',lastname) from doctor where doctorid=ap.doctorid) as doctorname,
        (select name from paymentmethod where paymentmethodid=ap.paymentmethodid) as pmethodname,
        createddate,status
        FROM pdms.appointment ap;";
$result = $con->query($query);
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="appointments.css">
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
                <a href="../Employee/dashboard.php" class="nav-list-item">
                    <i class="fas fa-home sideBarIcon"></i>
                    <span class="nav-item">Home</span>
                </a>
            </li>
            <li>
                <a href="../Employee/checkInOut.php" class="nav-list-item">
                    <i class="fas fa-user sideBarIcon"></i>
                    <span class="nav-item">My CheckInOut</span>
                </a>
            </li>
            <li>
                <a href="../Employee/leaverequests.php" class="nav-list-item">
                    <i class="fas fa-wallet sideBarIcon"></i>
                    <span class="nav-item">leave request</span>
                </a>
            </li>
            <li>
                <a href="appointments.php" class="nav-list-item">
                    <i class="fas fa-chart-bar sideBarIcon"></i>
                    <span class="nav-item">Appointments</span>
                </a>
            </li>
            <li>
                <a href="checkinout.php" class="nav-list-item">
                    <i class="fas fa-tasks sideBarIcon"></i>
                    <span class="nav-item">Emp Checkinout</span>
                </a>
            </li>
            <li>
                <a href="doctorSchedule.php" class="nav-list-item">
                    <i class="fas fa-cog sideBarIcon"></i>
                    <span class="nav-item">Doctor Schedules</span>
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
        <p>Appointments</p>
    </div>
    <div class="bottom">
        <input name="" id="searchDate" class="form-control" type="text" placeholder="eg :2024/05/02"></input>
        <input name="" id="searchPatient" class="form-control" type="text" placeholder="eg :Patient Name"></input>
        <input name="" id="searchDoctor" class="form-control" type="text" placeholder="eg :Doctor Name"></input>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="small">AppointmentID</th>
                    <th class="medium">Date</th>
                    <th class="medium">Time</th>
                    <th class="medium">Patient Name</th>
                    <th class="medium">Doctor Name</th>
                    <th class="medium">Created Date</th>
                    <th class="medium">Status</th>
                    <th class="medium">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <!-- <tr>
                    <td class="small">E005</td>
                    <td class="medium">Pubudu Perera</td>
                    <td class="medium">2023/05/24</td>
                    <td class="medium">Half Day:mor</td>
                    <td class="large">Personal Emergency</td>
                    <td class="medium">Pending</td>
                    <td class="large"><button class="btn btn-outline-info btn-approve">Approve</button>
                        <button class="btn btn-outline-danger btn-reject">Reject</button>
                    </td>
                </tr>
                <tr>
                    <td class="small">E004</td>
                    <td class="medium">Nimal Perera</td>
                    <td class="medium">2023/05/22</td>
                    <td class="medium">Half Day:eve</td>
                    <td class="large">Personal Emergency</td>
                    <td class="medium">Pending</td>
                    <td class="large"><button class="btn btn-outline-info btn-approve">Approve</button>
                        <button class="btn btn-outline-danger btn-reject">Reject</button>
                    </td>
                </tr>
                <tr>
                    <td class="small">E003</td>
                    <td class="medium">Saman Perera</td>
                    <td class="medium">2023/05/16</td>
                    <td class="medium">Full Day</td>
                    <td class="large">Personal Emergency</td>
                    <td class="medium">Approved</td>
                    <td class="large"><button class="btn btn-outline-info btn-approve">Approve</button>
                        <button class="btn btn-outline-danger btn-reject">Reject</button>
                    </td>
                </tr>
                <tr>
                    <td class="small">E002</td>
                    <td class="medium">Chamod Perera</td>
                    <td class="medium">2023/05/12</td>
                    <td class="medium">Priviladge Leave</td>
                    <td class="large">Personal Emergecy</td>
                    <td class="medium">Approved</td>
                    <td class="large"><button class="btn btn-outline-info btn-approve">Approve</button>
                        <button class="btn btn-outline-danger btn-reject">Reject</button>
                    </td>
                </tr>
                <tr>
                    <td class="small">E002</td>
                    <td class="medium">Chamod Perera</td>
                    <td class="medium">2023/05/12</td>
                    <td class="medium">Priviladge Leave</td>
                    <td class="large">Personal Emergecy</td>
                    <td class="medium">Approved</td>
                    <td class="large"><button class="btn btn-outline-info btn-approve">Approve</button>
                        <button class="btn btn-outline-danger btn-reject">Reject</button>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #D9D9D9; width: 600px;">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editModalLabel">Payment Details</h5>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label>Appointment ID:</label>
                            <input type="text" class="form-control" id="appID" readonly>
                        </div>
                        <div class="form-group">
                            <label>Patient Name:</label>
                            <input type="text" class="form-control" id="pName" readonly>
                        </div>
                        <div class="form-group">
                            <label>Total Amount:</label>
                            <input type="text" class="form-control" id="totalAmount" readonly></input>
                        </div>
                        <div class="form-group">
                            <label>Paid Amount:</label>
                            <input type="text" class="form-control" id="paidAmount">
                        </div>
                        <div class="form-group">
                            <label>Balance:</label>
                            <input type="text" class="form-control" id="balance" readonly>
                        </div>
                        <div class="form-group">
                            <label>Payment Method:</label>
                            <input type="text" class="form-control" id="pMethod" readonly>
                        </div>

                    </form>
                </div>
                <div class="footer">
                    <button type="button" class="btn btn-primary" id="complete">Complete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    var appdata = <?php echo json_encode($appointments) ?>;
    document.addEventListener("DOMContentLoaded", function() {

        // var appdata = [{
        //         appid: "APP005",
        //         date: "2024/05/08",
        //         time: "11:30AM",
        //         pname: "Pubudu",
        //         dname: "Dr. Silva",
        //         createddate: "2024/05/05",
        //         status: "Completed",
        //         pMethod: "Cash",
        //         pAmount: 2500
        //     },
        //     {
        //         appid: "APP006",
        //         date: "2024/05/08",
        //         time: "01:30PM",
        //         pname: "Vishan",
        //         dname: "Dr. John",
        //         createddate: "2024/05/05",
        //         status: "Completed",
        //         pMethod: "Visa",
        //         pAmount: 2000
        //     },
        //     {
        //         appid: "APP007",
        //         date: "2024/05/09",
        //         time: "08:30AM",
        //         pname: "Nisal",
        //         dname: "Dr. Kamal",
        //         createddate: "2024/05/06",
        //         status: "InProgress",
        //         pMethod: "Master",
        //         pAmount: 3500
        //     },
        //     {
        //         appid: "APP008",
        //         date: "2024/05/09",
        //         time: "11:30AM",
        //         pname: "Kavin",
        //         dname: "Dr. Viaml",
        //         createddate: "2024/05/06",
        //         status: "InProgress",
        //         pMethod: "Cash",
        //         pAmount: 3000
        //     },
        //     {
        //         appid: "APP009",
        //         date: "2024/05/10",
        //         time: "05:30PM",
        //         pname: "Pamod",
        //         dname: "Dr. Niaml",
        //         createddate: "2024/05/07",
        //         status: "InProgress",
        //         pMethod: "Amex",
        //         pAmount: 5000
        //     },
        // ];

        var tbody = document.querySelector(".table tbody");

        // Loop through the data and create table rows
        appdata.forEach(function(item) {
            var row = document.createElement("tr");

            row.innerHTML = `
            <td class="small">${item.appointmentid}</td>
            <td class="medium">${item.appointmentdate}</td>
            <td class="medium">${item.appointmentslot}</td>
            <td class="medium">${item.patientname}</td>
            <td class="medium">${item.doctorname}</td>
            <td class="medium">${item.createddate}</td>
            <td class="medium">${item.status}</td>
            <td class="medium">
                ${item.status.toLowerCase() !== "in progress" ?
                    `<button class="btn btn-outline-secondary btn-update" data-appid="${item.appointmentid}" disabled>Update</button>` :
                    `<button class="btn btn-outline-info btn-update" data-appid="${item.appointmentid}">Update</button>`}
            </td>
        `;

            tbody.appendChild(row);
        });


        // Get all the approve buttons
        var updateButtons = document.querySelectorAll(".btn-update.btn-outline-info");
        var appid = document.getElementById("appID");
        var tAmount = document.getElementById("totalAmount");
        var pMethod = document.getElementById("pMethod");
        var pName = document.getElementById("pName");
        var completeButton = document.getElementById("complete");
        var paidAmount = document.getElementById("paidAmount");
        var balance = document.getElementById("balance");
        var row;

        updateButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                var appointmentid = this.dataset.appid;
                row = this.closest("tr");
                var item = appdata.find(item => item.appointmentid == appointmentid);

                appid.value = appointmentid;
                pName.value = item.patientname;
                pMethod.value = item.pmethodname;
                tAmount.value = 3500;
                paidAmount.value = "";
                balance.value = "";
                $('#editModal').modal('show');

            });
        });

        completeButton.addEventListener("click", function() {
            $.ajax({
                url: 'completeappointment.php',
                type: 'POST',
                data: {
                    appid: appid.value,
                    totalamount: tAmount.value,
                    balance: balance.value,
                    paidamount: paidAmount.value
                },
                success: function(data) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Appointment changes made successfully',
                        text: 'Appointment details have been chnaged',
                    }).then((result) => {
                        $('#editModal').modal('hide');
                        changeStatus(row, "Completed");
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while submitting the leave request. Please try again later.',
                    });
                }
            });

        });




        paidAmount.addEventListener("input", function() {

            if (paidAmount.value.length > 0)
                balance.value = parseFloat(paidAmount.value) - parseFloat(tAmount.value);
            else
                balance.value = "";


        });

        function changeStatus(row, status) {
            // change the status value            
            row.cells[6].textContent = status;
            // Disable both approve and reject buttons
            row.querySelector(".btn-update").disabled = true;

            row.querySelector(".btn-update").classList.replace("btn-outline-info", "btn-outline-secondary");
        }

        // Get the input field for the date search

        var searchDate = document.getElementById("searchDate");
        var searchPatient = document.getElementById("searchPatient");
        var searchDoctor = document.getElementById("searchDoctor");
        // Add an event listener to capture changes in the input value
        searchDate.addEventListener("input", function() {
            // Get the value entered by the user
            var inputDate = searchDate.value.trim().toLowerCase();
            var inputPatient = searchPatient.value.trim().toLowerCase();
            var inputDoctor = searchDoctor.value.trim().toLowerCase();
            // Get selected criteria
            var tableRows = document.querySelectorAll(".table tbody tr");
            console.log(inputDate);
            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                // Get the cell content based on the selected criteria
                var cellContentDate = row.cells[1].textContent.toLowerCase();
                var cellContentDoctor = row.cells[4].textContent.toLowerCase();
                var cellContentPatient = row.cells[3].textContent.toLowerCase();

                // Check if the cell content includes the search value
                if (cellContentDate.includes(inputDate) && cellContentPatient.includes(inputPatient) && cellContentDoctor.includes(inputDoctor)) {
                    // Show the row if it matches the search value
                    row.style.display = "";
                } else {
                    // Hide the row if it doesn't match the search value
                    row.style.display = "none";
                }
            });
        });

        searchDoctor.addEventListener("input", function() {
            // Get the value entered by the user
            var inputDate = searchDate.value.trim().toLowerCase();
            var inputPatient = searchPatient.value.trim().toLowerCase();
            var inputDoctor = searchDoctor.value.trim().toLowerCase();
            // Get selected criteria
            var tableRows = document.querySelectorAll(".table tbody tr");
            console.log(inputDate);
            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                // Get the cell content based on the selected criteria
                var cellContentDate = row.cells[1].textContent.toLowerCase();
                var cellContentDoctor = row.cells[4].textContent.toLowerCase();
                var cellContentPatient = row.cells[3].textContent.toLowerCase();

                // Check if the cell content includes the search value
                if (cellContentDate.includes(inputDate) && cellContentPatient.includes(inputPatient) && cellContentDoctor.includes(inputDoctor)) {
                    // Show the row if it matches the search value
                    row.style.display = "";
                } else {
                    // Hide the row if it doesn't match the search value
                    row.style.display = "none";
                }
            });
        });

        searchPatient.addEventListener("input", function() {
            // Get the value entered by the user
            var inputDate = searchDate.value.trim().toLowerCase();
            var inputPatient = searchPatient.value.trim().toLowerCase();
            var inputDoctor = searchDoctor.value.trim().toLowerCase();
            // Get selected criteria
            var tableRows = document.querySelectorAll(".table tbody tr");
            console.log(inputDate);
            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                // Get the cell content based on the selected criteria
                var cellContentDate = row.cells[1].textContent.toLowerCase();
                var cellContentDoctor = row.cells[4].textContent.toLowerCase();
                var cellContentPatient = row.cells[3].textContent.toLowerCase();

                // Check if the cell content includes the search value
                if (cellContentDate.includes(inputDate) && cellContentPatient.includes(inputPatient) && cellContentDoctor.includes(inputDoctor)) {
                    // Show the row if it matches the search value
                    row.style.display = "";
                } else {
                    // Hide the row if it doesn't match the search value
                    row.style.display = "none";
                }
            });
        });

        var closeButton = document.getElementById("close");

        // Add click event listener to the close button
        closeButton.addEventListener("click", function() {
            // Hide the modal
            $('#editModal').modal('hide');
        });


    });
</script>

</html>