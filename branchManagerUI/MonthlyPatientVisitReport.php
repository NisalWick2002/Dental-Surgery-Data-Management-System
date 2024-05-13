<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Patient Visit Report</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="MonthlyIncomeReport.css">
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
        <p>Monthly Patient Visit Report</p>
    </div>
    <div class="bottom">
        <select id="searchCriteria" class="form-select">
        </select>

        <select id="cmonth" class="form-select">
        </select>
        <button class="btn btn-primary viewReport">View Report</button>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="large">Date</th>
                    <th class="xlarge"></th>
                    <th class="large">Count</th>
                </tr>
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
    var January = [{
            date: "2024/01/01",
            count: 5
        },
        {
            date: "2024/01/05",
            count: 15
        },
        {
            date: "2024/01/10",
            count: 8
        },
        {
            date: "2024/01/15",
            count: 12
        },
        {
            date: "2024/01/20",
            count: 10
        }
    ];

    var February = [{
            date: "2024/02/03",
            count: 9
        },
        {
            date: "2024/02/08",
            count: 6
        },
        {
            date: "2024/02/12",
            count: 11
        },
        {
            date: "2024/02/17",
            count: 7
        },
        {
            date: "2024/02/21",
            count: 14
        },
        {
            date: "2024/02/26",
            count: 5
        },
        {
            date: "2024/02/29",
            count: 12
        }
    ];

    var March = [{
            date: "2024/03/04",
            count: 10
        },
        {
            date: "2024/03/07",
            count: 6
        },
        {
            date: "2024/03/13",
            count: 9
        },
        {
            date: "2024/03/18",
            count: 11
        },
        {
            date: "2024/03/22",
            count: 8
        },
        {
            date: "2024/03/24",
            count: 5
        },
        {
            date: "2024/03/27",
            count: 14
        }
    ];

    var September = [{
            date: "2023/09/04",
            count: 6
        },
        {
            date: "2023/09/07",
            count: 12
        },
        {
            date: "2023/09/13",
            count: 8
        },
        {
            date: "2023/09/18",
            count: 10
        },
        {
            date: "2023/09/22",
            count: 7
        },
        {
            date: "2023/09/24",
            count: 14
        },
        {
            date: "2023/09/27",
            count: 9
        }
    ];

    var October = [{
            date: "2023/10/04",
            count: 14
        },
        {
            date: "2023/10/07",
            count: 7
        },
        {
            date: "2023/10/13",
            count: 9
        },
        {
            date: "2023/10/18",
            count: 11
        },
        {
            date: "2023/10/22",
            count: 8
        },
        {
            date: "2023/10/24",
            count: 6
        },
        {
            date: "2023/10/27",
            count: 12
        }
    ];

    var November = [{
            date: "2023/11/04",
            count: 8
        },
        {
            date: "2023/11/07",
            count: 14
        },
        {
            date: "2023/11/13",
            count: 7
        },
        {
            date: "2023/11/18",
            count: 10
        },
        {
            date: "2023/11/22",
            count: 11
        },
        {
            date: "2023/11/24",
            count: 5
        },
        {
            date: "2023/11/27",
            count: 9
        }
    ];

    var December = [{
            date: "2023/12/04",
            count: 10
        },
        {
            date: "2023/12/07",
            count: 6
        },
        {
            date: "2023/12/13",
            count: 9
        },
        {
            date: "2023/12/18",
            count: 12
        },
        {
            date: "2023/12/22",
            count: 8
        },
        {
            date: "2023/12/24",
            count: 5
        },
        {
            date: "2023/12/27",
            count: 14
        }
    ];



    var years = [{
            year: 2024,
            months: ["January", "February", "March"]
        },
        {
            year: 2023,
            months: ["September", "October", "November", "December"]
        }
    ];

    document.addEventListener("DOMContentLoaded", function() {
        var searchCriteria = document.getElementById("searchCriteria");
        var cmonth = document.getElementById("cmonth");

        years.forEach(function(item) {
            var option = document.createElement("option");
            option.value = item.year;
            option.textContent = item.year;
            searchCriteria.appendChild(option);
        });

        function fillTable(data) {
            var tbody = document.querySelector(".table tbody");
            var count = 0;
            // Loop through the data and create table rows
            data.forEach(function(item) {
                var row = document.createElement("tr");

                row.innerHTML = `
                    <td class="large">${item.date}</td>
                    <td class="xlarge"></td>
                    <td class="large">${item.count}</td>
                `;
                count += item.count;
                tbody.appendChild(row);
            });

            var row = document.createElement("tr");
            row.classList.add("table-success");
            row.innerHTML = `
                    <td class="large fw-bold">Total Count</td>
                    <td class="xlarge fw-bold"></td>
                    <td class="large fw-bold">${count}</td>
                `;
            tbody.appendChild(row);
        }

        searchCriteria.addEventListener("change", function() {
            var selectedValue = searchCriteria.value;
            var searchInput = document.getElementById("searchValue");
            var selectedYear = years.find(item => item.year == selectedValue);
            var monthSelect = document.getElementById("cmonth");
            monthSelect.innerHTML = "";

            if (selectedYear) {
                selectedYear.months.forEach(function(month) {
                    var option = document.createElement("option");
                    option.value = month;
                    option.textContent = month;
                    monthSelect.appendChild(option);

                });
            } else {
                console.log("Year not found in data");
            }
            cmonth.dispatchEvent(new Event("change"));
        });

        cmonth.addEventListener("change", function() {
            var selectedMonth = cmonth.value;
            var tableBody = document.querySelector(".table tbody");
            tableBody.innerHTML = "";
            switch (selectedMonth) {
                case "January":
                    fillTable(January);
                    break;
                case "February":
                    fillTable(February);
                    break;
                case "March":
                    fillTable(March);
                    break;
                case "September":
                    fillTable(September);
                    break;
                case "October":
                    fillTable(October);
                    break;
                case "November":
                    fillTable(November);
                    break;
                case "December":
                    fillTable(December);
                    break;
            }
        });

        searchCriteria.dispatchEvent(new Event("change"));
    });
</script>

</html>