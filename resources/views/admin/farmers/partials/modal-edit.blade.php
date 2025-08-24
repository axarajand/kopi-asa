<div class="modal fade" id="edit-farmer-modal" tabindex="-1" aria-labelledby="editFarmerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFarmerModalLabel">Edit Akun Petani</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-farmer-form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nama Lengkap</label>
                        <input type="text" id="edit-name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Alamat Email</label>
                        <input type="email" id="edit-email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-password" class="form-label">Password Baru (Opsional)</label>
                        <input type="password" id="edit-password" name="password" class="form-control">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    </div>
                    <div class="mb-3">
                        <label for="edit-avatar" class="form-label">Ganti Foto Profil (Avatar)</label>
                        <input class="form-control" type="file" id="edit-avatar" name="avatar">
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