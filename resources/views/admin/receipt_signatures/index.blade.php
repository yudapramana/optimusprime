@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah Tanda Tangan
                </button>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered table-hover w-100" id="signatureTable">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.receipt_signatures._modal_create')
    <div id="editModalContainer"></div>
@endsection

@push('js')
    <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(function() {
            const table = $('#signatureTable').DataTable({
                processing: true,
                autoWidth: false,
                responsive: true,
                serverSide: false,
                searching: false,
                ordering: false,
                paging: false,
                info: false,
                lengthChange: false,
                ajax: "{{ route('admin.receipt_signatures.index') }}",
                columns: [{
                        data: 'name',
                        className: 'text-center'
                    },
                    {
                        data: 'position',
                        className: 'text-center'
                    },
                    {
                        data: 'is_active',
                        className: 'text-center',
                        render: data => data ? '✔️' : '❌'
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: data => `
                            <button class="btn btn-sm btn-warning edit-btn" data-id="${data.id}"><i class="fas fa-edit"></i></button>
                        `
                    }
                ]
            });

            $('#formCreate').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.receipt_signatures.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function() {
                        $('#createModal').modal('hide');
                        table.ajax.reload();
                        $('#formCreate')[0].reset();
                        Swal.fire('Berhasil', 'Data berhasil ditambahkan', 'success');
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

            $(document).on('click', '.edit-btn', function() {
                const id = $(this).data('id');
                $.get(`/admin/master/receipt_signatures/${id}/edit`, function(html) {
                    $('#editModalContainer').html(html);
                    $('#editModal').modal('show');
                });
            });

            $(document).on('submit', '#formEdit', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const formData = new FormData(this);

                $.ajax({
                    url: `/admin/master/receipt_signatures/${id}`,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    success: function() {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire('Berhasil', 'Data berhasil diperbarui', 'success');
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
        });
    </script>
@endpush
