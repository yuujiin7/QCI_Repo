// Toggle Password Visibility
function togglePasswordVisibility(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field) {
        console.error(`Element with id '${fieldId}' not found.`);
        return;
    }
    field.type = (field.type === "password") ? "text" : "password";
}
document.ready(function () {
    const selectAllCheckbox = $('#selectAll');
    const checkboxes = $('.report-checkbox');
    const deleteButton = $('#deleteButton');

    // Select/Deselect all checkboxes and toggle delete button visibility
    selectAllCheckbox.change(function () {
        checkboxes.prop('checked', this.checked);
        toggleDeleteButton();
    });

    // Toggle delete button visibility based on individual checkbox changes
    checkboxes.change(toggleDeleteButton);

    // Function to toggle the visibility of the delete button
    function toggleDeleteButton() {
        const anyChecked = checkboxes.is(':checked');
        deleteButton.toggleClass('hidden', !anyChecked);
    }
});
