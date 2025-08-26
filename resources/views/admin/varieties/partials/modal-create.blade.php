<div class="modal fade" id="create-variety-modal" tabindex="-1" aria-labelledby="createVarietyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVarietyModalLabel">Tambah Varietas Kopi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.varieties.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Varietas</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Contoh: Typica" required>
                    </div>
                    <div class="mb-3">
                        <label for="species" class="form-label">Spesies</label>
                        <select class="form-select" id="species" name="species" required>
                            <option value="" selected disabled>-- Pilih Spesies --</option>
                            <option value="Arabika">Arabika</option>
                            <option value="Robusta">Robusta</option>
                            <option value="Liberika">Liberika</option>
                            <option value="Excelsa">Excelsa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Contoh: Varietas dari Puslitkoka Jember, adaptif di dataran tinggi, rentan terhadap nematoda."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Varietas</button>
                </div>
            </form>
        </div>
    </div>
</div>