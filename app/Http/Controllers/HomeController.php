<?php

namespace App\Http\Controllers;

use App\Models\AcademicSemester;
use App\Models\Bank;
use App\Models\Installment;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $student = Student::with('faculty')->where('user_id', $user->id)->firstOrFail();

        $installments = Installment::with(['payments', 'academicSemester', 'scheme'])
            ->where('user_id', $user->id)
            ->get();


        $current_semester = $student->current_semester;
        $academic_semester = AcademicSemester::latest()->first();
        $current_installment = $installments
            ->where('academic_semester_id', optional($academic_semester)->id)
            ->first();

        // return $current_installment;

        $total_tagihan = $installments->sum('tuition_fee');

        $total_pembayaran = $installments
            ->flatMap->payments
            ->where('status', 'approved')
            ->sum('amount_paid');

        // Ambil 1 tagihan yang belum dibayar dan due_date masih ke depan
        $tagihan = $current_installment?->payments
            ->where('status', '!=', 'approved')
            ->filter(function ($payment) {
                return \Carbon\Carbon::now()->lt($payment->due_date);
            })
            ->sortBy('due_date') // ambil yang paling dekat
            ->first();

        $banks = Bank::all(); // atau hanya yang aktif jika ada


        return view('student.home', [
            'student' => $student,
            'academic_semester' => $academic_semester,
            'current_installment' => $current_installment,
            'total_tagihan' => $total_tagihan,
            'total_pembayaran' => $total_pembayaran,
            'status_pembayaran' => $total_pembayaran >= $total_tagihan ? 'Lunas' : 'Belum Lunas',
            'tagihan' => $tagihan,
            'banks' => $banks,
        ]);
    }



}
