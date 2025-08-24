@extends('layouts.admin')

@section('title', 'Daerah Kopi')

@section('content')
    <div class="py-3 d-flex justify-content-between align-items-center">
        <div class="flex-grow-1">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item">Manajemen Data</a></li>
                <li class="breadcrumb-item active">Daerah Kopi</li>
            </ol>
        </div>
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-region-modal">
                Tambah Daerah
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
            <h5 class="card-title mb-0">Data Daerah Kopi</h5>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Daerah</th>
                        <th>Provinsi</th>
                        <th>Deskripsi</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($regions as $region)
                        <tr>
                            <td>{{ $region->name }}</td>
                            <td>{{ $region->province }}</td>
                            <td>{{ $region->description }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-warning edit-btn" data-id="{{ $region->id }}" data-bs-toggle="modal" data-bs-target="#edit-region-modal">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $region->id }}" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.regions.partials.modal-create')
    @include('admin.regions.partials.modal-edit')
    @include('admin.regions.partials.modal-delete')
@endsection

@push('scripts')
    <script src="{{ asset('admin-assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();

            $('.edit-btn').on('click', function () {
                var regionId = $(this).data('id');
                var updateUrl = "{{ route('admin.regions.update', ':id') }}".replace(':id', regionId);
                var showUrl = "{{ route('admin.regions.show', ':id') }}".replace(':id', regionId);

                $('#edit-region-form').attr('action', updateUrl);

                $.get(showUrl, function (data) {
                    $('#edit-name').val(data.name);
                    $('#edit-province').val(data.province);
                    $('#edit-description').val(data.description);
                });
            });

            $('.delete-btn').on('click', function () {
                var regionId = $(this).data('id');
                var destroyUrl = "{{ route('admin.regions.destroy', ':id') }}".replace(':id', regionId);
                $('#delete-confirm-form').attr('action', destroyUrl);
            });
        });
    </script>
@endpush