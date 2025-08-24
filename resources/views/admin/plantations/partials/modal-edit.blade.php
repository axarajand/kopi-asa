<div class="modal fade" id="edit-plantation-modal" tabindex="-1" aria-labelledby="editPlantationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPlantationModalLabel">Edit Data Kebun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-plantation-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="alert alert-info">
                        <strong>Catatan:</strong> Data Provinsi, Kabupaten, Kecamatan, dan Desa tidak bisa diubah di sini. Silakan buat entri baru jika ada perubahan lokasi.
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_user_id" class="form-label">Petani Pemilik</label>
                            <select name="user_id" id="edit_user_id" class="form-select" required>
                                @foreach (App\Models\User::where('role', 'farmer')->orderBy('name')->get() as $farmer)
                                    <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_name" class="form-label">Nama Kebun</label>
                            <input type="text" id="edit_name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_address_detail" class="form-label">Detail Alamat (Opsional)</label>
                        <textarea name="address_detail" id="edit_address_detail" rows="2" class="form-control"></textarea>
                    </div>
                     <div class="mb-3">
                        <label for="edit_postal_code" class="form-label">Kode Pos</label>
                        <input type="text" id="edit_postal_code" name="postal_code" class="form-control" required>
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