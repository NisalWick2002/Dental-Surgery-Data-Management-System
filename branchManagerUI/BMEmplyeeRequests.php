<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Leave Requests</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="BMEmplyeeRequests.css">
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
        <p>Employee Leave Requests</p>
    </div>
    <div class="bottom">
        <select id="searchCriteria" class="form-select">
            <option value="date">Date</option>
            <option value="eName">Employee Name</option>
            <option value="status">Status</option>
        </select>
        <div class="search">
            <input type="text" class="form-control" id="searchValue" placeholder="eg :YYYY/MM/DD">
        </div>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="small">EMPID</th>
                    <th class="medium">Name</th>
                    <th class="medium">Date</th>
                    <th class="medium">Leave Type</th>
                    <th class="large">Reason</th>
                    <th class="medium">Status</th>
                    <th class="large">Action</th>
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
    document.addEventListener("DOMContentLoaded", function() {

        var data = [{
                empId: "E005",
                name: "Pubudu Perera",
                date: "2023/05/24",
                leaveType: "Half Day:mor",
                reason: "Personal Emergency",
                status: "Pending"
            },
            {
                empId: "E004",
                name: "Nimal Perera",
                date: "2023/05/22",
                leaveType: "Half Day:eve",
                reason: "Personal Emergency",
                status: "Pending"
            },
            {
                empId: "E003",
                name: "Saman Perera",
                date: "2023/05/16",
                leaveType: "Full Day",
                reason: "Personal Emergency",
                status: "Approved"
            },
            {
                empId: "E002",
                name: "Chamod Perera",
                date: "2023/05/12",
                leaveType: "Priviladge Leave",
                reason: "Personal Emergecy",
                status: "Approved"
            },
            {
                empId: "E001",
                name: "Kamal Perera",
                date: "2023/05/10",
                leaveType: "Full Day",
                reason: "Family Emergency",
                status: "Pending"
            }
        ];

        var tbody = document.querySelector(".table tbody");

        // Loop through the data and create table rows
        data.forEach(function(item) {
            var row = document.createElement("tr");

            row.innerHTML = `
            <td class="small">${item.empId}</td>
            <td class="medium">${item.name}</td>
            <td class="medium">${item.date}</td>
            <td class="medium">${item.leaveType}</td>
            <td class="large">${item.reason}</td>
            <td class="medium">${item.status}</td>
            <td class="large">
                ${item.status !== "Pending" ?
                    `<button class="btn btn-outline-secondary btn-approve" disabled>Approve</button>
                    <button class="btn btn-outline-secondary btn-reject" disabled>Reject</button>` :
                    `<button class="btn btn-outline-info btn-approve">Approve</button>
                    <button class="btn btn-outline-danger btn-reject">Reject</button>`}
            </td>
        `;

            tbody.appendChild(row);
        });


        // Get all the approve buttons
        var approveButtons = document.querySelectorAll(".btn-approve");
        //get all the reject buttons
        var rejectButtons = document.querySelectorAll(".btn-reject");
        // Iterate over each approve button and attach a click event listener
        approveButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Find the parent row of the button that was clicked
                var row = this.closest("tr");
                changeStatus(row, "Approved");


            });
        });

        rejectButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Find the parent row of the button that was clicked
                var row = this.closest("tr");

                changeStatus(row, "Rejected");
            });
        });

        function changeStatus(row, status) {
            // change the status value            
            row.cells[5].textContent = status;
            // Disable both approve and reject buttons
            row.querySelector(".btn-approve").disabled = true;
            row.querySelector(".btn-reject").disabled = true;

            row.querySelector(".btn-approve").classList.replace("btn-outline-info", "btn-outline-secondary");
            row.querySelector(".btn-reject").classList.replace("btn-outline-danger", "btn-outline-secondary");
        }

        // Get the input field for the date search
        var searchInput = document.getElementById("searchValue");

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
                    cellContent = row.cells[2].textContent.toLowerCase();
                } else if (selectedCriteria === "ename") {
                    cellContent = row.cells[1].textContent.toLowerCase();
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
            var searchInput = document.getElementById("searchValue");
            console.log(searchCriteria.value);
            if (selectedValue === "eName") {
                searchInput.placeholder = "e.g. Pubu";
            } else if (selectedValue === "date") {
                searchInput.placeholder = "e.g. YYYY/MM/DD";
            } else if (selectedValue === "status") {
                searchInput.placeholder = "e.g. Approve/Rejec";
            }
        });

    });
</script>

</html>