@extends('layouts.admin')
@section('title', 'Topografi')

@section('content')
    <div class="py-3">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">Data Parameter</a></li>
            <li class="breadcrumb-item active">Topografi</li>
        </ol>
    </div>
     @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header"><h5 class="card-title mb-0">Data Topografi dari Semua Kebun</h5></div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Kebun</th>
                        <th>Pemilik</th>
                        <th>Ketinggian (MDPL)</th>
                        <th>Kemiringan Lereng</th>
                        <th>Arah Lereng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plantations as $plantation)
                        <tr class="data-row" data-id="{{ $plantation->id }}" data-name="{{ $plantation->name }}" data-lat="{{ $plantation->latitude }}" data-lng="{{ $plantation->longitude }}">
                            <td>{{ $plantation->name }}</td>
                            <td>{{ $plantation->user->name ?? 'N/A' }}</td>
                            <td class="topo-ketinggian">
                                @if($plantation->altitude) {{ $plantation->altitude }} meter @else <div class="spinner-border spinner-border-sm" role="status"></div> @endif
                            </td>
                            <td class="topo-kemiringan">
                                @if($plantation->slope_gradient) {{ $plantation->slope_gradient }} ° @else <div class="spinner-border spinner-border-sm" role="status"></div> @endif
                            </td>
                            <td class="topo-arah">
                                @if($plantation->slope_aspect) {{ $plantation->slope_aspect }} @else <div class="spinner-border spinner-border-sm" role="status"></div> @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.parameters.partials.modal-topography-manual')
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
                
                var firstCell = row.find('.topo-ketinggian');
                row.find('.topo-kemiringan, .topo-arah').remove();
                firstCell.attr('colspan', 3).css('text-align', 'center');
                
                var button = $('<button>', {
                    text: 'Data Tidak Tersedia, Isi Manual',
                    class: 'btn btn-sm btn-outline-primary manual-input-btn',
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#manual-topography-modal',
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
                        var fetchUrl = "{{ route('admin.parameters.fetch', ['type' => 'topography']) }}";

                        $.get(fetchUrl, { lat: lat, lon: lng })
                        .done(function(dataFromApi) {
                            row.find('.topo-ketinggian').text(dataFromApi['Ketinggian (MDPL)']);
                            row.find('.topo-kemiringan').text(dataFromApi['Kemiringan Lereng']);
                            row.find('.topo-arah').text(dataFromApi['Arah Lereng']);

                            var saveDataUrl = "{{ route('admin.parameters.saveApi', ['plantation' => ':id']) }}".replace(':id', plantationId);
                            
                            $.post(saveDataUrl, {
                                _token: "{{ csrf_token() }}",
                                altitude: parseFloat(dataFromApi['Ketinggian (MDPL)']),
                                slope_gradient: parseFloat(dataFromApi['Kemiringan Lereng']),
                                slope_aspect: dataFromApi['Arah Lereng']
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

            $('#datatable').on('click', '.manual-input-btn', function() {
                var plantationId = $(this).data('id');
                var plantationName = $(this).data('name');
                var updateUrl = "{{ url('admin/parameters') }}/" + plantationId;

                $('#plantation-name-span-topography').text(plantationName);
                $('#manual-topography-form').attr('action', updateUrl);
            });
        });
    </script>
@endpush