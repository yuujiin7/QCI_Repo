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