<?php
require("../config/dbconnection.php");

session_start();
$myempid = $_SESSION['employeeid'];
$query = "SELECT checkinoutid,date,checkintime,checkouttime,
            (select concat(firstname,' ',lastname) from employee
            where employeeid=ch.employeeid)as name
            FROM pdms.empcheckinout ch;";
$result = $con->query($query);
while ($row = $result->fetch_assoc()) {
    $checkinouts[] = $row;
}

$query2 = "select employeeid,concat(firstname,' ',lastname) as name from employee ";
$result2 = $con->query($query2);
while ($row2 = $result2->fetch_assoc()) {
    $employees[] = $row2;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckInOut</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="checkInOut.css">
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
        <p>Check In Out</p>
        <button class="btn btn-primary" id="addcheckin">Add checkin</button>
    </div>
    <div class="bottom">
        <input name="" id="searchDate" class="form-control" type="text" placeholder="eg :2024/05/02"></input>
        <input name="" id="searcheName" class="form-control" type="text" placeholder="eg :Employee Name"></input>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="samll">CHKID</th>
                    <th class="medium">Date</th>
                    <th class="large">Employee Name</th>
                    <th class="medium">Check In Time</th>
                    <th class="medium">Check Out Time</th>
                    <th class="medium">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #D9D9D9; width: 600px;">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editModalLabel">Check In Out Time</h5>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label>CHK ID:</label>
                            <input type="text" class="form-control" id="chkid" readonly>
                        </div>
                        <div class="form-group">
                            <label>Employee Name:</label>
                            <input type="text" class="form-control" id="empname" readonly>
                        </div>
                        <div class="form-group">
                            <label>Date:</label>
                            <input type="text" class="form-control" id="date" readonly></input>
                        </div>
                        <div class="form-group">
                            <label>Check In Time:</label>
                            <input type="text" class="form-control" id="chkintime" readonly></input>
                        </div>
                        <div class="form-group">
                            <label>Check Out Time:</label>
                            <input type="text" class="form-control" id="chkouttime" readonly></input>
                        </div>

                    </form>
                </div>
                <div class="footer">
                    <button type="button" class="btn btn-primary" id="complete">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
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

        // var checkindata = [{
        //         chkid: "CHK001",
        //         empName: "Pubudu",
        //         date: "2024/05/08",
        //         checkin: "08:30AM",
        //         checkout: "04:30PM"
        //     },
        //     {
        //         chkid: "CHK002",
        //         empName: "Pamod",
        //         date: "2024/05/08",
        //         checkin: "08:00AM",
        //         checkout: "05:30PM"
        //     },
        //     {
        //         chkid: "CHK003",
        //         empName: "Nisal",
        //         date: "2024/05/08",
        //         checkin: "09:30AM",
        //         checkout: "04:00PM"
        //     },
        //     {
        //         chkid: "CHK004",
        //         empName: "Pubudu",
        //         date: "2024/05/09",
        //         checkin: "08:00AM",
        //         checkout: ""
        //     },
        //     {
        //         chkid: "CHK005",
        //         empName: "Pamod",
        //         date: "2024/05/09",
        //         checkin: "08:30AM",
        //         checkout: ""
        //     },

        // ]

        var checkindata = <?php echo json_encode($checkinouts) ?>;

        var employees = <?php echo json_encode($employees) ?>;
        console.log(employees);

        var tbody = document.querySelector(".table tbody");

        // Loop through the data and create table rows
        checkindata.forEach(function(item) {
            var row = document.createElement("tr");

            row.innerHTML = `
            <td class="small">${item.checkinoutid}</td>
            <td class="medium">${item.date}</td>
            <td class="large">${item.name}</td>
            <td class="medium">${item.checkintime}</td>
            <td class="medium">${item.checkouttime==null?"":item.checkouttime}</td>
            <td class="medium">
                ${item.checkouttime!= null ?
                    `<button class="btn btn-outline-secondary btn-update" disabled>Update</button>` :
                    `<button class="btn btn-outline-info btn-update">Update</button>`}
            </td>
        `;

            tbody.appendChild(row);
        });


        // Get all the approve buttons
        var newcheckin = false;
        var updateButtons = document.querySelectorAll(".btn-update.btn-outline-info");
        var chkid = document.getElementById("chkid");
        var empname = document.getElementById("empname");
        var chkintime = document.getElementById("chkintime");
        var chkouttime = document.getElementById("chkouttime");
        var date = document.getElementById("date");
        var completeButton = document.getElementById("complete");
        var addcheckinbtn = document.getElementById("addcheckin");
        var empname = document.getElementById("empname");
        var row;

        addcheckinbtn.addEventListener("click", function() {
            newcheckin = true;
            empname.removeAttribute("readonly");
            $.ajax({
                type: "POST",
                url: "get_next_checkin_id.php",
                success: function(response) {
                    chkid.value = response;
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching next check-in ID:', error);
                }
            });
            empname.value = "";
            date.value = formatDate(new Date());
            chkintime.value = formatAMPM(new Date());
            chkouttime.value = "";
            completeButton.textContent = "Add record";
            $('#editModal').modal('show');
        });

        updateButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Find the parent row of the button that was clicked
                row = this.closest("tr");
                empname.setAttribute("readonly", "readonly")
                chkid.value = row.cells[0].textContent;
                empname.value = row.cells[2].textContent;
                date.value = row.cells[1].textContent;
                chkintime.value = row.cells[3].textContent;
                chkouttime.value = formatAMPM(new Date());
                completeButton.textContent = "Update Record";

                // Hide the modal
                $('#editModal').modal('show');

            });
        });

        completeButton.addEventListener("click", function() {
            if (newcheckin) {

                var empData = employees.find(function(employee) {
                    return employee.name === empname.value;
                });
                var postData = {
                    chkid: chkid.value,
                    date: date.value,
                    empid: empData.employeeid,
                    chkintime: chkintime.value
                };

                // Send AJAX request to insert the new check-in record
                $.ajax({
                    type: "POST",
                    url: "add_checkin_record.php", // Your PHP file for inserting the record
                    data: postData,
                    success: function(response) {

                        console.log("Check-in record added successfully!");
                        addRow();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error adding check-in record:', error);
                    }
                });
            } else {
                // changeTime(row, formatAMPM(new Date()));
                // Prepare data for updating checkout time
                var postData = {
                    chkid: chkid.value,
                    chkouttime: formatAMPM(new Date())
                };

                // Send AJAX request to update the checkout time
                $.ajax({
                    type: "POST",
                    url: "update_checkout_time.php", // Your PHP file for updating the checkout time
                    data: postData,
                    success: function(response) {
                        console.log("Checkout time updated successfully!");
                        changeTime(row, formatAMPM(new Date()));
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating checkout time:', error);
                    }
                });
            }

            newcheckin = false;
            $('#editModal').modal('hide');
        });

        function addRow() {
            var tbody = document.querySelector(".table tbody");

            // Create a new row
            var newRow = document.createElement("tr");

            // Set the inner HTML of the new row
            newRow.innerHTML = `
                <td class="small">${chkid.value}</td>
                <td class="medium">${date.value}</td>
                <td class="large">${empname.value}</td>
                <td class="medium">${chkintime.value}</td>
                <td class="medium">${chkouttime.value}</td>
                <td class="medium">
                    <button class="btn btn-outline-info btn-update">Update</button>
                </td>
            `;

            // Append the new row to the table body
            tbody.appendChild(newRow);

            // Add event listener to the new update button
            var newUpdateButton = newRow.querySelector(".btn-update");
            newUpdateButton.addEventListener("click", function() {
                // Find the parent row of the button that was clicked
                row = this.closest("tr");
                empname.setAttribute("readonly", "readonly")

                chkid.value = row.cells[0].textContent;
                empname.value = row.cells[2].textContent;
                date.value = row.cells[1].textContent;
                chkintime.value = row.cells[3].textContent;
                chkouttime.value = formatAMPM(new Date());
                completeButton.textContent = "Update Record";

                // Hide the modal
                $('#editModal').modal('show');
            });
        }

        function changeTime(row, time) {
            // change the status value            
            row.cells[4].textContent = time;
            // Disable both approve and reject buttons
            row.querySelector(".btn-update").disabled = true;

            row.querySelector(".btn-update").classList.replace("btn-outline-info", "btn-outline-secondary");
        }

        // Get the input field for the date search

        var searchDate = document.getElementById("searchDate");
        var searchEmpName = document.getElementById("searcheName");
        // Add an event listener to capture changes in the input value
        searchDate.addEventListener("input", function() {
            // Get the value entered by the user
            var inputDate = searchDate.value.trim().toLowerCase();
            var inputEmployee = searchEmpName.value.trim().toLowerCase();
            // Get selected criteria
            var tableRows = document.querySelectorAll(".table tbody tr");
            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                // Get the cell content based on the selected criteria
                var cellContentDate = row.cells[1].textContent.toLowerCase();
                var cellContentEmployee = row.cells[2].textContent.toLowerCase();

                // Check if the cell content includes the search value
                if (cellContentDate.includes(inputDate) && cellContentEmployee.includes(inputEmployee)) {
                    // Show the row if it matches the search value
                    row.style.display = "";
                } else {
                    // Hide the row if it doesn't match the search value
                    row.style.display = "none";
                }
            });
        });

        searchEmpName.addEventListener("input", function() {
            // Get the value entered by the user
            var inputDate = searchDate.value.trim().toLowerCase();
            var inputEmployee = searchEmpName.value.trim().toLowerCase();
            // Get selected criteria
            var tableRows = document.querySelectorAll(".table tbody tr");
            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                // Get the cell content based on the selected criteria
                var cellContentDate = row.cells[1].textContent.toLowerCase();
                var cellContentEmployee = row.cells[2].textContent.toLowerCase();

                // Check if the cell content includes the search value
                if (cellContentDate.includes(inputDate) && cellContentEmployee.includes(inputEmployee)) {
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
            newcheckin = false;
            $('#editModal').modal('hide');
        });

        function formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // Handle midnight
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ampm;
            return strTime;
        }

        function formatDate(date) {
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Adding 1 to month since it is zero-based index
            var day = ('0' + date.getDate()).slice(-2);

            return year + '/' + month + '/' + day;
        }
        $('#empname').typeahead({
            source: function(query, process) {
                var names = employees.map(function(employee) {
                    return employee.name;
                });
                process(names);
            },
            autoSelect: true,
            afterSelect: function(item) {}
        });
    });
</script>

</html>