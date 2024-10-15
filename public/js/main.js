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
                searching: true,
                searchable: true,

            },
            {
                targets: [0, -1], // The last column (Actions column)
                orderable: false // Disable sorting on this column
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
// function format(d) {
//     let dateHistory = [];

//     // Check if date_history is a string and parse it
//     if (typeof d.date_history === 'string') {
//         try {
//             const parsedDateHistory = JSON.parse(d.date_history);
//             if (Array.isArray(parsedDateHistory)) {
//                 dateHistory = parsedDateHistory.map((range, index) =>
//                     `${index + 1}. ${range.start_date} to ${range.end_date}`
//                 );
//             } else {
//                 dateHistory = ['N/A']; // Fallback if parsed result is not an array
//             }
//         } catch (error) {
//             console.error('Error parsing date_history:', error);
//             dateHistory = ['N/A']; // Fallback in case of JSON parsing error
//         }
//     } else {
//         dateHistory = ['N/A']; // Fallback if date_history is not a string
//     }

//     console.log('Date History Type:', typeof d.date_history);
//     console.log('Date History Value:', d.date_history);

//     return `
//         <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
//             <div class="space-y-2">
//                 <strong class="font-bold">Serial Number:</strong> ${d.serial_number}<br>
//                 <strong class="font-bold">Account Manager:</strong> ${d.account_manager}<br>
//                 <strong class="font-bold">Start Date:</strong> ${d.start_date}<br>
//                 <strong class="font-bold">End Date:</strong> ${d.end_date}<br>
//                 <strong class="font-bold">Distributor:</strong> ${d.distributor}<br>
//                 <strong class="font-bold">PO Number:</strong> ${d.PO_number}<br>
//                 <strong class="font-bold">Company Name:</strong> ${d.company_name}<br>
//                 <strong class="font-bold">Project Name:</strong> ${d.project_name}<br>
//                 <strong class="font-bold">Supplementary Account Ref:</strong> ${d.supp_acc_ref}<br>
//                 <strong class="font-bold">Service Agreement:</strong> ${d.service_agreement}<br>
//             </div>
//             <div class="space-y-2">
//                 <strong class="font-bold">Model Description:</strong> ${d.model_description}<br>
//                 <strong class="font-bold">Product Number:</strong> ${d.product_number}<br>
//                 <strong class="font-bold">Service Level:</strong> ${d.service_level}<br>
//                 <strong class="font-bold">Location:</strong> ${d.location}<br>
//                 <strong class="font-bold">Date History:</strong><br>
//                 <div class="">
//                     ${dateHistory.join('<br>')}<br>
//                 </div>
//                 <strong class="font-bold">Status:</strong> ${d.status}<br>
//             </div>
//         </div>
//     `;
// }

// $(document).ready(function () {
//     const table = $('#MATable').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: "/get-maintenance-agreements",
//         columns: [

//             {
//                 data: null,
//                 orderable: false,
//                 render: function (data, type, row) {
//                     return `<input type="checkbox" class="record-checkbox" data-id="${row.id}"> `;
//                 }
//             },
//             {
//                 className: 'dt-control',
//                 orderable: false,
//                 data: null,
//                 responsive: true,
//                 defaultContent: ''
//             },
//             { data: 'serial_number', orderable: true },
//             { data: 'account_manager', orderable: true },
//             { data: 'start_date', orderable: true },
//             { data: 'end_date', orderable: true },
//             { data: 'status', orderable: true },
//             {
//                 data: null,
//                 orderable: false,
//                 render: function (data, type, row) {
//                     return `
//                         <button class="renew-btn bg-yellow-500 text-white px-2 py-2 rounded">Renew</button>
//                         <button class="delete-btn bg-red-500 text-white px-2 py-2 rounded submitDelete" data-form-id="delete-form-${row.id}">Delete</button>
//                         <form id="delete-form-${row.id}" action="/ma-report/${row.id}" method="POST" style="display:none;">
//                             <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
//                             <input type="hidden" name="_method" value="DELETE">
//                         </form>
//                     `;
//                 }
//             }
//         ],        
//         order: [[1, 'asc']], // Default ordering by the 'serial_number' column
//         responsive: true


        
//     });
//     $.fn.dataTable.ext.errMode = 'throw'; // Show errors in console

// $('#MATable').on('order.dt', function () {
//     console.log('Table order changed');
// });

//     const detailRows = [];

//     $('#MATable tbody').on('click', 'td.dt-control', function () {
//         var tr = $(this).closest('tr');
//         var row = table.row(tr);
//         var idx = $.inArray(tr.attr('id'), detailRows);

//         if (row.child.isShown()) {
//             tr.removeClass('details');
//             row.child.hide();
//             detailRows.splice(idx, 1);
//         } else {
//             tr.addClass('details');
//             row.child(format(row.data())).show();

//             if (idx === -1) {
//                 detailRows.push(tr.attr('id'));
//             }
//         }
//     });

//     table.on('draw', function () {
//         $.each(detailRows, function (i, id) {
//             $('#' + id + ' td.dt-control').trigger('click');
//         });
//     });

//     // Renew button event
//     $('#MATable tbody').on('click', '.renew-btn', function () {
//         var data = table.row($(this).parents('tr')).data();

//         // Pre-fill the modal fields with the current start and end dates
//         $('#start_date').val(data.start_date);
//         $('#end_date').val(data.end_date);

//         // Update the form action to send a PATCH request to update the agreement
//         $('#renewForm').attr('action', `/renew-maintenance-agreement/${data.id}`);

//         // Show the modal
//         var renewModal = new bootstrap.Modal(document.getElementById('renewModal'));
//         renewModal.show();
//     });


// // Delete confirmation dialog using event delegation
// document.addEventListener('click', function (event) {
//     if (event.target.classList.contains('submitDelete')) {
//         event.preventDefault(); // Prevent default form submission

//         // Get the form ID from the data attribute
//         const formId = event.target.getAttribute('data-form-id');
//         const form = document.getElementById(formId);

//         if (!form) {
//             console.error('Form not found:', formId);
//             return;
//         }

//         // Show the SweetAlert confirmation dialog
//         Swal.fire({
//             title: "Are you sure?",
//             text: "You won't be able to revert this!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             confirmButtonText: "Yes, delete it!"
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 console.log('Form ID:', formId);
//                 form.submit(); // Submit the associated form
//             }
//         });
//     }
// });




// });