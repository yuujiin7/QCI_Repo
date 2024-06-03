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
        
    });
});