<?php
require("../config/dbconnection.php");
session_start();
$recordid = $_POST['medicalrecordid'];

$getMRecquery = "SELECT medicalrecordid,patientid,
                (SELECT CONCAT(firstname, ' ', lastname) 
                FROM patient WHERE patientid = m.patientid) AS patientname,
                TIMESTAMPDIFF(YEAR, (SELECT dob FROM patient WHERE patientid = m.patientid), CURDATE()) 
                AS patientage,
                (SELECT CONCAT(firstname, ' ', lastname) 
                FROM doctor WHERE doctorid = m.doctorid) AS doctorname,
                specialnotes,presentingcomplaints,treatments,date
                FROM medicalrecord m
                where medicalrecordid='$recordid'";

$Record = $con->query($getMRecquery);
$MedicalRecord = $Record->fetch_assoc();

$treatmentsArray = explode(",", $MedicalRecord['treatments']);
$complaintsArray = explode(",", $MedicalRecord['presentingcomplaints']);
$specialNotesArray = explode(",", $MedicalRecord['specialnotes']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="pmedicalrecord.css">
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
        <p class="">Medcial Record</p>
        <a href="patientMedicalRecords.php">
            <button class="btn btn-primary addexpense" id="viewExpenses">View Records</button>
        </a>

    </div>
    <div class="bottom">
        <div class="container">
            <div class="item1">
                <div class="inneritem">
                    <label for="rid">Record ID</label>
                    <input type="text" class="form-control" id="rid" readonly>
                </div>
                <div class="inneritem">
                    <label for="pid">Patient ID</label>
                    <input type="text" class="form-control" id="pid" readonly>
                </div>
                <div class="inneritem">
                    <label for="pname">Patient Name</label>
                    <input type="text" class="form-control" id="pname" readonly>
                </div>
            </div>
            <div class="item2">
                <div class="inneritem">
                    <label for="page">Patient Age</label>
                    <input type="text" class="form-control" id="page" readonly>
                </div>
                <div class="inneritem">
                    <label for="dname">Doctor Name</label>
                    <input type="text" class="form-control" id="dname" readonly>
                </div>
                <div class="inneritem">
                    <label for="date">Date</label>
                    <input type="text" class="form-control" id="date" readonly>
                </div>
            </div>
            <div class="item3">
                <div class="inneritem">
                    <label for="complaints">Presenting Complaints</label>
                    <textarea rows="5" class="form-control" id="complaints" readonly></textarea>
                </div>
                <div class="inneritem">
                    <label for="treatements">Treatments</label>
                    <textarea rows="5" class="form-control" id="treatments" readonly></textarea>
                </div>
            </div>
            <div class="item4">
                <div class="inneritem">
                    <label>Prescription Image</label>
                    <img src="/images/prescription.jpg" alt="">
                </div>
            </div>
            <div class="item5">
                <div class="inneritem">
                    <label for="specialnotes">Special Notes</label>
                    <textarea rows="5" class="form-control" id="specialnotes" readonly></textarea>
                </div>
            </div>


        </div>
    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    var recordDetails = {
        rid: "<?php echo $MedicalRecord['medicalrecordid'] ?>",
        pid: "<?php echo $MedicalRecord['patientid'] ?>",
        pname: "<?php echo $MedicalRecord['patientname'] ?>",
        date: "<?php echo $MedicalRecord['date'] ?>",
        dname: "Dr. <?php echo $MedicalRecord['doctorname'] ?>",
        page: "<?php echo $MedicalRecord['patientage'] ?>",
        complaints: <?php echo json_encode($complaintsArray)?>,
        treatments: <?php echo json_encode($treatmentsArray)?>,
        specialnotes: <?php echo json_encode($specialNotesArray)?>
    }

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
        var rid = document.getElementById("rid");
        var pid = document.getElementById("pid");
        var pname = document.getElementById("pname");
        var page = document.getElementById("page");
        var date = document.getElementById("date");
        var dname = document.getElementById("dname");
        var complaints = document.getElementById("complaints");
        var treatments = document.getElementById("treatments");
        var specialnotes = document.getElementById("specialnotes");

        rid.value = recordDetails.rid;
        pid.value = recordDetails.pid;
        pname.value = recordDetails.pname;
        page.value = recordDetails.page;
        date.value = recordDetails.date;
        dname.value = recordDetails.dname;
        var allcomplaints = "";
        recordDetails.complaints.forEach(element => {
            allcomplaints += element + '\n';
        });
        complaints.value = allcomplaints;

        var alltreatments = "";
        recordDetails.treatments.forEach(element => {
            alltreatments += element + '\n';
        });
        treatments.value = alltreatments;

        var allspecialnotes = "";
        recordDetails.specialnotes.forEach(element => {
            allspecialnotes += element + '\n';
        });
        specialnotes.value = allspecialnotes;


    });
</script>

</html>