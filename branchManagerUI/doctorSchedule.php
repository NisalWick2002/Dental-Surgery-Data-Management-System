<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedule</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="doctorSchedule.css">
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
        <p>Doctor Schedule</p>
    </div>
    <div class="bottom">
        <select id="doctorName" class="form-select">
        </select>

        <select id="year" class="form-select">
        </select>

        <select id="weekNo" class="form-select">
        </select>

        <div class="mycontainer">
            <div class="item header">
                <div class="innerItem">Time Slot</div>
                <div class="innerItem day1">Day 1</div>
                <div class="innerItem day2">Day 2</div>
                <div class="innerItem day3">Day 3</div>
                <div class="innerItem day4">Day 4</div>
                <div class="innerItem day5">Day 5</div>
                <div class="innerItem day6">Day 6</div>
                <div class="innerItem day7">Day 7</div>
            </div>
            <div class="item slot1 slot">
                <div class="innerItem">08:30-11:00 AM</div>
                <div class="innerItem day day1"></div>
                <div class="innerItem day day2"></div>
                <div class="innerItem day day3"></div>
                <div class="innerItem day day4"></div>
                <div class="innerItem day day5"></div>
                <div class="innerItem day day6"></div>
                <div class="innerItem day day7"></div>
            </div>
            <div class="item slot2 slot">
                <div class="innerItem">11:00-01:30 PM</div>
                <div class="innerItem day day1"></div>
                <div class="innerItem day day2"></div>
                <div class="innerItem day day3"></div>
                <div class="innerItem day day4"></div>
                <div class="innerItem day day5"></div>
                <div class="innerItem day day6"></div>
                <div class="innerItem day day7"></div>
            </div>
            <div class="item slot3 slot">
                <div class="innerItem">02:30-05:00 PM</div>
                <div class="innerItem day day1"></div>
                <div class="innerItem day day2"></div>
                <div class="innerItem day day3"></div>
                <div class="innerItem day day4"></div>
                <div class="innerItem day day5"></div>
                <div class="innerItem day day6"></div>
                <div class="innerItem day day7"></div>
            </div>
            <div class="item slot4 slot">
                <div class="innerItem">05:30-08:00 PM</div>
                <div class="innerItem day day1"></div>
                <div class="innerItem day day2"></div>
                <div class="innerItem day day3"></div>
                <div class="innerItem day day4"></div>
                <div class="innerItem day day5"></div>
                <div class="innerItem day day6"></div>
                <div class="innerItem day day7"></div>
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
    const doctors = [{
            name: "Dr. Smith",
            hiredYear: 2015
        },
        {
            name: "Dr. Johnson",
            hiredYear: 2018
        },
        {
            name: "Dr. Williams",
            hiredYear: 2016
        }
    ];

    function getDateWeek(date) {
        const currentDate =
            (typeof date === 'object') ? date : new Date();
        const januaryFirst =
            new Date(currentDate.getFullYear(), 0, 1);
        const daysToNextMonday =
            (januaryFirst.getDay() === 1) ? 0 :
            (7 - januaryFirst.getDay()) % 7;
        const nextMonday =
            new Date(currentDate.getFullYear(), 0,
                januaryFirst.getDate() + daysToNextMonday);

        return (currentDate < nextMonday) ? 52 :
            (currentDate > nextMonday ? Math.ceil(
                (currentDate - nextMonday) / (24 * 3600 * 1000) / 7) : 1);
    }


    document.addEventListener("DOMContentLoaded", function() {
        const doctorSelect = document.getElementById("doctorName");
        const yearSelect = document.getElementById("year");
        const weekNoSelect = document.getElementById("weekNo");

        //adding doctors to the doctorname combo box
        doctors.forEach(doctor => {
            const option = document.createElement("option");
            option.value = doctor.name;
            option.textContent = doctor.name;
            doctorSelect.appendChild(option);
        });

        // Function to calculate weeks in a year
        function getWeeksInYear(year) {
            const firstDayOfYear = new Date(year, 0, 1);
            const lastDayOfYear = new Date(year, 11, 31);
            const daysInYear = (lastDayOfYear - firstDayOfYear) / (1000 * 60 * 60 * 24);
            return Math.ceil((daysInYear + firstDayOfYear.getDay()) / 7);
        }

        // Event listener for doctor select box
        doctorSelect.addEventListener("change", function() {
            const selectedDoctor = doctors.find(doctor => doctor.name === this.value);
            const currentYear = new Date().getFullYear();
            if (selectedDoctor) {
                yearSelect.innerHTML = "";
                for (let year = selectedDoctor.hiredYear; year <= currentYear; year++) {
                    const option = document.createElement("option");
                    option.value = year;
                    option.textContent = year;
                    yearSelect.appendChild(option);
                }

            }
            //manually selecting year 
            yearSelect.value = currentYear;
            yearSelect.dispatchEvent(new Event("change"));

        });

        // Event listener for year select box
        yearSelect.addEventListener("change", function() {
            const selectedYear = parseInt(this.value);
            if (!isNaN(selectedYear)) {
                const weeksInYear = getWeeksInYear(selectedYear);
                weekNoSelect.innerHTML = "";
                for (let week = 1; week <= weeksInYear; week++) {
                    const option = document.createElement("option");
                    option.value = week;
                    option.textContent = `Week ${week}`;
                    weekNoSelect.appendChild(option);
                }
            }
            if (selectedYear == new Date().getFullYear()) {
                weekNoSelect.value = getDateWeek(new Date()) - 1;
            } else {
                weekNoSelect.value = 1;
            }

            weekNoSelect.dispatchEvent(new Event("change"));
        });

        weekNoSelect.addEventListener("change", function() {
            const selectedYear = parseInt(yearSelect.value);
            const selectedWeek = parseInt(this.value);

            if (!isNaN(selectedYear) && !isNaN(selectedWeek)) {
                const startDate = getStartDateOfWeek(selectedYear, selectedWeek);
                updateHeaderDates(startDate);
                if (selectedWeek % 2 == 0)
                    updateAvailability(startDate, availableSlot1);
                else
                    updateAvailability(startDate, availableSlot2);
            }
        });



        // manually selecting a option in doctorname combo
        doctorSelect.dispatchEvent(new Event("change"));
    });

    // Function to calculate the start date of a week
    function getStartDateOfWeek(year, week) {
        const januaryFirst = new Date(year, 0, 1);
        const daysOffset = 8 - januaryFirst.getDay();
        const firstWeekStartDate = new Date(year, 0, daysOffset);
        const startDate = new Date(firstWeekStartDate.getTime() + (week - 1) * 7 * 24 * 60 * 60 * 1000);
        return startDate;
    }

    // Function to update the header dates
    function updateHeaderDates(startDate) {
        const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        for (let i = 0; i < 7; i++) {
            const day = startDate.getDate();
            const month = startDate.getMonth() + 1;
            const year = startDate.getFullYear();
            const formattedDate = `${day}/${month}/${year}`;
            const dayElement = document.querySelector(`.innerItem.day${i + 1}`);
            dayElement.textContent = `${daysOfWeek[startDate.getDay()]} ${formattedDate}`;
            startDate.setDate(startDate.getDate() + 1);
        }
    }
    const availableSlot1 = [{
            day: 1,
            slots: [1, 2, 4]
        },
        {
            day: 2,
            slots: [2]
        },
        {
            day: 3,
            slots: [1]
        },
        {
            day: 4,
            slots: []
        },
        {
            day: 5,
            slots: [3]
        },
        {
            day: 6,
            slots: [4]
        },
        {
            day: 7,
            slots: [1, 4]
        },
    ];
    const availableSlot2 = [{
            day: 1,
            slots: [1, 3]
        },
        {
            day: 2,
            slots: [3, 4]
        },
        {
            day: 3,
            slots: [2, 3, 4]
        },
        {
            day: 4,
            slots: [1]
        },
        {
            day: 5,
            slots: []
        },
        {
            day: 6,
            slots: []
        },
        {
            day: 7,
            slots: [1, 2, 4]
        },
    ];

    function updateAvailability(startDate, availableSlots) {
        const slots = document.querySelectorAll(".slot");
        //resetting the colors
        slots.forEach(slot => {
            const days = slot.querySelectorAll(".day");
            var color = true;
            days.forEach(day => {
                if (color == true)
                    day.style.backgroundColor = "#BEBEBE";
                else
                    day.style.backgroundColor = "";
                color = !color;
            });
        });

        for (let i = 1; i <= 7; i++) {
            const dayslots = availableSlots.find(day => day.day === i);
            if (dayslots) {
                dayslots.slots.forEach(slot => {
                    const slotElement = slots[slot - 1].querySelector(`.day${i}`);
                    if (slotElement) {
                        slotElement.style.backgroundColor = "#0B5460";
                    }
                });
            }
        }
    }
</script>

</html>