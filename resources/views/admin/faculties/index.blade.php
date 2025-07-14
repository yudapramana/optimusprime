@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah Fakultas
                </button>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered table-hover w-100" id="facultyTable">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>Nama Fakultas</th>
                            <th>Kode</th>
                            <th>Biaya Kuliah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.faculties._modal_create')
    <div id="editModalContainer"></div>
@endsection

@push('js')
    <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(function() {
            const table = $('#facultyTable').DataTable({
                processing: true,
                autoWidth: false,
                responsive: true,
                serverSide: false,
                searching: false,
                paging: false,
                info: false,
                lengthChange: false,
                ajax: "{{ route('admin.faculties.index') }}",
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'tuition_fee',
                        className: 'text-right',
                        render: function(data) {
                            return 'Rp ' + parseFloat(data).toLocaleString('id-ID', {
                                minimumFractionDigits: 2
                            });
                        }
                    },
                    {
                        data: 'status',
                        className: 'text-center',
                        render: function(data) {
                            return data ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data) {
                            return `
                            <button class="btn btn-sm btn-warning edit-btn" data-id="${data.id}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="${data.id}">
                                <i class="fas fa-trash"></i>
                            </button>`;
                        }
                    }
                ]
            });

            // Submit Tambah
            $('#formCreate').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.faculties.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        $('#createModal').modal('hide');
                        $('#formCreate')[0].reset();
                        table.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Fakultas berhasil ditambahkan.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        let res = xhr.responseJSON.errors;
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        for (let field in res) {
                            $(`[name="${field}"]`).addClass('is-invalid').after(`<div class="invalid-feedback">${res[field][0]}</div>`);
                        }
                    }
                });
            });

            // Show Modal Edit
            $(document).on('click', '.edit-btn', function() {
                const id = $(this).data('id');
                $.get(`/admin/master/faculties/${id}/edit`, function(html) {
                    $('#editModalContainer').html(html);
                    $('#editModal').modal('show');
                });
            });

            // Submit Edit
            $(document).on('submit', '#formEdit', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: `/admin/master/faculties/${id}`,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function() {
                        $('#editModal').modal('hide');
                        table.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data fakultas berhasil diperbarui.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        let res = xhr.responseJSON.errors;
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        for (let field in res) {
                            $(`#formEdit [name="${field}"]`).addClass('is-invalid').after(`<div class="invalid-feedback">${res[field][0]}</div>`);
                        }
                    }
                });
            });

            // Konfirmasi dan Hapus
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin hapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/master/faculties/${id}`,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                table.ajax.reload();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Dihapus!',
                                    text: 'Data fakultas berhasil dihapus.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
