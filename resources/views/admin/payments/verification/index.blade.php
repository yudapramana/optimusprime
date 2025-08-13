@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title mb-0 font-weight-bold">Verifikasi Bukti Pembayaran</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover table-sm w-100" id="paymentTable">
                    <thead class="bg-light text-center">
                        <tr>
                            <th>#</th>
                            <th>Mahasiswa</th>
                            <th>Semester</th>
                            <th>Rincian Bayar</th>
                            <th>Termin</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Verifikasi -->
    <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Preview Bukti Pembayaran -->
                    <div class="text-center mb-3">
                        <img id="evidenImage" src="" class="img-fluid rounded border" alt="Bukti Pembayaran" width="500">
                    </div>

                    <!-- Info Bank dan Nominal -->
                    <div class="bg-light border p-3 rounded small">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <strong>Transfer ke Bank:</strong><br>
                                <span id="bankInfo" class="text-muted">-</span>
                            </div>
                            {{-- <div class="col-md-3 mb-2">
                                <strong>Nomor Rekening:</strong><br>
                                <span id="bankAccount" class="text-muted">-</span>
                            </div> --}}
                            <div class="col-md-3 mb-2">
                                <strong>Nominal Pembayaran:</strong><br>
                                <span id="nominalAmount" class="text-muted">-</span>
                            </div>
                            <div class="col-md-3 mb-2">
                                <strong>Tanggal Transfer:</strong><br>
                                <span id="transferDate" class="text-muted">-</span>
                            </div>
                            <div class="col-md-3 mb-2">
                                <strong>Nomor Resi:</strong><br>
                                <span id="receiptNumber" class="text-muted">-</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <!-- Form Setujui -->
                    <form id="verifyForm" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </form>

                    <!-- Form Tolak -->
                    <form id="rejectForm" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(function() {
            const table = $('#paymentTable').DataTable({
                processing: true,
                serverSide: true,
                sort: false,
                order: false,
                ajax: {
                    url: "{{ route('admin.payments.verification.index') }}",
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
                    }, {
                        data: 'installment.user.name',
                        name: 'installment.user.name'
                    },
                    {
                        data: 'academic_semester',
                        name: 'academic_semester'
                    },
                    {
                        data: null,
                        className: 'text-left',
                        render: function(data) {
                            // Mapping skema ke nama yang lebih enak dibaca
                            const schemeLabels = {
                                installment_three_times: '3x Angsuran',
                                one_time_payment: 'Lunas'
                            };

                            const readableScheme = schemeLabels[data.installment.scheme.scheme_name] || data.installment.scheme.scheme_name;

                            return `
                                <div style="line-height:1;">
                                    <div class="mb-0">
                                        <span class="text-sm text-muted">Fakultas:</span><br>
                                        <span class="badge badge-info">${data.installment.user.student.faculty.name}</span>
                                    </div>
                                    <div class="mb-0">
                                        <span class="text-sm text-muted">Biaya Kuliah:</span><br>
                                        <small>Rp ${parseFloat(data.installment.user.student.faculty.tuition_fee).toLocaleString('id-ID')}</small>
                                    </div>
                                    <div class="mb-0">
                                        <span class="text-sm text-muted">Skema:</span><br>
                                        <span class="badge badge-secondary">${readableScheme}</span>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'installment_number',
                        name: 'installment_number',
                        className: 'text-center'
                    },
                    {
                        data: 'amount_paid',
                        name: 'amount_paid',
                        className: 'text-right',
                        render: data => `Rp ${parseFloat(data).toLocaleString('id-ID')}`
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        render: data => `<span class="badge badge-${data === 'approved' ? 'success' : data === 'pending' ? 'warning' : data === 'rejected' ? 'danger' : 'secondary'}">${data.replace('_', ' ').toUpperCase()}</span>`
                    },
                    {
                        data: null,
                        className: 'text-center',
                        orderable: false,
                        render: function(data) {
                            console.log('data');
                            console.log(data);
                            return `<button class="btn btn-sm btn-primary btn-verify" data-url="${data.eviden_url}" data-id="${data.id}"><i class="fas fa-check"></i> Verifikasi</button>`
                        }
                    }
                ]
            });

            // Show modal and image
            $(document).on('click', '.btn-preview', function(e) {
                e.preventDefault();
                const imgUrl = $(this).data('url');
                $('#evidenImage').attr('src', imgUrl);
                $('#verifyModal').modal('show');
            });

            // Open verification modal
            $(document).on('click', '.btn-verify', function() {
                const id = $(this).data('id');

                // Ambil data row dari datatables
                const rowData = $('#paymentTable').DataTable().row($(this).parents('tr')).data();

                // Gambar
                $('#evidenImage').attr('src', rowData.eviden_url);

                // Info Bank
                if (rowData.bank) {
                    $('#bankInfo').html(`${rowData.bank.account_number} <br> ${rowData.bank.bank_name} a.n ${rowData.bank.account_name}`);

                    // $('#bankAccount').text(rowData.bank.account_number);
                    $('#receiptNumber').text(rowData.receipt_number);
                } else {
                    $('#bankInfo').text('-');
                    $('#bankAccount').text('-');
                }

                // Tambahkan Nominal
                if (rowData.amount_paid) {
                    $('#nominalAmount').text(`Rp ${parseFloat(rowData.amount_paid).toLocaleString('id-ID')}`);
                } else {
                    $('#nominalAmount').text('-');
                }

                // Tambahkan Nominal
                if (rowData.transfer_date) {
                    const date = new Date(rowData.transfer_date);
                    const humanReadable = date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                    $('#transferDate').text(humanReadable);
                } else {
                    $('#transferDate').text('-');
                }


                const actionUrl = `/admin/verify/payments/${id}`;
                const imgUrl = $(this).data('url');

                console.log('imgUrl');
                console.log(imgUrl);

                $('#evidenImage').attr('src', imgUrl);
                $('#verifyForm').attr('action', actionUrl);
                $('#rejectForm').attr('action', actionUrl);
                $('#verifyModal').modal('show');
            });


            // Submit Approve
            $('#verifyForm').submit(function(e) {
                e.preventDefault();
                const actionUrl = $(this).attr('action');

                $.ajax({
                    url: actionUrl,
                    method: 'PUT',
                    data: {
                        status: 'approved',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#verifyModal').modal('hide');
                        $('#paymentTable').DataTable().ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan saat memverifikasi.',
                        });
                    }
                });
            });

            // Submit Reject
            $('#rejectForm').submit(function(e) {
                e.preventDefault();
                const actionUrl = $(this).attr('action');

                $.ajax({
                    url: actionUrl,
                    method: 'PUT',
                    data: {
                        status: 'rejected',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#verifyModal').modal('hide');
                        $('#paymentTable').DataTable().ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Ditolak!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menolak.',
                        });
                    }
                });
            });
        });
    </script>
@endpush
