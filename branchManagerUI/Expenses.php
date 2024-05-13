<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Expenses</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="expenses.css">
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
        <p class="">Branch Expenses</p>
        <button class="btn btn-primary addexpense" id="addexpense">Add Expense</button>
    </div>
    <div class="bottom">
        <input name="" id="searchValue" class="form-control" type="text" placeholder="eg :2024/05/02"></input>
        <input name="" id="searchValue2" class="form-control" type="text" placeholder="eg :water bill"></input>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="small">Expense ID</th>
                    <th class="large">Date</th>
                    <th class="xlarge">Description</th>
                    <th class="large">Amount</th>
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
                    <h5 class="modal-title text-center" id="editModalLabel">Add Expense</h5>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label id="idlabel">Expense ID:</label>
                            <input type="text" class="form-control" id="expenseID" readonly>
                        </div>
                        <div class="form-group">
                            <label>Date:</label>
                            <input type="text" class="form-control" id="date" readonly>
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea type="text" rows="7" class="form-control" id="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Amount:</label>
                            <input type="text" class="form-control" id="Amount">
                        </div>
                    </form>
                </div>
                <div class="footer">
                    <button type="button" class="btn btn-primary" id="addExpense">Add Expense</button>
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
    var branchexpenses = [{
            exid: "EX001",
            date: "2024/05/21",
            description: "Monthly Building Rental",
            amount: 10000
        },
        {
            exid: "EX002",
            date: "2024/05/23",
            description: "Water Bill",
            amount: 25000
        },
        {
            exid: "EX003",
            date: "2024/05/24",
            description: "Light Bill",
            amount: 35000
        },
        {
            exid: "EX004",
            date: "2024/05/25",
            description: "Internet Bill",
            amount: 15000
        },
        {
            exid: "EX005",
            date: "2024/05/27",
            description: "New equipment purchase",
            amount: 70000
        },
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
                    <td class="small">${item.exid}</td>
                    <td class="large">${item.date}</td>
                    <td class="xlarge">${item.description}</td>
                    <td class="large">${item.amount}</td>
                `;
                tbody.appendChild(row);
            });
        }
        fillTable(branchexpenses);


        // Add an event listener to capture changes in the input value
        searchValue2.addEventListener("input", function() {
            // Get the value entered by the user
            var inputValue = searchValue2.value.trim().toLowerCase();
            var inputValue2 = searchValue.value.trim().toLowerCase();
            // Get all the rows in the table body
            var tableRows = document.querySelectorAll(".table tbody tr");

            // Loop through each row and hide rows that don't match the search value
            tableRows.forEach(function(row) {
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

        var addexpense = document.getElementById("addexpense");

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
            var eid = document.getElementById("expenseID");
            eid.value = "EX007";
            var date = document.getElementById("date");
            date.value = formattedDate;
            // Hide the modal
            $('#editModal').modal('show');
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