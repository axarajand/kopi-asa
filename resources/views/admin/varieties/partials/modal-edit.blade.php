<div class="modal fade" id="edit-variety-modal" tabindex="-1" aria-labelledby="editVarietyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVarietyModalLabel">Edit Varietas Kopi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-variety-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nama Varietas</label>
                        <input type="text" id="edit-name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-species" class="form-label">Spesies</label>
                        <select class="form-select" id="edit-species" name="species" required>
                            <option value="Arabika">Arabika</option>
                            <option value="Robusta">Robusta</option>
                            <option value="Liberika">Liberika</option>
                            <option value="Excelsa">Excelsa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-notes" class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control" id="edit-notes" name="notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>