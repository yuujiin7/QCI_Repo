


function togglePasswordVisibility(fieldId) {
    var field = document.getElementById(fieldId);
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
};


// DataTables CDN
$(document).ready(function () {
    $('#TSGTable').DataTable({
        "order": [[0, "desc"]],
        "pageLength": 25,
        processing: true,
        serverSide: true,
        ajax: {
            url: "/tsg/data", // Ensure the route is correctly set
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'email', name: 'email' },
            { data: 'phone_number', name: 'phone_number' }
        ]
    });
});
