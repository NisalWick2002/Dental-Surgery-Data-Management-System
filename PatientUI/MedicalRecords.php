<?php
// Start the session
session_start();

// Include database connection
require("../config/dbconnection.php");

// Retrieve patient ID from the session
$patientID = $_SESSION['patientid']; // Adjust this according to your session variable name

// Check if patient ID is set in the session
if (!isset($patientID)) {
    // Handle the case where patient ID is not set in the session
    // Redirect the user or display an error message
    exit("Patient ID not found in session.");
}

// Query to retrieve medical records for the patient
$query = "SELECT mr.medicalrecordid, mr.date, mr.time, mr.presentingcomplaints,
        mr.treatments, mr.specialnotes, 
        CONCAT(d.firstname, ' ', d.lastname) AS doctorname
        FROM medicalrecord mr
        JOIN doctor d ON mr.doctorid = d.doctorid
        WHERE mr.patientid = '$patientID'";
$result = $con->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="MedicalRecords.css">
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
        <p>Medical Records</p>
    </div>
    <div class="bottom">
        <select id="searchCriteria" class="form-select">
            <option value="date">Date</option>
            <option value="doctorName">Doctor Name</option>
        </select>
        <div class="search">
            <input type="text" class="form-control" id="searchDate" placeholder="eg :YYYY/MM/DD">
        </div>
        <div class="mycontainer">
            <?php
            if ($result && $result->num_rows > 0) {
                // Output each medical record
                while ($row = $result->fetch_assoc()) {
                    // Output HTML for each medical record
                    echo "<div class='medicalRecord'>";
                    echo "<p class='dateTime'>Date: {$row['date']} Time: {$row['time']}</p>";
                    echo "<p class='mrid'>Record ID: {$row['medicalrecordid']}</p>";
                    echo "<p class='doctorName'>Consulted Doctor: Dr. {$row['doctorname']}</p>";
                    echo "<p>Presenting Complaints: {$row['presentingcomplaints']}</p>";
                    echo "<p>Treatments: {$row['treatments']}</p>";
                    echo "<p>Special Notes: {$row['specialnotes']}</p>";
                    echo "<button class='btn btn-primary btn-sm viewPrescription'>View Prescription</button>";
                    echo "<button class='btn btn-primary btn-sm downloadPDF'>Download As PDF</button>";
                    echo "</div>";
                }
            }
            ?>
            <!-- <div class="medicalRecord">
                <p class="dateTime">Date :2024/02/17 Time :02:30PM</p>
                <p>Record ID :MR003</p>
                <p class="doctorName">Consulted Doctor:Dr. Silva</p>
                <p>Presenting Complaints :Decaying Tooth</p>
                <p>Treatments :Removing Tooth</p>
                <p>Special Notes :Having skin allergy</p>
                <button class="btn btn-primary btn-sm viewPrescription">View Prescription</button>
                <button class="btn btn-primary btn-sm downloadPDF">Download As PDF</button>
            </div>
            <div class="medicalRecord">
                <p class="dateTime">Date :2023/12/09 Time :02:30PM</p>
                <p>Record ID :MR003</p>
                <p class="doctorName">Consulted Doctor:Dr. Pamod</p>
                <p>Presenting Complaints :Decaying Tooth</p>
                <p>Treatments :Removing Tooth</p>
                <p>Special Notes :Having skin allergy</p>
                <button class="btn btn-primary btn-sm viewPrescription">View Prescription</button>
                <button class="btn btn-primary btn-sm downloadPDF">Download As PDF</button>
            </div>
            <div class="medicalRecord">
                <p class="dateTime">Date :2023/06/18 Time :02:30PM</p>
                <p>Record ID :MR003</p>
                <p class="doctorName">Consulted Doctor:Dr. Nuwan</p>
                <p>Presenting Complaints :Decaying Tooth</p>
                <p>Treatments :Removing Tooth</p>
                <p>Special Notes :Having skin allergy</p>
                <button class="btn btn-primary btn-sm viewPrescription">View Prescription</button>
                <button class="btn btn-primary btn-sm downloadPDF">Download As PDF</button>
            </div> -->
        </div>
    </div>

    <div class="overlay" id="overlay">
        <div class="modal-content">
            <span class="close-btn" id="closeBtn">&times;</span>
            <img src="/images/prescription.jpg" height="250px" alt="Prescription Image">
        </div>
    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

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

        // Function to handle download PDF button click
        function handleDownloadPDF(event) {
            // Prevent the default action of the button
            event.preventDefault();

            // Get the medical record ID associated with the button
            var medicalRecordID = event.target.closest('.medicalRecord').querySelector('.mrid').textContent.trim();

            // Split the string into an array based on the delimiter ':'
            var parts = medicalRecordID.split(':');

            // Get the second part of the array (index 1), which contains the ID, and remove leading/trailing whitespace
            var recordID = parts[1].trim();

            // Create a form element
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '../reports/medicalRecord.php';
            form.target = '_blank'; // Open in a new tab/window

            // Create a hidden input field for the medicalrecordid
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'medicalrecordid';
            hiddenInput.value = recordID;

            // Append the hidden input to the form
            form.appendChild(hiddenInput);

            // Append the form to the document body and submit it
            document.body.appendChild(form);
            form.submit();
            console.log(recordID);
            // Remove the form from the document body
            document.body.removeChild(form);
            // Open pdfreport.php in a new tab with the medical record ID as a query parameter
            // window.open('../reports/medicalRecord.php?medicalrecordid=' + medicalRecordID, '_blank');
        }

        // Add event listeners to all "Download As PDF" buttons
        var downloadPDFBtns = document.querySelectorAll(".downloadPDF");
        downloadPDFBtns.forEach(function(button) {
            button.addEventListener("click", handleDownloadPDF);
        });
        var searchCriteria = document.getElementById("searchCriteria");

        searchCriteria.addEventListener("change", function() {
            var selectedValue = searchCriteria.value;
            var searchDateInput = document.getElementById("searchDate");

            if (selectedValue === "doctorName") {
                searchDateInput.placeholder = "e.g. Dr.";
            } else {
                searchDateInput.placeholder = "e.g. YYYY/MM/DD";
            }
        });

        var searchInput = document.getElementById("searchDate");
        searchInput.addEventListener("input", function() {
            var searchValue = searchInput.value.trim().toLowerCase();
            var selectedCriteria = searchCriteria.value;
            var medicalRecords = document.querySelectorAll(".medicalRecord");

            medicalRecords.forEach(function(record) {
                var dateTime = record.querySelector(".dateTime").textContent.toLowerCase();
                var doctorName = record.querySelector(".doctorName").textContent.toLowerCase();

                if (selectedCriteria === "date" && dateTime.includes(searchValue)) {
                    record.style.display = ""; // Show the medical record
                } else if (selectedCriteria === "doctorName" && doctorName.includes(searchValue)) {
                    record.style.display = ""; // Show the medical record
                } else {
                    record.style.display = "none"; // Hide the medical record
                }
            });
        });
        var viewPrescriptionBtns = document.querySelectorAll(".viewPrescription");
        var overlay = document.getElementById("overlay");
        var closeBtn = document.getElementById("closeBtn");

        // Add click event listeners to all "View Prescription" buttons
        viewPrescriptionBtns.forEach(function(button) {
            button.addEventListener("click", function() {
                // Show the overlay
                overlay.style.display = "block";
            });
        });

        // Add click event listener to the close button
        closeBtn.addEventListener("click", function() {
            // Hide the overlay when the close button is clicked
            overlay.style.display = "none";
        });

        // Hide the overlay when clicked outside of the modal content
        window.addEventListener("click", function(event) {
            if (event.target === overlay) {
                overlay.style.display = "none";
            }
        });
    });
</script>

</html>