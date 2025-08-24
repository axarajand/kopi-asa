@extends('layouts.admin')

@section('title', 'Tanah')

@section('content')
    <div class="py-3">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">Data Parameter</li>
            <li class="breadcrumb-item active">Tanah</li>
        </ol>
    </div>
    <div class="card">
        <div class="card-header"><h5 class="card-title mb-0">Data Tanah (Estimasi dari API) untuk Semua Kebun</h5></div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Kebun</th>
                        <th>Pemilik</th>
                        <th>pH Tanah</th>
                        <th>Tekstur Tanah</th>
                        <th>Bahan Organik (%)</th>
                        <th>Drainase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plantations as $plantation)
                        <tr class="data-row" 
                            data-id="{{ $plantation->id }}" 
                            data-name="{{ $plantation->name }}" 
                            data-lat="{{ $plantation->latitude }}" 
                            data-lng="{{ $plantation->longitude }}">
                            <td>{{ $plantation->name }}</td>
                            <td>{{ $plantation->user->name ?? 'N/A' }}</td>
                            <td class="soil-ph">
                                @if($plantation->soil_ph) {{ $plantation->soil_ph }} @else <div class="spinner-border spinner-border-sm" role="status"></div> @endif
                            </td>
                            <td class="soil-tekstur">
                                @if($plantation->soil_texture) {{ $plantation->soil_texture }} @else <div class="spinner-border spinner-border-sm" role="status"></div> @endif
                            </td>
                            <td class="soil-organik">
                                @if($plantation->organic_matter) {{ $plantation->organic_matter }} @else <div class="spinner-border spinner-border-sm" role="status"></div> @endif
                            </td>
                            <td class="soil-drainase">
                                @if($plantation->drainage) {{ $plantation->drainage }} @else <div class="spinner-border spinner-border-sm" role="status"></div> @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.parameters.partials.modal-soil-manual')
@endsection

@push('scripts')
    <script src="{{ asset('admin-assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable();
            
            function showManualInputButton(row) {
                var plantationId = row.data('id');
                var plantationName = row.data('name');
                
                var firstCell = row.find('.soil-ph');
                row.find('.soil-tekstur, .soil-organik, .soil-drainase').remove();
                firstCell.attr('colspan', 4).css('text-align', 'center');
                
                var button = $('<button>', {
                    text: 'Data Tidak Tersedia, Isi Manual',
                    class: 'btn btn-sm btn-outline-primary manual-input-btn',
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#manual-soil-modal',
                    'data-id': plantationId,
                    'data-name': plantationName
                });
                firstCell.html(button);
            }

            $('.data-row').each(function () {
                var row = $(this);
                if (row.find('.spinner-border').length > 0) {
                    var lat = row.data('lat');
                    var lng = row.data('lng');
                    var plantationId = row.data('id');

                    if (lat && lng) {
                        var fetchUrl = "{{ route('admin.parameters.fetch', 'soil') }}?lat=" + lat + "&lon=" + lng;
                        $.get(fetchUrl)
                        .done(function(dataFromApi) {
                            // kalau data API tidak valid -> manual input
                            if (dataFromApi['pH Tanah'] === 'N/A' || dataFromApi['Tekstur Tanah'] === 'Tidak Terdefinisi') {
                                showManualInputButton(row);
                            } else {
                                var ph = dataFromApi['pH Tanah'];
                                var tekstur = dataFromApi['Tekstur Tanah'];
                                var organik = dataFromApi['Bahan Organik (%)'];
                                var drainase = dataFromApi['Drainase'];

                                // 1. tampilkan di tabel
                                row.find('.soil-ph').text(ph);
                                row.find('.soil-tekstur').text(tekstur);
                                row.find('.soil-organik').text(organik);
                                row.find('.soil-drainase').text(drainase);

                                // 2. simpan ke DB otomatis
                                var saveDataUrl = "{{ route('admin.parameters.saveApi', ':id') }}".replace(':id', plantationId);
                                $.post(saveDataUrl, {
                                    _token: "{{ csrf_token() }}",
                                    soil_ph: parseFloat(ph),
                                    soil_texture: tekstur,
                                    organic_matter: parseFloat(organik),
                                    drainage: drainase
                                });
                            }
                        })
                        .fail(function() {
                            showManualInputButton(row);
                        });
                    } else {
                        showManualInputButton(row);
                    }
                }
            });

            // handler untuk tombol manual input
            $('#datatable').on('click', '.manual-input-btn', function() {
                var plantationId = $(this).data('id');
                var plantationName = $(this).data('name');
                var updateUrl = "{{ url('admin/parameters/soil') }}/" + plantationId;

                $('#plantation-name-span').text(plantationName);
                $('#manual-soil-form').attr('action', updateUrl);
            });
        });
    </script>
@endpush