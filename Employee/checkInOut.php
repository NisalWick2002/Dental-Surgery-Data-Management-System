<?php
require("../config/dbconnection.php");

session_start();
$empid = $_SESSION['employeeid'];
$query = "SELECT * FROM pdms.empcheckinout
          where employeeid='$empid'";
$result = $con->query($query);
while ($row = $result->fetch_assoc()) {
    $mycheckinouts[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Check In Out</title>
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
        <p class="">Check In Out</p>
    </div>
    <div class="bottom">
        <input name="" id="searchValue" class="form-control" type="text" placeholder="eg :2024/05/02"></input>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="large">CHK ID</th>
                    <th class="large">Date</th>
                    <th class="large">Check In Time</th>
                    <th class="large">Check Out Time</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </table>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    var checkinouts = <?php echo json_encode($mycheckinouts); ?>;
    // var checkinouts = [{
    //         chkid: "CHK005",
    //         date: "2023/05/05",
    //         checkintime: "08:30 AM",
    //         checkouttime: "04:00 PM"
    //     },
    //     {
    //         chkid: "CHK004",
    //         date: "2023/05/04",
    //         checkintime: "08:30 AM",
    //         checkouttime: "05:00 PM"
    //     },
    //     {
    //         chkid: "CHK003",
    //         date: "2023/05/03",
    //         checkintime: "09:30 AM",
    //         checkouttime: "05:30 PM"
    //     },
    //     {
    //         chkid: "CHK002",
    //         date: "2023/05/02",
    //         checkintime: "08:30 AM",
    //         checkouttime: "08:30 PM"
    //     },
    //     {
    //         chkid: "CHK001",
    //         date: "2023/05/01",
    //         checkintime: "08:00 AM",
    //         checkouttime: "04:00 PM"
    //     },

    // ];


    document.addEventListener("DOMContentLoaded", function() {
        var searchValue = document.getElementById("searchValue");
        var tbody = document.querySelector(".table tbody");

        function fillTable(data) {
            tbody.innerHTML = "";
            // Loop through the data and create table rows
            data.forEach(function(item) {
                var row = document.createElement("tr");

                row.innerHTML = `
                    <td class="large">${item.checkinoutid}</td>
                    <td class="large">${item.date}</td>
                    <td class="large">${item.checkintime}</td>
                    <td class="large">${item.checkouttime}</td>
                `;
                tbody.appendChild(row);
            });
        }
        fillTable(checkinouts);


        // Add an event listener to capture changes in the input value
        searchValue.addEventListener("input", function() {
            // Get the value entered by the user
            var inputValue = searchValue.value.trim().toLowerCase();
            // Get selected criteria
            var tableRows = document.querySelectorAll(".table tbody tr");

            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                // Get the cell content based on the selected criteria
                var cellContent = row.cells[1].textContent.toLowerCase();

                // Check if the cell content includes the search value
                if (cellContent.includes(inputValue)) {
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