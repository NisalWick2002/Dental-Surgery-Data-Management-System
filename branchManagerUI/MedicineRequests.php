<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Requests</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="MedicineRequest.css">
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
        <p>Medicine Requests</p>
    </div>
    <div class="bottom">
        <select id="searchCriteria" class="form-select">
            <option value="date">Date</option>
            <option value="status">Status</option>
        </select>
        <div class="search">
            <input type="text" class="form-control" id="searchValue" placeholder="eg :YYYY/MM/DD">
        </div>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="small">Request ID</th>
                    <th class="large">Emp Name</th>
                    <th class="medium">Requested Date</th>
                    <th class="xlarge">Medicine List</th>
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


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 1000px; transform: translate(-25%,10%);">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editModalLabel">Medicine List</h5>
                </div>
                <div class="modal-body">
                    <table id="medicine-table">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Brand Name</th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                            </tr>



                        </thead>
                        <tbody id="medBody">
                            <tr>
                                <td>Amoxicillin500mg</td>
                                <td>Amoxil</td>
                                <td>Antibiotic</td>
                                <td>12</td>
                                <td>150</td>
                            </tr>
                            <tr>
                                <td>Amoxicillin250mg</td>
                                <td>Moxilin</td>
                                <td>Antibiotic</td>
                                <td>8</td>
                                <td>180</td>
                            </tr>
                            <tr>
                                <td>Midazolam</td>
                                <td>Dormicum</td>
                                <td>For sedation</td>
                                <td>30</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Analgesics</td>
                                <td>Lbuprofen</td>
                                <td>Pain Killer</td>
                                <td>21</td>
                                <td>150</td>
                            </tr>
                            <tr>
                                <td>Clindamycin16.5mg </td>
                                <td>Cleocin</td>
                                <td>For bacteria Infections</td>
                                <td>9</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <td>Listerine150mg </td>
                                <td>Listerine</td>
                                <td>For bad breath</td>
                                <td>450</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>Gel1100 150mg </td>
                                <td>CariFree</td>
                                <td>Anti Cavity gel</td>
                                <td>350</td>
                                <td>18</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                </div>
            </div>
        </div>
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
        var medicineData = [{
                "Medicine Name": "Amoxicillin500mg",
                "Brand Name": "Amoxil",
                "Description": "Antibiotic",
                "Unit Price": 12,
                "Quantity": 150
            },
            {
                "Medicine Name": "Amoxicillin250mg",
                "Brand Name": "Moxilin",
                "Description": "Antibiotic",
                "Unit Price": 8,
                "Quantity": 180
            },
            {
                "Medicine Name": "Midazolam",
                "Brand Name": "Dormicum",
                "Description": "For sedation",
                "Unit Price": 30,
                "Quantity": 200
            },
            {
                "Medicine Name": "Analgesics",
                "Brand Name": "Lbuprofen",
                "Description": "Pain Killer",
                "Unit Price": 21,
                "Quantity": 150
            },
            {
                "Medicine Name": "Clindamycin16.5mg",
                "Brand Name": "Cleocin",
                "Description": "For bacteria Infections",
                "Unit Price": 9,
                "Quantity": 250
            },
            {
                "Medicine Name": "Listerine150mg",
                "Brand Name": "Listerine",
                "Description": "For bad breath",
                "Unit Price": 450,
                "Quantity": 15
            },
            {
                "Medicine Name": "Gel1100 150mg",
                "Brand Name": "CariFree",
                "Description": "Anti Cavity gel",
                "Unit Price": 350,
                "Quantity": 18
            }
        ];
        var data = [{
                requestId: "MR001",
                empName: "Pubudu Perera",
                requestedDate: "2023/05/24",
                status: "Pending"
            },
            {
                requestId: "MR002",
                empName: "Nimal Perera",
                requestedDate: "2023/05/22",
                status: "Pending"
            },
            {
                requestId: "MR003",
                empName: "Saman Perera",
                requestedDate: "2023/05/16",
                status: "Approved"
            },
            {
                requestId: "MR004",
                empName: "Chamod Perera",
                requestedDate: "2023/05/12",
                status: "Approved"
            },
            {
                requestId: "MR005",
                empName: "Kamal Perera",
                requestedDate: "2023/05/10",
                status: "Pending"
            }
        ];

        var tbody = document.querySelector(".table tbody");

        // Loop through the data and create table rows
        data.forEach(function(item) {
            var row = document.createElement("tr");

            row.innerHTML = `
            <td class="small">${item.requestId}</td>
            <td class="large">${item.empName}</td>
            <td class="medium">${item.requestedDate}</td>
            <td class="xlarge"><button class="btn btn-outline-info btn-viewMedicine">View list</button>
                ${item.status.toLowerCase() === "approved" ?
                    `<button class="btn btn-outline-info btn-viewBill">View Bill</button>` : ""}
            </td>
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

                var medicineListCell = row.querySelector(".xlarge");
                var viewBillButton = document.createElement("button");
                viewBillButton.className = "btn btn-outline-info btn-viewBill";
                viewBillButton.textContent = "View Bill";
                medicineListCell.appendChild(viewBillButton);

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
            row.cells[4].textContent = status;
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
                } else if (selectedCriteria === "status") {
                    cellContent = row.cells[4].textContent.toLowerCase();
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
        //changing the placeholder according to the combox box selection
        searchCriteria.addEventListener("change", function() {
            var selectedValue = searchCriteria.value;
            var searchInput = document.getElementById("searchValue");
            console.log(searchCriteria.value);
            if (selectedValue === "date") {
                searchInput.placeholder = "e.g. YYYY/MM/DD";
            } else if (selectedValue === "status") {
                searchInput.placeholder = "e.g. Approve/Rejec";
            }
        });

        // Get all the view list buttons
        var viewListButtons = document.querySelectorAll(".btn-viewMedicine");

        // Attach event listeners to all the view list buttons
        viewListButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                var medTable = document.getElementById("medicine-table");
                var medBody = document.getElementById("medBody");
                medBody.innerHTML = "";
                var row = document.createElement("tr");
                medicineData.forEach(function(medicine) {
                    var row = document.createElement("tr");

                    // Create table cells for each property of the medicine
                    Object.keys(medicine).forEach(function(key) {
                        var cell = document.createElement("td");
                        cell.textContent = medicine[key];
                        row.appendChild(cell);
                    });

                    // Append the row to the tbody
                    medBody.appendChild(row);
                });
                $('#editModal').modal('show');
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