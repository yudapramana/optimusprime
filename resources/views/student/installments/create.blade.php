@extends('student.layouts.layout')

@section('content')
    <div class="content pt-3">
        <div class="container">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h5 class="mb-0 font-weight-bold">Form Tambah Angsuran</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('student.installments.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="academic_semester_id">Semester Akademik</label>
                            <input type="text" class="form-control" readonly value="{{ $academic_semester->year }} - {{ ucfirst($academic_semester->semester) }}">
                            <input type="hidden" name="academic_semester_id" value="{{ $academic_semester->id }}">
                        </div>

                        <div class="form-group">
                            <label for="installment_scheme_id">Skema Pembayaran</label>
                            <select name="installment_scheme_id" id="installment_scheme_id" class="form-control" required>
                                <option value="">-- Pilih Skema --</option>
                                @foreach ($schemes as $scheme)
                                    <option value="{{ $scheme->id }}">
                                        {{ $scheme->scheme_name == 'one_time_payment' ? 'Sekali Bayar' : '3x Angsuran' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tuition_fee">Biaya Kuliah</label>
                            <input type="text" class="form-control" id="tuition_fee" name="tuition_fee" value="{{ number_format($tuition_fee, 0, ',', '.') }}" readonly>
                        </div>

                        <input type="hidden" name="tuition_fee" value="{{ $tuition_fee }}">

                        <button type="submit" class="btn btn-primary">Simpan Angsuran</button>
                        <a href="{{ route('student.home') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
