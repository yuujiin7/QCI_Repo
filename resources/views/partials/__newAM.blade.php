<div class="modal fade" id="newAMModal" tabindex="-1" aria-labelledby="newAMModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="newAMForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="newAMModalLabel">New Account Manager</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="account_manager" class="form-label">New Account Manager</label>
                        <input type="text" class="form-control" id="account_manager" name="account_manager" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
