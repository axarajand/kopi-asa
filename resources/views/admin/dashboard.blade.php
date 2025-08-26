@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Dashboard KopiAsa</h4>
        </div>
    </div>
    
    {{-- Baris Kartu Rekap --}}
    <div class="row">
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle bg-primary-subtle p-2">
                            <iconify-icon icon="tabler:user-star" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0 text-dark fs-16">Total Petani</p>
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $totalFarmers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle bg-success-subtle p-2">
                            <iconify-icon icon="tabler:plant-2" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0 text-dark fs-16">Total Kebun</p>
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $totalPlantations }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle bg-warning-subtle p-2">
                            <iconify-icon icon="tabler:coffee" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0 text-dark fs-16">Total Varietas</p>
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $totalVarieties }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle bg-danger-subtle p-2">
                            <iconify-icon icon="tabler:brain" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0 text-dark fs-16">Total Prediksi</p>
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $totalPredictions }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Riwayat Prediksi Terakhir --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-dark mb-0">5 Riwayat Prediksi Terakhir</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th>Kebun</th>
                                    <th>Petani</th>
                                    <th>Varietas</th>
                                    <th>Skor Kualitas</th>
                                    <th>Rentang pH</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentHistories as $history)
                                    <tr>
                                        <td>{{ $history->plantation->name ?? 'N/A' }}</td>
                                        <td>{{ $history->plantation->user->name ?? 'N/A' }}</td>
                                        <td>{{ $history->variety->name ?? 'N/A' }}</td>
                                        <td><span class="badge bg-success-subtle text-success">{{ $history->predicted_quality_score }}</span></td>
                                        <td>{{ $history->predicted_ph_range }}</td>
                                        <td>{{ $history->created_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">Belum ada riwayat prediksi yang tersimpan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection