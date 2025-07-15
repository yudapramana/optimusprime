@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title font-weight-bold mb-0">Daftar Mahasiswa</h5>
                {{-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah Mahasiswa
                </button> --}}
            </div>

            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered table-hover w-100" id="studentTable">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>No</th>
                            <th>Fakultas</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Kontak</th> <!-- Email + No HP -->
                            <th>JK</th>
                            <th>TTL</th>
                            <th>Tahun</th>
                            <th>Semester</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.students._modal_create')
    <div id="editModalContainer"></div>
@endsection

@push('js')
    <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('/') }}plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $(function() {
            const table = $('#studentTable').DataTable({
                processing: true,
                autoWidth: false,
                responsive: true,
                serverSide: false,
                searching: true,
                paging: true,
                info: true,
                lengthChange: false,
                pageLength: 100,
                dom: "<'row'<'col-md-6'B><'col-md-6'f>>" +
                    "<'row'<'col-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                buttons: [
                    'copy',
                    'excel',
                    {
                        extend: 'pdf',
                        orientation: 'landscape', // ⬅️ Atur orientasi jadi landscape
                        pageSize: 'A4',
                        title: 'Daftar Mahasiswa',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'print',
                    'colvis'
                ],
                ajax: {
                    url: "{{ route('admin.students.index') }}",
                    dataSrc: function(json) {
                        // Tambahkan DT_RowIndex manual jika tidak serverSide
                        return json.data.map((item, index) => {
                            item.DT_RowIndex = index + 1;
                            return item;
                        });
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'faculty.name'
                    },
                    {
                        data: 'user.name'
                    },
                    {
                        data: 'nim'
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `<div style="line-height:1"><small>${data.email}</small> | <br><small>${data.phone_number}</small></div>`;
                        }
                    },

                    {
                        data: 'gender',
                        className: 'text-center'
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `<div style="line-height:1"><small>${data.birth_place}, <br> ${formatDate(data.birth_date)}</small></div>`;
                        }
                    },
                    {
                        data: 'enrollment_year',
                        className: 'text-center'
                    },
                    {
                        data: 'entry_semester',
                        className: 'text-center',
                        render: data => data.charAt(0).toUpperCase() + data.slice(1)
                    },
                    //     {
                    //         data: null,
                    //         className: 'text-center',
                    //         orderable: false,
                    //         searchable: false,
                    //         render: function(data) {
                    //             return `<div class="d-flex align-items-center">
                // <button class="btn btn-sm btn-warning edit-btn mr-1" data-id="${data.id}">
                //     <i class="fas fa-edit"></i>
                // </button>
                // <button class="btn btn-sm btn-danger delete-btn" data-id="${data.id}">
                //     <i class="fas fa-trash"></i>
                // </button>
                // </div>`;
                    //         }
                    //     }
                ]

            });

            // table.buttons().container().appendTo('#studentTable_wrapper .col-md-6:eq(0)');


            function formatDate(dateStr) {
                const date = new Date(dateStr);
                const options = {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                };
                return date.toLocaleDateString('id-ID', options); // ex: 15 Jul 2025
            }


            // Tambah
            $('#formCreate').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.students.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        $('#createModal').modal('hide');
                        $('#formCreate')[0].reset();
                        table.ajax.reload();
                        Swal.fire('Berhasil', 'Data mahasiswa ditambahkan', 'success');
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

            // Edit
            $(document).on('click', '.edit-btn', function() {
                const id = $(this).data('id');
                $.get(`/admin/data/students/${id}/edit`, function(html) {
                    $('#editModalContainer').html(html);
                    $('#editModal').modal('show');
                });
            });

            $(document).on('submit', '#formEdit', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: `/admin/data/students/${id}`,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function() {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire('Berhasil', 'Data mahasiswa diperbarui', 'success');
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

            // Hapus
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/data/students/${id}`,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                table.ajax.reload();
                                Swal.fire('Terhapus', 'Data berhasil dihapus.', 'success');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
