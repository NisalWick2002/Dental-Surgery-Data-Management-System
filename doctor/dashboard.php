<?php
require("../config/dbconnection.php");
session_start();
$username = $_SESSION['userid'];
$query = "SELECT * FROM doctor WHERE userid = '$username'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$_SESSION['doctorid'] = $row['doctorid'];
$_SESSION['firstname'] = $row['firstname'];
$_SESSION['lastname'] = $row['lastname'];
$_SESSION['email'] = $row['email'];
$_SESSION['address'] = $row['address'];
$_SESSION['contactno'] = $row['contactno'];
$_SESSION['category'] = $row['category'];

$docid = $row['doctorid'];

$query2 = "SELECT count(*) as appointmentcount
            FROM appointment 
            WHERE doctorid = '$docid' 
            AND appointmentdate >= CURRENT_DATE() 
            AND status = 'In Progress' ";
$result2 = $con->query($query2);
$row2 = $result2->fetch_assoc();

$query3 = "SELECT ap.*,p.firstname,p.lastname
FROM appointment ap join patient p on 
ap.patientid = p.patientid
WHERE ap.doctorid = '$docid' 
AND ap.appointmentdate >= CURRENT_DATE() 
AND ap.status = 'In Progress' 
ORDER BY ap.appointmentdate ASC 
LIMIT 3";
$result3 = $con->query($query3);
while ($row3 = $result3->fetch_assoc()) {
    $latestAppointments[] = $row3;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="sidebar.css" />

    <script src="/bootstrap-5.3.2/dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="/bootstrap-5.3.2/dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/637ae4e7ce.js" crossorigin="anonymous"></script>
    <title>Doctor Dashboard</title>
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

    <div class="grid-container">
        <div class="grid-item item1">
            <p class="greeting">Hello Dr. <?php echo $row['firstname'] . ' ' . $row['lastname'] ?> <br> Upcoming Appointments</p>
            <div class="appointmentNumber">
                <span class="textAppointmentNumber"><?php echo $row2['appointmentcount'] ?></span>
            </div>
            <div class="appointment appointment1">
                <?php if (!empty($latestAppointments[0])) : ?>
                    <p><?php echo $latestAppointments[0]['appointmentdate'] ?></p>
                    <p><?php echo $latestAppointments[0]['firstname'] . ' ' . $latestAppointments[0]['lastname'] ?></p>
                    <p><?php echo $latestAppointments[0]['appointmentslot'] ?></p>
                <?php else : ?>
                    <p>No appointment</p>
                <?php endif; ?>
            </div>
            <div class="appointment appointment2">
                <?php if (!empty($latestAppointments[1])) : ?>
                    <p><?php echo $latestAppointments[1]['appointmentdate'] ?></p>
                    <p><?php echo $latestAppointments[1]['firstname'] . ' ' . $latestAppointments[0]['lastname'] ?></p>
                    <p><?php echo $latestAppointments[1]['appointmentslot'] ?></p>
                <?php else : ?>
                    <p>No appointment</p>
                <?php endif; ?>
            </div>
            <div class="appointment">
                <?php if (!empty($latestAppointments[2])) : ?>
                    <p><?php echo $latestAppointments[2]['appointmentdate'] ?></p>
                    <p><?php echo $latestAppointments[2]['firstname'] . ' ' . $latestAppointments[0]['lastname'] ?></p>
                    <p><?php echo $latestAppointments[2]['appointmentslot'] ?></p>
                <?php else : ?>
                    <p>No appointment</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="grid-item item2">
            <div class="date" id="systemDate">SUN 22 MAY 2024</div>
            <div class="time" id="dynamicTime">05 : 08 : 23 </div>
        </div>
        <div class="grid-item item3">
            <a href="doctorSchedule.php">My Schedule</a>
        </div>
        <div class="grid-item item4">
            <a href="patientMedicalRecords.php">Patient Medical Records</a>
        </div>
    </div>
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
        window.onload = function() {
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            var daysOfWeek = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
            var months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
            var dayOfWeek = daysOfWeek[currentDate.getDay()];

            var formattedDate = dayOfWeek + " " + (day < 10 ? '0' + day : day) + " " + months[month] + " " + year;

            document.getElementById('systemDate').innerHTML = formattedDate;
            document.getElementById("systemDate").style.wordSpacing = "15px";
        };

        function updateTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();

            hours = (hours < 10 ? "0" : "") + hours;
            minutes = (minutes < 10 ? "0" : "") + minutes;
            seconds = (seconds < 10 ? "0" : "") + seconds;

            var formattedTime = hours + " : " + minutes + " : " + seconds;

            document.getElementById('dynamicTime').innerHTML = formattedTime;
        }

        function toggleNavbar() {
            var navbar = document.getElementById("navbar");
            var menu = document.getElementById("menu");
            var homeText = document.getElementById("homeText");
            var appointmentText = document.getElementById("appointmentText");

            if (navbar.classList.contains("menu-closed")) {
                navbar.classList.remove("menu-closed");
                navbar.classList.add("menu-open");
                menu.style.display = "block";
                homeText.style.display = "inline";
                appointmentText.style.display = "inline";
            } else {
                navbar.classList.remove("menu-open");
                navbar.classList.add("menu-closed");
                menu.style.display = "none";
                homeText.style.display = "none";
                appointmentText.style.display = "none";
            }
        }
        setInterval(updateTime, 1000);
    </script>
</body>

</html>