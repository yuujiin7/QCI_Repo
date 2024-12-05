@include('partials.__header')
@include('partials.__renew')
@include('partials.__import')
@include('partials.__newAM')

<?php
$array = array('name' => "Service Report List");
?>

<x-nav />
<section>
    <div class="p-10 sm:ml-64">
        <main class="bg-white max-w-full mx-auto p-8 my-10 rounded-lg shadow-2xl">
            <div class="container mx-auto">
                <div class="flex items-center mb-6 justify-end space-x-4">
                    <!-- Import CSV Button -->
                    <button id="importButton" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Import MA
                    </button>
                    <!-- Generate CSV Button -->
                    <button id="exportCsv" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Export to CSV
                    </button>
                    <!-- Create New Maintenance Agreement Button -->
                    <a href="/create/ma-report" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Create New
                    </a>
                    <button id="deleteSelected" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" disabled>Delete Selected</button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden display" id="MATable">
                        <thead class="bg-gray-800 text-white text-xs uppercase">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th scope="col" class="py-3 px-6"> </th>
                                <th scope="col" class="py-3 px-6">Serial Number</th>
                                <th scope="col" class="py-3 px-6">Customer Name</th>
                                <th scope="col" class="py-3 px-6">Account Manager</th>
                                <th scope="col" class="py-3 px-6">Coverage From</th>
                                <th scope="col" class="py-3 px-6">Coverage To</th>
                                <th scope="col" class="py-3 px-6">Status</th>
                                <th scope="col" class="py-3 px-6">Service History</th>
                                <th scope="col" class="py-3 px-6">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </main>
    </div>
</section>
<div id="loadingIndicator" style="display:none;">Loading...</div>

@include('partials.__footer')

