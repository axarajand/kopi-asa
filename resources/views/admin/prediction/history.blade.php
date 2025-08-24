@extends('layouts.admin')
@section('title', 'Riwayat Prediksi')

@section('content')
    <div class="py-3">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active">Riwayat Prediksi</li>
        </ol>
    </div>
    <div class="card">
        <div class="card-header"><h5 class="card-title mb-0">Riwayat Semua Prediksi</h5></div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Kebun</th>
                        <th>Nama Pemilik</th>
                        <th>Varietas</th>
                        <th>Spesies</th>
                        <th>Metode Proses</th>
                        <th>Kadar Air</th>
                        <th>Warna Biji</th>
                        <th>Di Prediksi Oleh</th>
                        <th>Prediksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <td>{{ $history->plantation->name ?? 'N/A' }}</td>
                            <td>{{ $history->plantation->user->name ?? 'N/A' }}</td>
                            <td>{{ $history->variety->name ?? 'N/A' }}</td>
                            <td>{{ $history->variety->species ?? 'N/A' }}</td>
                            <td>{{ $history->processing_method }}</td>
                            <td>{{ $history->moisture }}</td>
                            <td>{{ $history->color }}</td>
                            <td>{{ $history->predictor->name ?? 'N/A' }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info view-result-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#result-modal"
                                        data-quality-score="{{ $history->predicted_quality_score }}"
                                        data-quality-desc="{{ $history->predicted_quality_desc }}"
                                        data-ph-range="{{ $history->predicted_ph_range }}"
                                        data-ph-desc="{{ $history->predicted_ph_desc }}">
                                    Lihat Hasil
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.prediction.partials.modal-result')
@endsection

@push('scripts')
    <script src="{{ asset('admin-assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "order": [[ 0, "desc" ]] // Sort by the first column (Date) in descending order
            });

            $('.view-result-btn').on('click', function() {
                var qualityScore = $(this).data('quality-score');
                var qualityDesc = $(this).data('quality-desc');
                var phRange = $(this).data('ph-range');
                var phDesc = $(this).data('ph-desc');

                $('#modal-quality-score').text(qualityScore);
                $('#modal-quality-desc').text(qualityDesc);
                $('#modal-ph-range').text(phRange);
                $('#modal-ph-desc').text(phDesc);
            });
        });
    </script>
@endpush