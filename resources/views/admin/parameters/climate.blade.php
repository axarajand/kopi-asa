@extends('layouts.admin')
@section('title', 'Iklim')

@section('content')
    <div class="py-3">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">Data Parameter</a></li>
            <li class="breadcrumb-item active">Iklim</li>
        </ol>
    </div>
    <div class="card">
        <div class="card-header"><h5 class="card-title mb-0">Data Iklim Real-time dari Semua Kebun</h5></div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Kebun</th>
                        <th>Pemilik</th>
                        <th>Suhu</th>
                        <th>Kelembapan</th>
                        <th>Curah Hujan (1 Tahun Terakhir)</th>
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
                            <td class="climate-suhu"><div class="spinner-border spinner-border-sm" role="status"></div></td>
                            <td class="climate-kelembapan"><div class="spinner-border spinner-border-sm" role="status"></div></td>
                            <td class="climate-curah-hujan"><div class="spinner-border spinner-border-sm" role="status"></div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
                
                var firstCell = row.find('.climate-suhu');
                row.find('.climate-kelembapan, .climate-curah-hujan').remove();
                firstCell.attr('colspan', 3).css('text-align', 'center');
                
                var button = $('<button>', {
                    text: 'Data Tidak Tersedia, Isi Manual',
                    class: 'btn btn-sm btn-outline-primary manual-input-btn',
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#manual-climate-modal',
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
                        var fetchUrl = "{{ route('admin.parameters.fetch', 'climate') }}?lat=" + lat + "&lon=" + lng;
                        
                        $.get(fetchUrl)
                        .done(function(dataFromApi) {
                            // 1. Display the data
                            var temp = dataFromApi['Suhu'];
                            var humidity = dataFromApi['Kelembapan'];
                            var precip = dataFromApi['Curah Hujan (Total 1 Tahun Terakhir)'];

                            row.find('.climate-suhu').text(temp);
                            row.find('.climate-kelembapan').text(humidity);
                            row.find('.climate-curah-hujan').text(precip);

                            // 2. Save the data silently in the background
                            var saveDataUrl = "{{ route('admin.parameters.saveApi', ':id') }}".replace(':id', plantationId);
                            $.post(saveDataUrl, {
                                _token: "{{ csrf_token() }}",
                                avg_temperature: parseFloat(temp),
                                avg_humidity: parseFloat(humidity),
                                yearly_precipitation: parseFloat(precip)
                            });
                        })
                        .fail(function() {
                            showManualInputButton(row);
                        });
                    } else {
                        showManualInputButton(row);
                    }
                }
            });
            
            var table = $('#datatable').DataTable();
            
            $('.data-row').each(function () {
                var row = $(this);
                var lat = row.data('lat');
                var lng = row.data('lng');

                if (lat && lng) {
                    $.get("{{ route('admin.parameters.fetch', 'climate') }}", { lat: lat, lon: lng }, function(data) {
                        row.find('.climate-suhu').text(data['Suhu']);
                        row.find('.climate-kelembapan').text(data['Kelembapan']);
                        row.find('.climate-curah-hujan').text(data['Curah Hujan (Total 1 Tahun Terakhir)']);
                    }).fail(function() {
                        row.find('td[class^="climate-"]').text('Gagal').addClass('text-danger');
                    });
                } else {
                    row.find('td[class^="climate-"]').text('No Lat/Lng').addClass('text-muted');
                }
            });
        });
    </script>
@endpush