@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            {{-- <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah Kriteria
                </button>
            </div> --}}

            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered table-hover w-100" id="criteriaTable">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>Jenis</th>
                            <th>Persentase</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.three_installment_criterias._modal_create')
    <div id="editModalContainer"></div>
@endsection

@push('js')
    <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(function() {
            const table = $('#criteriaTable').DataTable({
                processing: true,
                autoWidth: false,
                responsive: true,
                serverSide: false,
                searching: false, // ❌ Nonaktifkan search box global
                ordering: false, // ❌ Nonaktifkan sorting
                paging: false, // ❌ Nonaktifkan pagination
                info: false, // ❌ Nonaktifkan "Showing x of y"
                lengthChange: false, // ❌ Nonaktifkan dropdown jumlah data
                ajax: "{{ route('admin.three_installment_criterias.index') }}",
                columns: [{
                        data: 'type',
                        className: 'text-center'
                    },
                    {
                        data: 'percentage',
                        className: 'text-center',
                        render: data => `${data}%`
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data) {
                            return `
                                <button class="btn btn-sm btn-warning edit-btn" data-id="${data.id}"><i class="fas fa-edit"></i></button>
                            `;
                            // <button class="btn btn-sm btn-danger delete-btn" data-id="${data.id}"><i class="fas fa-trash"></i></button>

                        }
                    }
                ]
            });

            $('#formCreate').submit(function(e) {
                e.preventDefault();
                $.post("{{ route('admin.three_installment_criterias.store') }}", $(this).serialize())
                    .done(() => {
                        $('#createModal').modal('hide');
                        table.ajax.reload();
                        this.reset();
                        Swal.fire('Berhasil', 'Data berhasil ditambahkan', 'success');
                    })
                    .fail(xhr => {
                        let res = xhr.responseJSON.errors;
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        for (let field in res) {
                            $(`[name="${field}"]`).addClass('is-invalid').after(`<div class="invalid-feedback">${res[field][0]}</div>`);
                        }
                    });
            });

            $(document).on('click', '.edit-btn', function() {
                const id = $(this).data('id');
                $.get(`/admin/master/three_installment_criterias/${id}/edit`, function(html) {
                    $('#editModalContainer').html(html);
                    $('#editModal').modal('show');
                });
            });

            $(document).on('submit', '#formEdit', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: `/admin/master/three_installment_criterias/${id}`,
                    method: 'PUT',
                    data: $(this).serialize(),
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

            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/master/three_installment_criterias/${id}`,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                table.ajax.reload();
                                Swal.fire('Dihapus!', 'Data berhasil dihapus.', 'success');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
