<div class="modal fade" id="create-region-modal" tabindex="-1" aria-labelledby="createRegionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRegionModalLabel">Tambah Daerah Kopi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.regions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Daerah</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Contoh: Gayo, Kintamani" required>
                    </div>

                    <div class="mb-3">
                        <label for="province" class="form-label">Provinsi (Opsional)</label>
                        <input type="text" id="province" name="province" class="form-control" placeholder="Contoh: Aceh">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Singkat (Opsional)</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Contoh: Terkenal dengan karakter rasa fruity..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Daerah</button>
                </div>
            </form>
        </div>
    </div>
</div>