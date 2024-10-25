// Toggle Password Visibility
function togglePasswordVisibility(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field) {
        console.error(`Element with id '${fieldId}' not found.`);
        return;
    }
    field.type = (field.type === "password") ? "text" : "password";
}

document.addEventListener('DOMContentLoaded', function () {
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



document.addEventListener('DOMContentLoaded', function () {
    const table = $('#SRTable').DataTable({
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
                searchable: true, // Allow the hidden columns to be searchable
                targets: [6, 7, 8, 9, 11, 12, 13, 14, 15, 16],
                visible: false, // Hide the columns
                
            },
            {
                targets: [0, -1], // The first and the last column (Actions column)
                orderable: false // Disable sorting on these columns
            }
        ],
    });

    
    
});

// Delete confirmation dialog
// JavaScript
document.querySelectorAll('.submitDelete').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default form submission
        const formId = this.getAttribute('data-form-id');
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
                document.getElementById(formId).submit(); // Submit the associated form
            }
        });
    });
});




//Under Construction dialog
// document.getElementById('underConstruction').addEventListener('click', function(event) {
//     event.preventDefault(); // Prevent default form submission
//     Swal.fire({
//         title: "Under Construction",
//         text: "This feature is under construction!",
//         icon: "info",
//         confirmButtonColor: "#3085d6",
//         confirmButtonText: "OK"
//     });
// }
// )

function toggleCompleteStatus() {
    let checkbox = document.getElementById('is_complete');
    // Set the value based on the checked state
    checkbox.value = checkbox.checked ? '1' : '0';
    let statusText = document.getElementById('status-text');
    // Change the text based on the checked state
    statusText.textContent = checkbox.checked ? 'Complete' : 'Incomplete';
}




// Initialize the checkbox to be unchecked and the status text to be "Incomplete"
document.addEventListener('DOMContentLoaded', (event) => {
    let checkbox = document.getElementById('is_complete');
    checkbox.checked = false; // Ensures it is unchecked by default
    checkbox.value = '0'; // Default value for unchecked state
});

// get the total hours from the start and end time from the form and change the total hours text
document.addEventListener('DOMContentLoaded', function () {
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

// ---------------------------------------------------------------------------------------------------------
