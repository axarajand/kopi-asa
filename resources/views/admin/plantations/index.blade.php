@extends('layouts.admin')

@section('title', 'Kebun')

@push('styles')
    {{-- We add the Leaflet CSS file here in the head section --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        .leaflet-pane { z-index: 1056; } /* Fix for map appearing behind modal backdrop */
    </style>
@endpush

@section('content')
    <div class="py-3 d-flex justify-content-between align-items-center">
        <div class="flex-grow-1">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item">Manajemen Data</a></li>
                <li class="breadcrumb-item active">Kebun</li>
            </ol>
        </div>
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-plantation-modal">
                Tambah Kebun
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data Kebun Terdaftar</h5>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Kebun</th>
                        <th>Pemilik (Petani)</th>
                        <th>Alamat</th>
                        <th>Alamat Detail</th>
                        <th>Peta</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plantations as $plantation)
                        <tr>
                            <td>{{ $plantation->name }}</td>
                            <td>{{ $plantation->user->name ?? 'N/A' }}</td>
                            <td>
                                {{ $plantation->village }}, {{ $plantation->district }}, <br>
                                {{ $plantation->city }}, {{ $plantation->province }}, {{ $plantation->postal_code }}
                            </td>
                            <td>{{ $plantation->address_detail ?? '-' }}</td>
                            <td>
                                @if($plantation->latitude && $plantation->longitude)
                                    <button class="btn btn-sm btn-info view-map-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#map-view-modal" 
                                            data-lat="{{ $plantation->latitude }}" 
                                            data-lng="{{ $plantation->longitude }}">
                                        Lihat Peta
                                    </button>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-warning edit-btn" data-id="{{ $plantation->id }}" data-bs-toggle="modal" data-bs-target="#edit-plantation-modal">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $plantation->id }}" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.plantations.partials.modal-create')
    @include('admin.plantations.partials.modal-edit')
    @include('admin.plantations.partials.modal-delete')
    @include('admin.plantations.partials.modal-map-view')
@endsection

@push('scripts')
    <script src="{{ asset('admin-assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
            
            // --- Logic for Create Modal ---
            var createMap, createMarker;
            var initialLat = -6.2088; // Default: Jakarta
            var initialLng = 106.8456;

            $('#create-plantation-modal').on('shown.bs.modal', function () {
                if (!createMap) {
                    createMap = L.map('map').setView([initialLat, initialLng], 10);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(createMap);
                    createMarker = L.marker([initialLat, initialLng], { draggable: true }).addTo(createMap);

                    createMarker.on('dragend', function (event) {
                        var position = createMarker.getLatLng();
                        $('#latitude').val(position.lat.toFixed(7));
                        $('#longitude').val(position.lng.toFixed(7));
                    });
                }
                setTimeout(() => createMap.invalidateSize(), 10);
            });

            // --- Cascading Dropdown Logic ---
            function clearDropdown(dropdown, label) {
                dropdown.empty().append('<option selected disabled>-- Pilih ' + label + ' --</option>');
            }

            $.get("{{ route('api.provinces') }}", function(data) {
                clearDropdown($('#province-dropdown'), 'Provinsi');
                $.each(data, function(key, value) {
                    $('#province-dropdown').append('<option value="' + value.id + '" data-name="' + value.name + '">' + value.name + '</option>');
                });
            });

            $('#province-dropdown').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                $('#province_name').val(selectedOption.data('name'));

                var provinceId = $(this).val();
                clearDropdown($('#city-dropdown'), 'Kabupaten/Kota');
                clearDropdown($('#district-dropdown'), 'Kecamatan');
                clearDropdown($('#village-dropdown'), 'Desa/Kelurahan');
                if (provinceId) {
                    $.get('/api/cities/' + provinceId, function(data) {
                        $.each(data, function(key, value) {
                            $('#city-dropdown').append('<option value="' + value.id + '" data-name="' + value.name + '">' + value.name + '</option>');
                        });
                    });
                }
            });

            $('#city-dropdown').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                $('#city_name').val(selectedOption.data('name'));
                var cityId = $(this).val();
                clearDropdown($('#district-dropdown'), 'Kecamatan');
                clearDropdown($('#village-dropdown'), 'Desa/Kelurahan');
                if (cityId) {
                    $.get('/api/districts/' + cityId, function(data) {
                        $.each(data, function(key, value) {
                            $('#district-dropdown').append('<option value="' + value.id + '" data-name="' + value.name + '">' + value.name + '</option>');
                        });
                    });
                }
            });

            $('#district-dropdown').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                $('#district_name').val(selectedOption.data('name'));
                var districtId = $(this).val();
                clearDropdown($('#village-dropdown'), 'Desa/Kelurahan');
                if (districtId) {
                    $.get('/api/villages/' + districtId, function(data) {
                         $.each(data, function(key, value) {
                            $('#village-dropdown').append('<option value="' + value.id + '" data-name="' + value.name + '">' + value.name + '</option>');
                        });
                    });
                }
            });

            $('#village-dropdown').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                $('#village_name').val(selectedOption.data('name'));
                
                var villageName = $(this).find('option:selected').data('name');
                var districtName = $('#district-dropdown').find('option:selected').data('name');
                var cityName = $('#city-dropdown').find('option:selected').data('name');
                var provinceName = $('#province-dropdown').find('option:selected').data('name');
                
                if (villageName && districtName && cityName && provinceName) {
                    var query = `${villageName}, ${districtName}, ${cityName}, ${provinceName}`;
                    $.get(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query)}&format=json&limit=1`, function(data) {
                        if (data.length > 0) {
                            var lat = data[0].lat;
                            var lon = data[0].lon;
                            
                            var newLatLng = new L.LatLng(lat, lon);
                            createMarker.setLatLng(newLatLng);
                            createMap.setView(newLatLng, 15);
                            
                            $('#latitude').val(parseFloat(lat).toFixed(7));
                            $('#longitude').val(parseFloat(lon).toFixed(7));
                        }
                    });
                }
            });

            // --- Logic for Edit and Delete Modals ---
            $('.edit-btn').on('click', function () {
                var plantationId = $(this).data('id');
                var updateUrl = "{{ route('admin.plantations.update', ':id') }}".replace(':id', plantationId);
                var showUrl = "{{ route('admin.plantations.show', ':id') }}".replace(':id', plantationId);

                $('#edit-plantation-form').attr('action', updateUrl);

                $.get(showUrl, function (data) {
                    $('#edit_user_id').val(data.user_id);
                    $('#edit_name').val(data.name);
                    $('#edit_address_detail').val(data.address_detail);
                    $('#edit_postal_code').val(data.postal_code);
                });
            });

            $('.delete-btn').on('click', function () {
                var plantationId = $(this).data('id');
                var destroyUrl = "{{ route('admin.plantations.destroy', ':id') }}".replace(':id', plantationId);
                $('#delete-confirm-form').attr('action', destroyUrl);
            });

            // --- Logic for View Map Modal ---
            var viewMap, viewMarker;
            $('#map-view-modal').on('shown.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var lat = button.data('lat');
                var lng = button.data('lng');
                var newLatLng = new L.LatLng(lat, lng);

                if (!viewMap) {
                    viewMap = L.map('map-view').setView(newLatLng, 16);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(viewMap);
                    viewMarker = L.marker(newLatLng).addTo(viewMap);
                } else {
                    viewMap.setView(newLatLng, 16);
                    viewMarker.setLatLng(newLatLng);
                }
                setTimeout(() => viewMap.invalidateSize(), 10);
            });
        });
    </script>
@endpush