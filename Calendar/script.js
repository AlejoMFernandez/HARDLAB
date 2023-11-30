document.addEventListener("DOMContentLoaded", function () {
    const currentDateElement = document.getElementById("currentDate");
    const daysElement = document.getElementById("calendarDays");

    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    let currentDay = currentDate.getDate();

    const monthNames = [
        "Enero", "Febrero", "Marzo", "Abril",
        "Mayo", "Junio", "Julio", "Agosto",
        "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    function updateCalendar() {
        currentDate = new Date(currentYear, currentMonth, 1);
        currentDateElement.textContent = monthNames[currentMonth] + " " + currentYear;

        const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        daysElement.innerHTML = "";

        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyDay = document.createElement("div");
            const emptyDiv = emptyDay.createElement("a");
            emptyDiv.className = "day";
            daysElement.appendChild(emptyDiv);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const calendarDay = document.createElement("div");
            calendarDay.className = "day";
            calendarDay.textContent = day;

            if (day === currentDay) {
                calendarDay.classList.add("current-day");
            }

            daysElement.appendChild(calendarDay);
        }
    }

    updateCalendar();

    document.getElementById("prevMonth").addEventListener("click", function () {
        currentMonth--;
        if (currentMonth < 0) {
            currentYear--;
            currentMonth = 11;
        }
        updateCalendar();
    });

    document.getElementById("nextMonth").addEventListener("click", function () {
        currentMonth++;
        if (currentMonth > 11) {
            currentYear++;
            currentMonth = 0;
        }
        updateCalendar();
    });
});
