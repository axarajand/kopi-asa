@extends('layouts.admin')

@section('title', 'Varietas Kopi')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item">Manajemen Data</a></li>
                <li class="breadcrumb-item active">Varietas Kopi</li>
            </ol>
        </div>
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-variety-modal">
                Tambah Varietas
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
            <h5 class="card-title mb-0">Data Varietas Kopi</h5>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Varietas</th>
                        <th>Spesies</th>
                        <th>Catatan</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($varieties as $variety)
                        <tr>
                            <td>{{ $variety->name }}</td>
                            <td>
                                @if($variety->species == 'Arabika')
                                    <span class="badge bg-success-subtle text-success">{{ $variety->species }}</span>
                                @elseif($variety->species == 'Robusta')
                                    <span class="badge bg-warning-subtle text-warning">{{ $variety->species }}</span>
                                @elseif($variety->species == 'Liberika')
                                    <span class="badge bg-info-subtle text-info">{{ $variety->species }}</span>
                                @else
                                    <span class="badge bg-dark-subtle text-dark">{{ $variety->species }}</span>
                                @endif
                            </td>
                            <td>{{ $variety->notes }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-warning edit-btn" data-id="{{ $variety->id }}" data-bs-toggle="modal" data-bs-target="#edit-variety-modal">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $variety->id }}" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.varieties.partials.modal-create')
    @include('admin.varieties.partials.modal-edit')
    @include('admin.varieties.partials.modal-delete')
@endsection

@push('scripts')
    <script src="{{ asset('admin-assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();

            // Script for Edit Modal
            $('.edit-btn').on('click', function () {
                var varietyId = $(this).data('id');
                var updateUrl = "{{ route('admin.varieties.update', ':id') }}".replace(':id', varietyId);
                var showUrl = "{{ route('admin.varieties.show', ':id') }}".replace(':id', varietyId);

                $('#edit-variety-form').attr('action', updateUrl);

                $.get(showUrl, function (data) {
                    $('#edit-name').val(data.name);
                    $('#edit-species').val(data.species);
                    $('#edit-notes').val(data.notes);
                });
            });

            // Script for Delete Modal
            $('.delete-btn').on('click', function () {
                var varietyId = $(this).data('id');
                var destroyUrl = "{{ route('admin.varieties.destroy', ':id') }}".replace(':id', varietyId);
                $('#delete-confirm-form').attr('action', destroyUrl);
            });
        });
    </script>
@endpush