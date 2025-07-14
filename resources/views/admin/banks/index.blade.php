@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah Bank
                </button>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered table-hover w-100" id="bankTable">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>Nama Bank</th>
                            <th>Atas Nama</th>
                            <th>Nomor Rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.banks._modal_create')
    <div id="editModalContainer"></div>
@endsection

@push('js')
    <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(function() {
            const table = $('#bankTable').DataTable({
                processing: true,
                autoWidth: false,
                responsive: true,
                serverSide: false,
                searching: false,
                ordering: false,
                paging: false,
                info: false,
                lengthChange: false,
                ajax: "{{ route('admin.banks.index') }}",
                columns: [{
                        data: 'bank_name'
                    },
                    {
                        data: 'account_name'
                    },
                    {
                        data: 'account_number'
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

            // Tambah
            $('#formCreate').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.banks.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        $('#createModal').modal('hide');
                        $('#formCreate')[0].reset();
                        table.ajax.reload();

                        Swal.fire('Berhasil!', 'Data bank berhasil ditambahkan.', 'success');
                    },
                    error: function(xhr) {
                        let res = xhr.responseJSON.errors;
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        for (let field in res) {
                            $(`[name="${field}"]`).addClass('is-invalid')
                                .after(`<div class="invalid-feedback">${res[field][0]}</div>`);
                        }
                    }
                });
            });

            // Edit
            $(document).on('click', '.edit-btn', function() {
                const id = $(this).data('id');
                $.get(`/admin/master/banks/${id}/edit`, function(html) {
                    $('#editModalContainer').html(html);
                    $('#editModal').modal('show');
                });
            });

            $(document).on('submit', '#formEdit', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: `/admin/master/banks/${id}`,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function() {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire('Berhasil!', 'Data bank berhasil diperbarui.', 'success');
                    },
                    error: function(xhr) {
                        let res = xhr.responseJSON.errors;
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        for (let field in res) {
                            $(`#formEdit [name="${field}"]`).addClass('is-invalid')
                                .after(`<div class="invalid-feedback">${res[field][0]}</div>`);
                        }
                    }
                });
            });

            // Delete
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/master/banks/${id}`,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                table.ajax.reload();
                                Swal.fire('Dihapus!', 'Data bank telah dihapus.', 'success');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
