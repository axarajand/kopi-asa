<div class="modal fade" id="create-plantation-modal" tabindex="-1" aria-labelledby="createPlantationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPlantationModalLabel">Tambah Data Kebun Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.plantations.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label">Petani Pemilik</label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih dari daftar petani --</option>
                                @foreach (App\Models\User::where('role', 'farmer')->orderBy('name')->get() as $farmer)
                                    <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Kebun</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Contoh: Kebun Warisan Blok A" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="province_id" class="form-label">Provinsi</label>
                            <select id="province-dropdown" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Provinsi --</option>
                            </select>
                            <input type="hidden" name="province" id="province_name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city_id" class="form-label">Kabupaten/Kota</label>
                            <select id="city-dropdown" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Kabupaten/Kota --</option>
                            </select>
                            <input type="hidden" name="city" id="city_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="district_id" class="form-label">Kecamatan</label>
                            <select id="district-dropdown" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Kecamatan --</option>
                            </select>
                            <input type="hidden" name="district" id="district_name">
                        </div>
                         <div class="col-md-6 mb-3">
                            <label for="village_id" class="form-label">Desa/Kelurahan</label>
                            <select id="village-dropdown" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Desa --</option>
                            </select>
                             <input type="hidden" name="village" id="village_name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tentukan Lokasi Tepat di Peta</label>
                        <div id="map" style="height: 300px; border-radius: 8px;"></div>
                    </div>
                    <input type="hidden" id="latitude" name="latitude" class="form-control" readonly>
                    <input type="hidden" id="longitude" name="longitude" class="form-control" readonly>
                    <div class="mb-3">
                        <label for="address_detail" class="form-label">Detail Alamat (Opsional)</label>
                        <textarea name="address_detail" id="address_detail" rows="2" class="form-control"></textarea>
                    </div>
                     <div class="mb-3">
                        <label for="postal_code" class="form-label">Kode Pos</label>
                        <input type="text" id="postal_code" name="postal_code" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Kebun</button>
                </div>
            </form>
        </div>
    </div>
</div>