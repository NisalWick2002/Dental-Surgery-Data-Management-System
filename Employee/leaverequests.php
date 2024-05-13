<?php
require("../config/dbconnection.php");

session_start();
$empid = $_SESSION['employeeid'];
$query = "SELECT *,
        (select name from leavetype 
        where leavetypeid=el.leavetypeid) as leavename
        FROM pdms.employeeleave el
        where employeeid='$empid'";
$result = $con->query($query);
while ($row = $result->fetch_assoc()) {
    $myleaverequests[] = $row;
}

$query2 = "SELECT leavetypeid,name FROM pdms.leavetype;";
$result2 = $con->query($query2);
while ($row2 = $result2->fetch_assoc()) {
    $leavetypes[] = $row2;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Leave Requests</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="leaverequests.css">
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
                <a href="checkInOut.php" class="nav-list-item">
                    <i class="fas fa-user sideBarIcon"></i>
                    <span class="nav-item">My CheckInOut</span>
                </a>
            </li>
            <li>
                <a href="leaverequests.php" class="nav-list-item">
                    <i class="fas fa-wallet sideBarIcon"></i>
                    <span class="nav-item">leave request</span>
                </a>
            </li>
            <li>
                <a href="../counterstaff/appointments.php" class="nav-list-item">
                    <i class="fas fa-chart-bar sideBarIcon"></i>
                    <span class="nav-item">Appointments</span>
                </a>
            </li>
            <li>
                <a href="../counterstaff/checkinout.php" class="nav-list-item">
                    <i class="fas fa-tasks sideBarIcon"></i>
                    <span class="nav-item">Emp Checkinout</span>
                </a>
            </li>
            <li>
                <a href="../counterstaff/doctorSchedule.php" class="nav-list-item">
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
        <p class="">My Leave Requests</p>
        <button class="btn btn-primary addexpense" id="addexpense">New Request</button>
    </div>
    <div class="bottom">
        <input name="" id="searchValue" class="form-control" type="text" placeholder="eg :2024/05/02"></input>
        <input name="" id="searchValue2" class="form-control" type="text" placeholder="eg : Pending"></input>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="small">Request ID</th>
                    <th class="large">Requested Date</th>
                    <th class="large">Date</th>
                    <th class="large">Leave Type</th>
                    <th class="xlarge">Reason</th>
                    <th class="large">Status</th>
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
                    <h5 class="modal-title text-center" id="editModalLabel">Leave Request</h5>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label id="idlabel">Request ID:</label>
                            <input type="text" class="form-control" id="expenseID" readonly>
                        </div>
                        <div class="form-group">
                            <label>Date:</label>
                            <input type="date" class="form-control" id="date" placeholder="Select Date">
                        </div>
                        <div class="form-group">
                            <label>Request Type</label>
                            <select name="" id="RequestType" class="form-control">
                                <!-- <option value="Half Day: mor">Half Day: mor</option>
                                <option value="Half Day: eve">Half Day: eve</option>
                                <option value="Priviladge Leave">Priviladge Leave</option>
                                <option value="Full Day">Full Day</option> -->
                                <?php
                                foreach ($leavetypes as $leavetype) {
                                    echo '<option value="' . $leavetype['leavetypeid'] .
                                        '">' . $leavetype['name'] . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Reason:</label>
                            <textarea type="text" rows="7" class="form-control" id="Description"></textarea>
                        </div>

                    </form>
                </div>
                <div class="footer">
                    <button type="button" class="btn btn-primary" id="makerequest">Submit Request</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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
    var leaverequests = <?php echo json_encode($myleaverequests); ?>;
    // console.log(temp);
    // var leaverequests = [{
    //         rid: "ER005",
    //         rdate: "2023/05/01",
    //         date: "2023/05/08",
    //         leavetype: "Half Day: mor",
    //         reason: "Personal Emergency",
    //         status: "Pending"
    //     },
    //     {
    //         rid: "ER004",
    //         rdate: "2023/04/30",
    //         date: "2023/05/05",
    //         leavetype: "Half Day: eve",
    //         reason: "Personal Emergency",
    //         status: "Approved"
    //     },
    //     {
    //         rid: "ER003",
    //         rdate: "2023/04/27",
    //         date: "2023/05/01",
    //         leavetype: "Full Day",
    //         reason: "Personal Emergency",
    //         status: "Rejected"
    //     },
    //     {
    //         rid: "ER002",
    //         rdate: "2023/03/18",
    //         date: "2023/04/01",
    //         leavetype: "Priviladge Leave",
    //         reason: "Personal Emergency",
    //         status: "Rejected"
    //     },
    //     {
    //         rid: "ER001",
    //         rdate: "2023/02/01",
    //         date: "2023/02/27",
    //         leavetype: "Full Day",
    //         reason: "Personal Emergency",
    //         status: "Rejected"
    //     },

    // ];
    document.addEventListener("DOMContentLoaded", function() {
        var searchValue = document.getElementById("searchValue");
        var searchValue2 = document.getElementById("searchValue2");

        var tbody = document.querySelector(".table tbody");

        function fillTable(data) {
            tbody.innerHTML = "";
            // Loop through the data and create table rows
            data.forEach(function(item) {
                var row = document.createElement("tr");

                row.innerHTML = `
                    <td class="small">${item.empleaveid}</td>
                    <td class="large">${item.requestdate}</td>
                    <td class="large">${item.date}</td>
                    <td class="large">${item.leavename}</td>
                    <td class="xlarge">${item.reason}</td>
                    <td class="large">${item.status}</td>
                `;
                tbody.appendChild(row);
            });
        }
        fillTable(leaverequests);


        // Add an event listener to capture changes in the input value
        searchValue2.addEventListener("input", function() {
            // Get the value entered by the user
            var inputValue = searchValue2.value.trim().toLowerCase();
            var inputValue2 = searchValue.value.trim().toLowerCase();
            // Get all the rows in the table body
            var tableRows = document.querySelectorAll(".table tbody tr");

            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                var cellContent = row.cells[5].textContent.toLowerCase();
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
                var cellContent = row.cells[2].textContent.toLowerCase();
                var cellcontent2 = row.cells[5].textContent.toLowerCase();

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

        var addexpense = document.getElementById("addexpense");

        // Add click event listener to the close button
        // addexpense.addEventListener("click", function() {
        //     // Get the current system date
        //     var currentDate = new Date();

        //     // Extract the individual components
        //     var year = currentDate.getFullYear();
        //     var month = ("0" + (currentDate.getMonth() + 1)).slice(-2); // Adding 1 because months are zero-based
        //     var day = ("0" + currentDate.getDate()).slice(-2);

        //     // Format the date as YYYY/MM/DD
        //     var formattedDate = year + "/" + month + "/" + day;
        //     var eid = document.getElementById("expenseID");

        //     eid.value = "ER007";
        //     var date = document.getElementById("date");
        //     date.value = formattedDate;
        //     // Hide the modal
        //     $('#editModal').modal('show');
        // });

        // Add click event listener to the close button
        addexpense.addEventListener("click", function() {
            // Get the current system date
            var currentDate = new Date();

            // Extract the individual components
            var year = currentDate.getFullYear();
            var month = ("0" + (currentDate.getMonth() + 1)).slice(-2); // Adding 1 because months are zero-based
            var day = ("0" + currentDate.getDate()).slice(-2);

            // Format the date as YYYY/MM/DD
            var formattedDate = year + "/" + month + "/" + day;

            // AJAX request to fetch the next leave ID
            $.ajax({
                url: 'get_next_leave_id.php', // Update with the path to your PHP script
                type: 'POST',
                success: function(data) {
                    // Update the value of the eid field with the received leave ID
                    document.getElementById("expenseID").value = data;
                    // Set the date field to the current date
                    document.getElementById("date").value = formattedDate;
                    // Show the modal
                    $('#editModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching next leave ID:', error);
                }
            });
        });
        var makerequestbtn = document.getElementById("makerequest");
        makerequestbtn.addEventListener("click", function() {
            // Get the values of the form fields
            var empleaveid = document.getElementById("expenseID").value;
            var leavetypeid = document.getElementById("RequestType").value;
            var date = document.getElementById("date").value;
            var reason = document.getElementById("Description").value;
            // Send AJAX request to PHP script to handle leave request submission
            $.ajax({
                url: 'submit_leave_request.php', // Path to your PHP script
                type: 'POST',
                data: {
                    empleaveid: empleaveid,
                    leavetypeid: leavetypeid,
                    date: date,
                    reason: reason
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Leave Request Submitted',
                        text: 'Your leave request has been successfully submitted!',
                    }).then((result) => {
                        $('#editModal').modal('hide');
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

        var closeButton = document.getElementById("close");

        // Add click event listener to the close button
        closeButton.addEventListener("click", function() {
            // Hide the modal
            $('#editModal').modal('hide');
        });


    });

    $(document).ready(function() {
        // Get tomorrow's date
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        var dd = String(tomorrow.getDate()).padStart(2, '0');
        var mm = String(tomorrow.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = tomorrow.getFullYear();
        tomorrow = yyyy + '-' + mm + '-' + dd;

        // Set the minimum date for the input to tomorrow
        $('#date').attr('min', tomorrow);
    });
</script>

</html>