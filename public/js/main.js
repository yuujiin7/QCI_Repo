// Toggle Password Visibility
function togglePasswordVisibility(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field) {
        console.error(`Element with id '${fieldId}' not found.`);
        return;
    }
    field.type = (field.type === "password") ? "text" : "password";
}


document.addEventListener('DOMContentLoaded', function() {
    $('#TSGTable').DataTable({
        responsive: true,
        paging: true,
        searching: true,
        info: true,
        ordering: true,
        autoWidth: true,
        lengthChange: true,
        pageLength: 10,
        order: [[0, "asc"]],
        retrieve: true,
        
    });
});

document.addEventListener('DOMContentLoaded', function() {
    $('#SRTable').DataTable({
        responsive: true,
        paging: true,
        searching: true,
        info: true,
        ordering: true,
        autoWidth: true,
        lengthChange: true,
        pageLength: 10,
        order: [[0, "asc"]],
        retrieve: true,
        columnDefs: [
            {
                targets: [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
                visible: false,        
            }
            

        ],
        
    });
});

// Delete confirmation dialog
document.getElementById('submitDelete').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with form submission
            document.getElementById('deleteForm').submit(); // Replace 'yourFormId' with your form's ID
        }
    });
});

//Under Construction dialog
document.getElementById('underConstruction').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission
    Swal.fire({
        title: "Under Construction",
        text: "This feature is under construction!",
        icon: "info",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
    });
}
);


// change the "complete" to "incomplete" toggle
function toggleCompleteStatus() {
    var statusText = document.getElementById("status-text");

    
    var isCompleteCheckbox = document.getElementById("is_complete");

    if (isCompleteCheckbox.checked) {
        statusText.textContent = "Complete";
        // change the value of the checkbox to true or 1
        isCompleteCheckbox.value = true;
        isCompleteCheckbox.checked = true;
    }
    else {
        statusText.textContent = "Incomplete";
        // change the value of the checkbox to false or 0
        isCompleteCheckbox.value = false;
        isCompleteCheckbox.checked = false;
    }


}


// get the total hours from the start and end time from the form and change the total hours text
document.addEventListener('DOMContentLoaded', function() {
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    const totalHoursLabel = document.getElementById('total_hours');
    const startTimeError = document.getElementById('start_time_error');
    const endTimeError = document.getElementById('end_time_error');
    const totalHoursError = document.getElementById('total_hours_error');

    const checkbox = document.querySelector('input[name="is_complete"]');

    // Event listeners for start_time and end_time inputs
    startTimeInput.addEventListener('change', updateTotalHours);
    endTimeInput.addEventListener('change', updateTotalHours);

    // Function to calculate and update total hours
    function updateTotalHours() {
        const startTime = startTimeInput.value;
        const endTime = endTimeInput.value;

        console.log('Start Time:', startTime); // Debugging log
        console.log('End Time:', endTime); // Debugging log

        // Clear previous errors
        clearErrors();

        // Validate start and end times
        if (!startTime || !endTime) {
            displayError(startTimeError, "Please enter both start and end times.");
            totalHoursLabel.textContent = '0.00';
            return;
        }

        const start = parseTime(startTime);
        const end = parseTime(endTime);
        let difference = (end - start) / 1000 / 60 / 60;

        console.log('Start Date Object:', start); // Debugging log
        console.log('End Date Object:', end); // Debugging log
        console.log('Difference:', difference); // Debugging log

        // Handle cases where end time is on the next day
        if (difference < 0) {
            difference = 24 + difference;
        }

        // Update total_hours label text content
        totalHoursLabel.textContent = difference.toFixed(2);
    }

    // Function to parse time in HH:MM format and return a Date object
    function parseTime(time) {
        const [hours, minutes] = time.split(':').map(Number);
        const date = new Date();
        date.setHours(hours, minutes, 0, 0);
        return date;
    }

    // Function to display error message
    function displayError(element, message) {
        element.textContent = message;
        element.style.display = 'block';
    }

    // Function to clear errors
    function clearErrors() {
        startTimeError.style.display = 'none';
        endTimeError.style.display = 'none';
        totalHoursError.style.display = 'none';
    }

});
