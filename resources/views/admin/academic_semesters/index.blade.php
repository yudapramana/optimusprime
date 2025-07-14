@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah Semester
                </button>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered table-hover w-100" id="semesterTable">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>Tahun</th>
                            <th>Semester</th>
                            <th>Tanggal Mulai Kuliah</th>
                            <th>Tanggal Tengah Semester</th>
                            <th>Tanggal Akhir Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    @include('admin.academic_semesters._modal_create')

    <!-- Modal Edit -->
    <div id="editModalContainer"></div>
@endsection

@push('js')
    <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(function() {
            const table = $('#semesterTable').DataTable({
                processing: true,
                autoWidth: false,
                responsive: true,
                serverSide: false,
                searching: false, // ❌ Nonaktifkan search box global
                ordering: false, // ❌ Nonaktifkan sorting
                paging: false, // ❌ Nonaktifkan pagination
                info: false, // ❌ Nonaktifkan "Showing x of y"
                lengthChange: false, // ❌ Nonaktifkan dropdown jumlah data
                ajax: "{{ route('admin.academic_semesters.index') }}",
                columns: [{
                        data: 'year',
                        className: 'text-center'
                    },
                    {
                        data: 'periode',
                        className: 'text-center'
                    },
                    {
                        data: 'start_date_formatted'
                    },
                    {
                        data: 'mid_date_formatted',
                        render: function(data) {
                            return data ?? '-';
                        }
                    },
                    {
                        data: 'end_date_formatted'
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

            // Tambah Data
            $('#formCreate').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.academic_semesters.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        $('#createModal').modal('hide');
                        $('#formCreate')[0].reset();
                        table.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Semester berhasil ditambahkan.',
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
                $.get(`/admin/master/academic_semesters/${id}/edit`, function(html) {
                    $('#editModalContainer').html(html);
                    $('#editModal').modal('show');
                });
            });

            // Update Data
            $(document).on('submit', '#formEdit', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: `/admin/master/academic_semesters/${id}`,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function() {
                        $('#editModal').modal('hide');
                        table.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data semester berhasil diperbarui.',
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

            // Konfirmasi dan Hapus Data
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data semester akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/master/academic_semesters/${id}`,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                table.ajax.reload();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Dihapus!',
                                    text: 'Data semester berhasil dihapus.',
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
