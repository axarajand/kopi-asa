@extends('layouts.admin')

@section('title', 'Petani')

@section('content')
    <div class="py-3 d-flex justify-content-between align-items-center">
        <div class="flex-grow-1">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item">Manajemen Data</a></li>
                <li class="breadcrumb-item active">Petani</li>
            </ol>
        </div>
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-farmer-modal">
                Tambah Petani
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
            <h5 class="card-title mb-0">Data Petani</h5>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Petani</th>
                        <th>Email</th>
                        <th>Tanggal Terdaftar</th>
                        <th>Avatar</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($farmers as $farmer)
                        <tr>
                            <td>{{ $farmer->name }}</td>
                            <td>{{ $farmer->email }}</td>
                            <td>{{ $farmer->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="#" class="avatar-zoom-trigger" data-bs-toggle="modal" data-bs-target="#avatar-zoom-modal" data-img-src="{{ $farmer->profile_photo_path ? asset('storage/' . $farmer->profile_photo_path) : asset('admin-assets/images/users/user-default.jpg') }}">
                                    <img src="{{ $farmer->profile_photo_path ? asset('storage/' . $farmer->profile_photo_path) : asset('admin-assets/images/users/user-default.jpg') }}" alt="avatar" class="rounded-circle" width="40">
                                </a>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-warning edit-btn" data-id="{{ $farmer->id }}" data-bs-toggle="modal" data-bs-target="#edit-farmer-modal">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $farmer->id }}" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.farmers.partials.modal-create')
    @include('admin.farmers.partials.modal-edit')
    @include('admin.farmers.partials.modal-delete')
    
    <div class="modal fade" id="avatar-zoom-modal" tabindex="-1" aria-labelledby="avatarZoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avatarZoomModalLabel">Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="zoomed-avatar-image" src="" alt="Zoomed Avatar" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin-assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();

            $(document).ready(function() {
                $('#datatable').DataTable();
                $('.avatar-zoom-trigger').on('click', function (event) {
                    event.preventDefault();
                    var imageUrl = $(this).data('img-src');
                    $('#zoomed-avatar-image').attr('src', imageUrl);
                });
            });

            $('.edit-btn').on('click', function () {
                var farmerId = $(this).data('id');
                var updateUrl = "{{ route('admin.farmers.update', ':id') }}".replace(':id', farmerId);
                var showUrl = "{{ route('admin.farmers.show', ':id') }}".replace(':id', farmerId);

                $('#edit-farmer-form').attr('action', updateUrl);

                $.get(showUrl, function (data) {
                    $('#edit-name').val(data.name);
                    $('#edit-email').val(data.email);
                });
            });

            $('.delete-btn').on('click', function () {
                var farmerId = $(this).data('id');
                var destroyUrl = "{{ route('admin.farmers.destroy', ':id') }}".replace(':id', farmerId);
                $('#delete-confirm-form').attr('action', destroyUrl);
            });
        });
    </script>
@endpush