<script>
    // Import button function
    const importButton = document.getElementById('importButton');
    importButton.addEventListener('click', function() {
        document.getElementById('importModal').classList.remove('hidden');
    });

    // Close button function
    const closeModal = document.getElementById('closeModal');
    closeModal.addEventListener('click', function() {
        document.getElementById('importModal').classList.add('hidden');
    });

    // Cancel button function
    const cancelButton = document.getElementById('cancelButton');
    cancelButton.addEventListener('click', function() {
        document.getElementById('importModal').classList.add('hidden');
    });


    //export button function
    const exportCsv = document.getElementById('exportCsv');
    exportCsv.addEventListener('click', function() {
        window.location.href = '/export-maintenance-agreements';
    });

    function format(d) {
        let dateHistory = [];

        // Check if date_history is a string and parse it
        if (typeof d.date_history === 'string') {
            try {
                const parsedDateHistory = JSON.parse(d.date_history);
                console.log(parsedDateHistory);
                if (typeof parsedDateHistory === 'object') {
                    const coverageStart = parsedDateHistory.coverage_start || 'N/A';
                    const coverageEnd = parsedDateHistory.coverage_end || 'N/A';

                    dateHistory.push(`Original Period: ${coverageStart} to ${coverageEnd}`);

                    // Iterate through each entry in the date history
                    for (const [key, range] of Object.entries(parsedDateHistory)) {
                        if (key !== 'coverage_start' && key !== 'coverage_end') {
                            number = parseInt(key) + 1;
                            dateHistory.push(`${number}. ${range.start_date} to ${range.end_date}`);
                        }
                    }
                } else {
                    dateHistory = ['N/A']; // Fallback if parsed result is not an object
                }
            } catch (error) {
                console.error('Error parsing date_history:', error);
                dateHistory = ['N/A']; // Fallback in case of JSON parsing error
            }
        } else {
            dateHistory = ['N/A']; // Fallback if date_history is not a string
        }


        let account_manager_history = [];

        // Check if account_manager_history is a string and parse it
        if (typeof d.account_manager_history === 'string') {
            try {
                const parsedAccountManagerHistory = JSON.parse(d.account_manager_history);
                console.log(parsedAccountManagerHistory);

                if (Array.isArray(parsedAccountManagerHistory)) {
                    // Iterate through each object in the array
                    parsedAccountManagerHistory.forEach((entry, index) => {
                        // Assuming each entry has 'manager' and 'timestamp'
                        if (entry.manager && entry.timestamp) {
                            account_manager_history.push(`${index + 1}: ${entry.manager}`);
                        }
                    });
                } else {
                    account_manager_history = ['N/A']; // Fallback if parsed result is not an array
                }
            } catch (error) {
                console.error('Error parsing account_manager_history:', error);
                account_manager_history = ['N/A']; // Fallback in case of JSON parsing error
            }
        } else {
            account_manager_history = ['N/A']; // Fallback if account_manager_history is not a string
        }




        return `
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
        <div class="space-y-2">
            <strong class="font-bold">Serial Number:</strong> ${d.serial_number}<br>
            <strong class="font-bold">Current Account Manager:</strong> ${d.account_manager}<br>
            <strong class="font-bold">Account Manager History:</strong><br>
            <div class="">
                ${account_manager_history.join('<br>')}<br>
            </div>
            <strong class="font-bold">Start Date:</strong> ${d.start_date}<br>
            <strong class="font-bold">End Date:</strong> ${d.end_date}<br>
            <strong class="font-bold">Distributor:</strong> ${d.distributor}<br>
            <strong class="font-bold">PO Number:</strong> ${d.PO_number}<br>
            <strong class="font-bold">Company Name:</strong> ${d.company_name}<br>
            <strong class="font-bold">Project Name:</strong> ${d.project_name}<br>
            <strong class="font-bold">Supplementary Account Ref:</strong> ${d.supp_acc_ref}<br>
            <strong class="font-bold">Service Agreement:</strong> ${d.service_agreement}<br>
        </div>
        <div class="space-y-2">
            <strong class="font-bold">Model Description:</strong> ${d.model_description}<br>
            <strong class="font-bold">Product Number:</strong> ${d.product_number}<br>
            <strong class="font-bold">Service Level:</strong> ${d.service_level}<br>
            <strong class="font-bold">Location:</strong> ${d.location}<br>
            <strong class="font-bold">Date History:</strong><br>
            <div class="">
                ${dateHistory.join('<br>')}<br>
            </div>
            <strong class="font-bold">Status:</strong> ${d.status}<br>
            <strong class="font-bold">Service Reports:</strong><br>
            <a class="">
                ${d.service_reports.map(report => `<a href="/generate-pdf/${report.id}" target="_blank" class="text-blue-600 underline ">${report.sr_number}</a>`).join(', ')}<br>
            </a>
        </div>
    </div>
    `;
    }



    $(document).ready(function() {
        const table = $('#MATable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/get-maintenance-agreements",
            columns: [

                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `<input type="checkbox" class="record-checkbox" data-id="${row.id}"> `;
                    }
                },
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    responsive: true,
                    defaultContent: ''
                },
                {
                    data: 'serial_number',
                    orderable: true
                },
                {
                    data: 'company_name',
                    orderable: true
                },
                {
                    data: 'account_manager',
                    orderable: true
                },
                {
                    data: 'start_date',
                    orderable: true
                },
                {
                    data: 'end_date',
                    orderable: true
                },
                {
                    data: 'status',
                    orderable: true
                },

                {
                    data: 'service_reports',
                    orderable: false,
                    render: function(data, type, row) {
                        // Map the first three service report IDs to their sr_numbers
                        const serviceReportsLinks = data.slice(0, 3).map(report =>
                            `<a href="/generate-pdf/${report.id}" target="_blank" class="text-blue-600 underline ">${report.sr_number}</a>`
                        );
                        console.log('Service Report Numbers:', serviceReportsLinks);
                        return serviceReportsLinks.length > 0 ? serviceReportsLinks.join(', ') : 'No Service Reports';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                        <button class="renew-btn bg-yellow-500 text-white px-2 py-2 rounded">Renew</button>
                        <button class="new-am-btn bg-blue-700 text-white px-2 py-2 rounded">New AM</button>
                        
                    `;

                    }
                }
            ],
            order: [
                [1, 'asc']
            ], // Default ordering by the 'serial_number' column
            responsive: true
                        //<button class="delete-btn bg-red-500 text-white px-2 py-2 rounded submitDelete" data-form-id="delete-form-${row.id}">Delete</button>
                        // <form id="delete-form-${row.id}" action="/ma-report/${row.id}" method="POST" style="display:none;">
                        //     <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                        //     <input type="hidden" name="_method" value="DELETE">
                        // </form>


        });
        $.fn.dataTable.ext.errMode = 'throw'; // Show errors in console

        $('#MATable').on('order.dt', function() {
            console.log('Table order changed');
        });

        const detailRows = [];


        $('#MATable tbody').on('click', 'td.dt-control', function() {
            const tr = $(this).closest('tr');
            const row = table.row(tr);
            const idx = $.inArray(tr.attr('id'), detailRows);

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

        table.on('draw', function() {
            $.each(detailRows, function(i, id) {
                $('#' + id + ' td.dt-control').trigger('click');
            });
        });

        const selectAllCheckbox = document.getElementById('selectAll');
        const deleteSelectedButton = $('#deleteSelected');
        deleteSelectedButton.hide();

        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.record-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleDeleteButton();
        });

        $(document).on('change', '.record-checkbox', function() {
            const checkboxes = $('.record-checkbox');
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            } else {
                const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                selectAllCheckbox.checked = allChecked;
            }
            toggleDeleteButton();
        });

        function toggleDeleteButton() {
            const anyChecked = $('.record-checkbox:checked').length > 0;
            deleteSelectedButton.prop('disabled', !anyChecked);
            deleteSelectedButton.toggle(anyChecked);
        }

        $('#MATable tbody').on('click', '.renew-btn', function() {
            const data = table.row($(this).parents('tr')).data();
            $('#start_date').val(data.start_date);
            $('#end_date').val(data.end_date);
            $('#renewForm').attr('action', `/renew-maintenance-agreement/${data.id}`);
            const renewModal = new bootstrap.Modal(document.getElementById('renewModal'));
            renewModal.show();
        });

        //new am button
        $('#MATable tbody').on('click', '.new-am-btn', function() {
            const data = table.row($(this).parents('tr')).data();
            $('#account_manager').val(data.account_manager);
            $('#newAMForm').attr('action', `/new-am-maintenance-agreement/${data.id}`);
            const newAMModal = new bootstrap.Modal(document.getElementById('newAMModal'));
            newAMModal.show();
        });

        $(document).on('click', '.submitDelete', function(event) {
            event.preventDefault();
            const formId = $(this).data('form-id');
            const form = $('#' + formId)[0];

            if (!form) {
                console.error('Form not found:', formId);
                return;
            }

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
                    form.submit();
                }
            });
        });

        $('#deleteSelected').on('click', function() {
            // const selectedIds = $('.record-checkbox:checked').map(function() {
            //     return Number($(this).data('id')); // Ensure IDs are numbers
            // }).get();


            const selectedIds = $('.record-checkbox:checked').map(function() {
                return parseInt($(this).data('id')); // Convert IDs to integers
            }).get();

            console.log('Selected IDs:', selectedIds);

            if (selectedIds.length > 0) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete them!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Payload:', JSON.stringify({
                            ids: selectedIds,
                            _method: 'DELETE'
                        }));

                        console.log('Confirmed delete action');

                        loadingIndicator.style.display = 'block';

                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        // use route "/delete-all" to delete multiple records
                        $.ajax({
                            url: '/delete-all',
                            type: 'POST',
                            data: {
                                ids: selectedIds,
                                _token: csrfToken
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'The selected reports have been deleted.',
                                        'success'
                                    );
                                    window.location.reload();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(error) {
                                console.error('Error:', error);
                                console.log(error);
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the reports.',
                                    'error'
                                );
                            },
                            complete: function() {
                                loadingIndicator.style.display = 'none';
                                selectAllCheckbox.checked = false;
                                checkboxes.forEach(checkbox => checkbox.checked = false);
                                toggleDeleteButton();
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: "No selection",
                    text: "Please select at least one record to delete.",
                    icon: "info"
                });
            }
        });

    });
</script>