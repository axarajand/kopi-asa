@extends('layouts.admin')
@section('title', 'Prediksi Kualitas Kopi')

@section('content')
    <div class="py-3">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">Analisis</a></li>
            <li class="breadcrumb-item active">Prediksi Kualitas</li>
        </ol>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Prediksi Kualitas Kopi</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <form action="{{ route('admin.analysis.predict') }}" method="POST">
                        @csrf
                        <p class="text-muted">Pilih petani, lalu kebun, dan masukkan parameter panen untuk memulai prediksi.</p>
                        
                        <div class="mb-3">
                            <label for="farmer_id" class="form-label">Pilih Petani</label>
                            <select name="farmer_id" id="farmer-dropdown" class="form-select" required>
                                <option value="" selected disabled>-- Pilih dari daftar petani --</option>
                                @foreach ($farmers as $farmer)
                                    <option value="{{ $farmer->id }}" @if(isset($inputs) && $inputs['farmer_id'] == $farmer->id) selected @endif>
                                        {{ $farmer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="plantation_id" class="form-label">Pilih Kebun</label>
                            <select name="plantation_id" id="plantation-dropdown" class="form-select" required {{ isset($inputs['plantation_id']) ? '' : 'disabled' }}>
                                <option value="" selected disabled>-- Pilih petani terlebih dahulu --</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="variety_id" class="form-label">Varietas Kopi</label>
                            <select name="variety_id" id="variety_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih varietas yang dipanen --</option>
                                @foreach ($varieties as $variety)
                                    <option value="{{ $variety->id }}" @if(isset($inputs) && $inputs['variety_id'] == $variety->id) selected @endif>
                                        {{ $variety->name }} ({{ $variety->species }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="processing_method" class="form-label">Metode Proses</label>
                            <select name="processing_method" id="processing_method" class="form-select" required>
                                <option value="" selected disabled>-- Pilih metode pasca-panen --</option>
                                @php $methods = ['Washed / Wet', 'Natural / Dry', 'Pulped natural / Honey', 'Semi-Washed / Wet-Hulled']; @endphp
                                @foreach($methods as $method)
                                    <option value="{{ $method }}" @if(isset($inputs) && $inputs['processing_method'] == $method) selected @endif>{{ $method }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="moisture" class="form-label">Kadar Air (0.0 - 1.0)</label>
                                <input type="number" step="0.01" name="moisture" id="moisture" class="form-control" placeholder="Contoh: 0.11" value="{{ $inputs['moisture'] ?? '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="color" class="form-label">Warna Biji Mentah</label>
                                <select name="color" id="color" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Warna Biji --</option>
                                    @php
                                        $colors = [
                                            'Green' => 'Hijau (Green)',
                                            'Bluish-Green' => 'Hijau Kebiruan (Bluish-Green)',
                                            'Blue-Green' => 'Biru Kehijauan (Blue-Green)',
                                        ];
                                    @endphp
                                    @foreach($colors as $value => $label)
                                        <option value="{{ $value }}" @if(isset($inputs) && $inputs['color'] == $value) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Jalankan Prediksi
                        </button>
                    </form>
                </div>

                <div class="col-lg-6">
                    @if (isset($qualityResult) && isset($phResult))
                        <div class="text-center p-3 d-flex flex-column" style="border: 2px dashed #e0e0e0; border-radius: 8px; height: 100%;">
                            <h5 class="mb-3">Hasil Prediksi</h5>
                            
                            <div class="flex-grow-1">
                                <div class="card bg-light mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Prediksi pH Kopi</h6>
                                        @if($phResult !== 'Gagal')
                                            <h2 class="display-4 fw-bold {{ $phResult['color_class'] }}">{!! $phResult['range'] !!}</h2>
                                            <p class="fs-5 fw-medium">{{ $phResult['description'] }}</p>
                                            <p class="card-text mb-0">Berdasarkan Aturan Ilmiah</p>
                                        @else
                                            <h2 class="display-4 fw-bold text-danger">Gagal</h2>
                                            <p class="card-text mb-0">Proses prediksi gagal.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Prediksi Kualitas (Skor)</h6>
                                        @if($qualityResult['status'] !== 'Gagal')
                                            <h2 class="display-4 fw-bold {{ $qualityResult['color_class'] }}">{{ $qualityResult['score'] }}</h2>
                                            <p class="fs-5 fw-medium">{{ $qualityResult['description'] }}</p>
                                            <p class="card-text mb-0">Berdasarkan Skala SCA (0-100)</p>
                                        @else
                                            <h2 class="display-4 fw-bold text-danger">Gagal</h2>
                                            <p class="card-text mb-0">Panggilan ke model Python gagal.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($qualityResult['status'] !== 'Gagal')
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.analysis.history.store') }}" method="POST" class="w-100">
                                    @csrf
                                    <input type="hidden" name="plantation_id" value="{{ $inputs['plantation_id'] }}">
                                    <input type="hidden" name="variety_id" value="{{ $inputs['variety_id'] }}">
                                    <input type="hidden" name="processing_method" value="{{ $inputs['processing_method'] }}">
                                    <input type="hidden" name="moisture" value="{{ $inputs['moisture'] }}">
                                    <input type="hidden" name="color" value="{{ $inputs['color'] }}">
                                    <input type="hidden" name="predicted_ph_range" value="{{ $phResult['range'] }}">
                                    <input type="hidden" name="predicted_ph_desc" value="{{ $phResult['description'] }}">
                                    <input type="hidden" name="predicted_quality_score" value="{{ $qualityResult['score'] }}">
                                    <input type="hidden" name="predicted_quality_desc" value="{{ $qualityResult['description'] }}">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Simpan Hasil
                                    </button>
                                </form>
                                <a href="{{ route('admin.analysis.prediction') }}" class="btn btn-secondary w-100">
                                    Reset
                                </a>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center p-4 d-flex align-items-center justify-content-center" style="border: 2px dashed #e0e0e0; border-radius: 8px; height: 100%;">
                            <h5 class="text-muted">Hasil Prediksi Akan Muncul di Sini</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        
        var selectedFarmerId = "{{ $inputs['farmer_id'] ?? '' }}";
        var selectedPlantationId = "{{ $inputs['plantation_id'] ?? '' }}";

        function populatePlantations(farmerId, selectedId = null) {
            var plantationDropdown = $('#plantation-dropdown');
            
            plantationDropdown.empty().append('<option selected disabled>Memuat data kebun...</option>');
            plantationDropdown.prop('disabled', true);

            if (farmerId) {
                var url = "{{ route('admin.farmers.plantations', ':id') }}".replace(':id', farmerId);
                
                $.get(url, function(data) {
                    plantationDropdown.empty().append('<option selected disabled>-- Pilih Kebun --</option>');
                    if (data.length > 0) {
                        $.each(data, function(key, plantation) {
                            var option = $('<option>', {
                                value: plantation.id,
                                text: plantation.name
                            });

                            
                            if (plantation.id == selectedId) {
                                option.attr('selected', 'selected');
                            }

                            plantationDropdown.append(option);
                        });
                        plantationDropdown.prop('disabled', false);
                    } else {
                        plantationDropdown.empty().append('<option selected disabled>Petani ini belum memiliki kebun</option>');
                    }
                });
            }
        }

        if (selectedFarmerId) {
            populatePlantations(selectedFarmerId, selectedPlantationId);
        }

        $('#farmer-dropdown').on('change', function() {
            populatePlantations($(this).val());
        });
    });
</script>
@endpush