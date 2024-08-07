
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
// JavaScript
document.querySelectorAll('.submitDelete').forEach(button => {
    button.addEventListener('click', function(event) {
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
// );

function toggleCompleteStatus() {
    let checkbox = document.getElementById('is_complete');
    checkbox.value = checkbox.checked ? '1' : '0';
    let statusText = document.getElementById('status-text');
    statusText.textContent = checkbox.checked ? 'Complete' : 'Incomplete';
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


// ---------------------------------------------------------------------------------------------------------
function format(d) {
    return (
        'Serial Number: ' + d.serial_number +
        '<br>' +
        'Account Manager: ' + d.account_manager +
        '<br>' +
        'Start Date: ' + d.start_date +
        '<br>' +
        'End Date: ' + d.end_date +
        '<br>' +
        'Distributor: ' + d.distributor +
        '<br>' +
        'PO Number: ' + d.PO_number +
        '<br>' +
        'Company Name: ' + d.company_name +
        '<br>' +
        'Project Name: ' + d.project_name +
        '<br>' +
        'Supplementary Account Ref: ' + d.supp_acc_ref +
        '<br>' +
        'Service Agreement: ' + d.service_agreement +
        '<br>' +
        'Model Description: ' + d.model_description +
        '<br>' +
        'Product Number: ' + d.product_number +
        '<br>' +
        'Service Level: ' + d.service_level +
        '<br>' +
        'Location: ' + d.location +
        '<br>' +
        'Status: ' + d.status
    );
}
$(document).ready(function() {
    const table = $('#MATable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/get-maintenance-agreements"
        ,
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: ''
            },
            { data: 'serial_number' },
            { data: 'account_manager' },
            { data: 'start_date' },
            { data: 'end_date' },
            { data: 'status' },
            {
                data: null,
                orderable: false,
                render: function(data, type, row) {
                    return `
                        <button class="edit-btn bg-yellow-500 text-white px-4 py-2 rounded">Edit</button>
                        <button class="delete-btn bg-red-500 text-white px-4 py-2 rounded submitDelete" data-form-id="delete-form-${row.id}">Delete</button>
                        <form id="delete-form-${row.id}" action="/delete-maintenance-agreement/${row.id}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    `;
                }
            }
        ],
        order: [[1, 'asc']]

        
    });
    
    const detailRows = [];
    
    $('#MATable tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var idx = $.inArray(tr.attr('id'), detailRows);

        if (row.child.isShown()) {
            tr.removeClass('details');
            row.child.hide();
            detailRows.splice(idx, 1);
        } else {
            tr.addClass('details');
            row.child(format(row.data())).show();

            if (idx === -1) {
                detailRows.push(tr.attr('id'));
            }
        }
    });

    table.on('draw', function () {
        $.each(detailRows, function (i, id) {
            $('#' + id + ' td.dt-control').trigger('click');
        });
    });
});

$('#MATable tbody').on('click', '.edit-btn', function () {
    var data = table.row($(this).parents('tr')).data();
    // Open your edit modal and populate it with `data`
    console.log('Edit:', data);
});


$('#MATable tbody').on('click', '.submitDelete', function(event) {
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
// ---------------------------------------------------------------------------------------------------------