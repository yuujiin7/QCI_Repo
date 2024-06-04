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

// document.addEventListener("DOMContentLoaded", function () {
//     const mainCheckbox = document.getElementById('checkbox-all-search');
//     const checkboxes = document.querySelectorAll('.checkbox-table-search');

//     mainCheckbox.addEventListener('change', function () {
//         checkboxes.forEach(function (checkbox) {
//             checkbox.checked = mainCheckbox.checked;
//         });
//     });
// });

// // Function to delete a user
// function deleteUser(userId) {
//     if (confirm("Are you sure you want to delete this user?")) {
//         fetch('/service-report/' + userId, {
//             method: 'DELETE',
//             headers: {
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
//             }
//         })
//         .then(response => {
//             if (response.ok) {
//                 // User deleted successfully, perform any necessary UI update
//                 console.log("User deleted successfully");
//             } else {
//                 // An error occurred while deleting the user
//                 console.error("Error deleting user");
//             }
//         })
//         .catch(error => {
//             console.error("Error deleting user:", error);
//         });
//     }
// }

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


