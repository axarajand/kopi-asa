<div class="modal fade" id="edit-region-modal" tabindex="-1" aria-labelledby="editRegionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRegionModalLabel">Edit Daerah Kopi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-region-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nama Daerah</label>
                        <input type="text" id="edit-name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-province" class="form-label">Provinsi (Opsional)</label>
                        <input type="text" id="edit-province" name="province" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Deskripsi Singkat (Opsional)</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3"></textarea>
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