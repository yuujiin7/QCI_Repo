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


// change the "complete" to "incomplete" toggle
function toggleCompleteStatus() {
    var statusText = document.getElementById("status-text");
    if (statusText.textContent === "Complete") {
        statusText.textContent = "Incomplete";
    } else {
        statusText.textContent = "Complete";
    }
    
}


// get the total hours from the start and end time from the form and change the total hours text
document.addEventListener('DOMContentLoaded', function() {
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    const totalHoursInput = document.getElementById('total_hours');
    const startTimeError = document.getElementById('start_time_error');
    const endTimeError = document.getElementById('end_time_error');
    const totalHoursError = document.getElementById('total_hours_error');

    var checkbox = document.querySelector('input[name="is_complete"]');
    var statusText = document.getElementById('status-text');
    // Event listener for start_time input
    startTimeInput.addEventListener('input', updateTotalHours);
    // Event listener for end_time input
    endTimeInput.addEventListener('input', updateTotalHours);

    // Function to calculate and update total hours
    function updateTotalHours() {
        const startTime = startTimeInput.value;
        const endTime = endTimeInput.value;

        console.log('Start Time:', startTime);
        console.log('End Time:', endTime);

        // Validate start and end times
        if (!startTime || !endTime) {
            displayError(startTimeError, "Please enter both start and end times.");
            totalHoursInput.value = '';
            totalHoursInput.placeholder = '0.00';
            return;
        }

        const start = new Date('1970-01-01T' + startTime + 'Z');
        const end = new Date('1970-01-01T' + endTime + 'Z');
        let difference = (end - start) / 1000 / 60 / 60;

        // Handle cases where end time is on the next day
        if (difference < 0) {
            difference = 24 + difference;
        }

        // Update total_hours input value and placeholder
        totalHoursInput.value = difference.toFixed(2);
        totalHoursInput.placeholder = difference.toFixed(2);

        // Clear any previous errors
        clearErrors();
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

    if (checkbox.checked) {
        statusText.textContent = 'Complete';
    } else {
        statusText.textContent = 'Incomplete';
    }
});
