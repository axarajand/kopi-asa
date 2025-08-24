<div class="modal fade" id="manual-soil-modal" tabindex="-1" aria-labelledby="manualSoilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualSoilModalLabel">Isi Data Tanah Manual untuk Kebun: <span id="plantation-name-span" class="fw-bold"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="manual-soil-form" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="soil_ph" class="form-label">pH Tanah</label>
                            <input type="number" step="0.1" name="soil_ph" class="form-control" placeholder="Contoh: 5.8">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="soil_texture" class="form-label">Tekstur Tanah</label>
                            <select name="soil_texture" id="soil_texture" class="form-select">
                                <option value="" selected>-- Pilih Tekstur --</option>
                                <option value="Pasir">Pasir</option>
                                <option value="Lempung Berpasir">Lempung Berpasir</option>
                                <option value="Lempung (Seimbang)">Lempung (Seimbang)</option>
                                <option value="Lempung Berliat">Lempung Berliat</option>
                                <option value="Liat">Liat</option>
                                <option value="Debu">Debu</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="organic_matter" class="form-label">Bahan Organik</label>
                            <select name="organic_matter" id="organic_matter" class="form-select">
                                <option value="" selected>-- Pilih Kadar --</option>
                                <option value="Sangat Rendah">Sangat Rendah (&lt; 1%)</option>
                                <option value="Rendah">Rendah (1–2%)</option>
                                <option value="Sedang">Sedang (2–4%)</option>
                                <option value="Tinggi">Tinggi (4–8%)</option>
                                <option value="Sangat Tinggi">Sangat Tinggi (&gt; 8%)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="drainage" class="form-label">Drainase</label>
                            <select name="drainage" id="drainage" class="form-select">
                                <option value="" selected>-- Pilih Jenis --</option>
                                <option value="Sangat Cepat">Sangat Cepat (Gembur)</option>
                                <option value="Baik">Baik (Normal)</option>
                                <option value="Agak Terhambat">Agak Terhambat</option>
                                <option value="Buruk">Buruk (Sering Tergenang)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Tanah</button>
                </div>
            </form>
        </div>
    </div>
</div>