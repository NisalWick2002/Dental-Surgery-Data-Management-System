<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee CheckInOut</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="checkinout.css">
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
                <a href="AnnualProfitReport.php" class="nav-list-item">
                    <i class="fas fa-user sideBarIcon"></i>
                    <span class="nav-item">Anuual Profits</span>
                </a>
            </li>
            <li>
                <a href="MonthlyIncomeReport.php" class="nav-list-item">
                    <i class="fas fa-wallet sideBarIcon"></i>
                    <span class="nav-item">Monthly Income</span>
                </a>
            </li>
            <li>
                <a href="MonthlyExpenseReport.php" class="nav-list-item">
                    <i class="fas fa-chart-bar sideBarIcon"></i>
                    <span class="nav-item">Monthly Expense</span>
                </a>
            </li>
            <li>
                <a href="MonthlyPatientVisitReport.php" class="nav-list-item">
                    <i class="fas fa-tasks sideBarIcon"></i>
                    <span class="nav-item">Patient Visits</span>
                </a>
            </li>
            <li>
                <a href="Expenses.php" class="nav-list-item">
                    <i class="fas fa-cog sideBarIcon"></i>
                    <span class="nav-item">Expenses</span>
                </a>
            </li>
            <li>
                <a href="checkInOut.php" class="nav-list-item">
                    <i class="fas fa-question-circle sideBarIcon"></i>
                    <span class="nav-item">check in outs</span>
                </a>
            </li>
            <li>
                <a href="BMEmplyeeRequests.php" class="nav-list-item">
                    <i class="fas fa-question-circle sideBarIcon"></i>
                    <span class="nav-item">Leave requests</span>
                </a>
            </li>
            <li>
                <a href="MedicineRequests.php" class="nav-list-item">
                    <i class="fas fa-question-circle sideBarIcon"></i>
                    <span class="nav-item">Medicine Requests</span>
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
        <p>Employee Check In Out</p>
    </div>
    <div class="bottom">
        <input name="" id="searchValue" class="form-control" type="text" placeholder="eg :2024/05/02"></input>
        <input name="" id="searchValue2" class="form-control" type="text" placeholder="eg :Pubudu"></input>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="large">CHK ID</th>
                    <th class="large">Emp Name</th>
                    <th class="large">Date</th>
                    <th class="large">InTime</th>
                    <th class="large">OutTime</th>
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
    var empchkdata = [{
            chkid: "CHK001",
            empname: "Pubudu",
            date: "2024/05/08",
            intime: "09:30AM",
            outime: "05:00PM"
        },
        {
            chkid: "CHK002",
            empname: "Pamod",
            date: "2024/05/08",
            intime: "10:30AM",
            outime: "02:00PM"
        },
        {
            chkid: "CHK003",
            empname: "Nimal",
            date: "2024/05/09",
            intime: "08:30AM",
            outime: "04:00PM"
        },
        {
            chkid: "CHK004",
            empname: "Kamal",
            date: "2024/05/09",
            intime: "08:30AM",
            outime: "08:00PM"
        },
        {
            chkid: "CHK005",
            empname: "Vimal",
            date: "2024/05/10",
            intime: "11:30AM",
            outime: "05:00PM"
        },
        {
            chkid: "CHK006",
            empname: "Pubudu",
            date: "2024/05/10",
            intime: "09:30AM",
            outime: "05:00PM"
        },
        {
            chkid: "CHK007",
            empname: "Pamod",
            date: "2024/05/11",
            intime: "10:30AM",
            outime: "02:00PM"
        },
        {
            chkid: "CHK008",
            empname: "Nimal",
            date: "2024/05/11",
            intime: "08:30AM",
            outime: "04:00PM"
        },
        {
            chkid: "CHK009",
            empname: "Kamal",
            date: "2024/05/12",
            intime: "08:30AM",
            outime: "08:00PM"
        },
        {
            chkid: "CHK010",
            empname: "Vimal",
            date: "2024/05/12",
            intime: "11:30AM",
            outime: "05:00PM"
        }
    ];


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
                    <td class="large">${item.chkid}</td>
                    <td class="large">${item.empname}</td>
                    <td class="large">${item.date}</td>
                    <td class="large">${item.intime}</td>
                    <td class="large">${item.outime}</td>
                `;
                tbody.appendChild(row);
            });
        }
        fillTable(empchkdata);


        // Add an event listener to capture changes in the input value
        searchValue2.addEventListener("input", function() {
            // Get the value entered by the user
            var inputValue = searchValue2.value.trim().toLowerCase();
            var inputValue2 = searchValue.value.trim().toLowerCase();
            // Get all the rows in the table body
            var tableRows = document.querySelectorAll(".table tbody tr");

            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
                var cellContent = row.cells[1].textContent.toLowerCase();
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
                var cellcontent2 = row.cells[1].textContent.toLowerCase();

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



        // Call the change event manually to populate the table initially
        searchCriteria.dispatchEvent(new Event("change"));
    });
</script>

</html>