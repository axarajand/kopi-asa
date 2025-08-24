<div class="modal fade" id="manual-topography-modal" tabindex="-1" aria-labelledby="manualTopographyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualTopographyModalLabel">Isi Data Topografi Manual untuk Kebun: <span id="plantation-name-span-topography" class="fw-bold"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="manual-topography-form" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="altitude" class="form-label">Ketinggian (MDPL)</label>
                            <input type="number" name="altitude" class="form-control" placeholder="Contoh: 1200">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="slope_gradient" class="form-label">Kemiringan Lereng (derajat)</label>
                            <input type="number" step="0.1" name="slope_gradient" class="form-control" placeholder="Contoh: 15.5">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slope_aspect" class="form-label">Arah Lereng</label>
                            <select name="slope_aspect" class="form-select">
                                <option value="" selected>-- Pilih Arah --</option>
                                <option value="Utara">Utara</option>
                                <option value="Timur Laut">Timur Laut</option>
                                <option value="Timur">Timur</option>
                                <option value="Tenggara">Tenggara</option>
                                <option value="Selatan">Selatan</option>
                                <option value="Barat Daya">Barat Daya</option>
                                <option value="Barat">Barat</option>
                                <option value="Barat Laut">Barat Laut</option>
                                <option value="Datar">Datar</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Topografi</button>
                </div>
            </form>
        </div>
    </div>
</div>