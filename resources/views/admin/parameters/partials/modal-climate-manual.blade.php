<div class="modal fade" id="manual-climate-modal" tabindex="-1" aria-labelledby="manualClimateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualClimateModalLabel">Isi Data Iklim Manual untuk Kebun: <span id="plantation-name-span-climate" class="fw-bold"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="manual-climate-form" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="avg_temperature" class="form-label">Suhu Rata-rata (°C)</label>
                            <input type="number" step="0.1" name="avg_temperature" class="form-control" placeholder="Contoh: 25.5">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="avg_humidity" class="form-label">Kelembapan Rata-rata (%)</label>
                            <input type="number" step="1" name="avg_humidity" class="form-control" placeholder="Contoh: 80">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="yearly_precipitation" class="form-label">Curah Hujan Tahunan (mm)</label>
                        <input type="number" step="1" name="yearly_precipitation" class="form-control" placeholder="Contoh: 2200">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Iklim</button>
                </div>
            </form>
        </div>
    </div>
</div>