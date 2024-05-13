<?php
require("../config/dbconnection.php");
session_start();
$empid = $_SESSION['employeeid'];
$branchid = $_SESSION['branchid'];

if (isset($_POST['year'])) {
    $year = $_POST['year'];
    $incomeQuery = "SELECT MONTHNAME(date) AS month, SUM(amount) AS income
                    FROM income
                    WHERE YEAR(date) = '$year' AND branchid = '$branchid'
                    GROUP BY MONTHNAME(date)";
    $expenseQuery = "SELECT MONTHNAME(date) AS month, SUM(amount) AS expense
                     FROM expense
                     WHERE YEAR(date) = '$year' AND branchid = '$branchid'
                     GROUP BY MONTHNAME(date)";
    $incomeResult = $con->query($incomeQuery);
    $expenseResult = $con->query($expenseQuery);
    $data = array();
    // Process income results
    while ($row = $incomeResult->fetch_assoc()) {
        $month = $row['month'];
        $income = floatval($row['income']);
        $data[$month] = array('month' => $month, 'income' => $income, 'expense' => 0);
    }
    while ($row = $expenseResult->fetch_assoc()) {
        $month = $row['month'];
        $expense = floatval($row['expense']);
        if (!isset($data[$month])) {
            $data[$month] = array('month' => $month, 'income' => 0, 'expense' => $expense);
        } else {
            $data[$month]['expense'] = $expense;
        }
    }
    echo json_encode($data);
    exit;
}



$years = array();

// Query to fetch distinct years from the expense table
$query = "SELECT DISTINCT YEAR(date) AS year FROM pdms.expense where branchid='$branchid'";
$result = $con->query($query);
while ($row = $result->fetch_assoc()) {
    $years[] = $row['year'];
}

// Query to fetch distinct years from the income table
$query = "SELECT DISTINCT YEAR(date) AS year FROM pdms.income where branchid='$branchid'";
$result = $con->query($query);
while ($row = $result->fetch_assoc()) {
    // Add the year to the array only if it's not already present
    if (!in_array($row['year'], $years)) {
        $years[] = $row['year'];
    }
}

// Sort the years in descending order
rsort($years);

// Now, $years array contains all the distinct years from both tables
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annual Profit Report</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="AnnualProfitReport.css">
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
        <p>Annual Profit Report</p>
    </div>
    <div class="bottom">
        <select id="searchCriteria" class="form-select">
        </select>
        <button class="btn btn-primary viewReport">View Report</button>
        <table class="table table-responsive table-dark table-striped table-hover rounded ">
            <thead class="text-center">
                <tr>
                    <th class="large">Month</th>
                    <th class="large">Total Income</th>
                    <th class="large">Total Expense</th>
                    <th class="large">Profit</th>
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
    var years = <?php echo json_encode($years) ?>;




    document.addEventListener("DOMContentLoaded", function() {
        var searchCriteria = document.getElementById("searchCriteria");

        years.forEach(function(year) {
            var option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            searchCriteria.appendChild(option);
        });

        var tbody = document.querySelector(".table tbody");



        searchCriteria.addEventListener("change", function() {
            var selectedValue = searchCriteria.value;
            var searchInput = document.getElementById("searchValue");

            // Clear the existing table body content
            var tableBody = document.querySelector(".table tbody");
            tableBody.innerHTML = "";
            $.ajax({
                type: "POST",
                url: "AnnualProfitReport.php",
                data: {
                    year: selectedValue
                },
                dataType: "json",
                success: function(response) {
                    fillTable(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error occurred while fetching data:", error);
                }
            });

        });

        // Call the change event manually to populate the table initially
        searchCriteria.dispatchEvent(new Event("change"));
    });

    function fillTable(data) {
        var tincome = 0;
        var texpense = 0;
        var tbody = document.querySelector(".table tbody");

        // Loop through the data and create table rows
        Object.keys(data).forEach(function(month) {
            var row = document.createElement("tr");
            row.innerHTML = `
            <td class="large">${data[month].month}</td>
            <td class="large">${data[month].income}</td>
            <td class="large">${data[month].expense}</td>
            <td class="large">${data[month].income - data[month].expense}</td>
        `;
            tincome += parseFloat(data[month].income); // Parse income as float
            texpense += parseFloat(data[month].expense); // Parse expense as float
            tbody.appendChild(row);
        });

        // Add total row
        var totalRow = document.createElement("tr");
        totalRow.classList.add("table-success");
        totalRow.innerHTML = `
        <td class="large fw-bold">Total</td>
        <td class="large fw-bold">${tincome}</td>
        <td class="large fw-bold">${texpense}</td>
        <td class="large fw-bold">${tincome - texpense}</td>
    `;
        tbody.appendChild(totalRow);
    }

    // function fillTable(data) {
    //     var tincome = 0;
    //     var texpense = 0;
    //     var tbody = document.querySelector(".table tbody");

    //     // Loop through the data and create table rows
    //     data.forEach(function(item) {
    //         var row = document.createElement("tr");

    //         row.innerHTML = `
    //                 <td class="large">${item.month}</td>
    //                 <td class="large">${item.income}</td>
    //                 <td class="large">${item.expense}</td>
    //                 <td class="large">${item.income - item.expense}</td>
    //             `;
    //         tincome += item.income;
    //         texpense += item.expense;
    //         tbody.appendChild(row);
    //     });

    //     var row = document.createElement("tr");
    //     row.classList.add("table-success");
    //     row.innerHTML = `
    //                 <td class="large fw-bold">Total</td>
    //                 <td class="large fw-bold">${tincome}</td>
    //                 <td class="large fw-bold">${texpense}</td>
    //                 <td class="large fw-bold">${tincome - texpense}</td>
    //             `;
    //     tbody.appendChild(row);
    // }
</script>

</html>