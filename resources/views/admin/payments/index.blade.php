@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title font-weight-bold mb-0">{{ $titlePages }}</h5>
            </div>

            <div class="card-body table-responsive">

                <div id="payment-summary" class="row mb-3">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5>Total Transfer</h5>
                                <h4 id="summary-transfer-count" class="text-success font-weight-bold">0 transaksi</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5>Jumlah Pembayaran</h5>
                                <h4 id="summary-transfer-amount" class="text-primary font-weight-bold">Rp 0</h4>
                            </div>
                        </div>
                    </div>
                </div>



                <table class="table table-sm table-bordered table-hover w-100" id="paymentTable">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>No</th>
                            <th>Tgl Transfer</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Fakultas</th>
                            <th>Skema</th>
                            <th>Semester</th>
                            <th>Biaya Total</th>
                            <th>Angsuran (%)</th>
                            <th>Jumlah Bayar</th>
                            <th>Bank</th>
                            {{-- <th>Bukti</th>
                            <th>Catatan</th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
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
            $('#paymentTable').DataTable({
                processing: true,
                autoWidth: false,
                responsive: true,
                serverSide: false,
                searching: true,
                paging: true,
                info: true,
                lengthChange: false,
                pageLength: 100,
                order: false,
                sort: false,
                dom: "<'row'<'col-md-6'B><'col-md-6'f>>" +
                    "<'row'<'col-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                buttons: [
                    'copy', 'excel',
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: 'Laporan Pembayaran Mahasiswa',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'print', 'colvis'
                ],
                // ajax: "{{ route('admin.payments.index') }}",
                ajax: {
                    url: "{{ route('admin.payments.index') }}",
                    dataSrc: function(json) {
                        // Update summary ke DOM
                        const summary = json.summary || {};
                        $('#summary-transfer-count').text(`${summary.total_transfer} transaksi`);
                        $('#summary-transfer-amount').text(`Rp ${formatRupiah(summary.total_amount || 0)}`);

                        return json.data;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'transfer_date',
                        className: 'text-center'
                    },
                    {
                        data: 'installment.user.student.name'
                    },
                    {
                        data: 'installment.user.student.nim',
                        className: 'text-center'
                    },
                    {
                        data: 'installment.user.student.faculty.name'
                    },
                    {
                        data: 'installment.scheme.scheme_label'
                    },
                    {
                        data: 'academic_semester',
                        className: 'text-center'
                    },
                    {
                        data: 'installment.user.student.faculty.tuition_fee',
                        className: 'text-right',
                        render: d => d ? `Rp ${parseFloat(d).toLocaleString('id-ID')}` : '-'
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data) {
                            return `${data.installment_number} (${data.percentage}%)`;
                        }
                    },
                    {
                        data: 'amount_paid',
                        className: 'text-right',
                        render: d => d ? `Rp ${parseFloat(d).toLocaleString('id-ID')}` : '-'
                    },
                    {
                        data: 'bank.bank_name',
                        defaultContent: '-'
                    },
                    // {
                    //     data: 'eviden_url',
                    //     className: 'text-center',
                    //     render: function(url) {
                    //         return url ? `<a href="${url}" target="_blank" class="btn btn-sm btn-outline-dark">Lihat</a>` : '-';
                    //     }
                    // },
                    // {
                    //     data: 'notes',
                    //     render: d => d ? d : '-',
                    //     className: 'text-wrap'
                    // }
                ]
            });

            function formatRupiah(angka) {
                return angka.toLocaleString('id-ID', {
                    style: 'decimal',
                    minimumFractionDigits: 2
                });
            }
        });
    </script>
@endpush
