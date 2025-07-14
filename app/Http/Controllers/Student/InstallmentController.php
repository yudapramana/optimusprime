<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Installment;
use App\Models\InstallmentScheme;
use App\Models\AcademicSemester;
use App\Models\Payment;
use App\Models\ThreeInstallmentCriteria;
use Illuminate\Support\Str;

class InstallmentController extends Controller
{
    
    public function create()
    {
        $user = auth()->user();
        $student = $user->student;

        $faculty = $student->faculty;

        return view('student.installments.create', [
            'schemes' => InstallmentScheme::all(),
            'academic_semester' => AcademicSemester::latest()->first(),
            'tuition_fee' => $faculty->tuition_fee,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'installment_scheme_id' => 'required|exists:installment_schemes,id',
            'academic_semester_id' => 'required|exists:academic_semesters,id',
            'tuition_fee' => 'required|numeric|min:0'
        ]);

        $user = auth()->user();

        $installment = Installment::create([
            'user_id' => $user->id,
            'academic_semester_id' => $request->academic_semester_id,
            'installment_scheme_id' => $request->installment_scheme_id,
            'tuition_fee' => $request->tuition_fee,
        ]);

        // Generate payments berdasarkan skema
        if ($request->installment_scheme_id == 1) {
            // One time payment (100%)
            Payment::create([
                'installment_id'     => $installment->id,
                'reference_id'       => Str::uuid(),
                'academic_semester'  => $installment->academicSemester->periode,
                'installment_number' => 1,
                'percentage'         => 100,
                'amount_paid'        => $installment->tuition_fee, // 100% dari tuition fee
                'due_date'           => $installment->academicSemester->start_date, // pakai start_date dari semester
            ]);
        } else {
            /// Ambil data dari tabel three_installment_criteria dan urutkan berdasarkan urutan termin
            $criteria = ThreeInstallmentCriteria::orderByRaw("FIELD(type, 'start_date', 'mid_date', 'end_date')")->get();

            foreach ($criteria as $index => $item) {
                Payment::create([
                    'installment_id'     => $installment->id,
                    'reference_id'       => Str::uuid(),
                    'academic_semester'  => $installment->academicSemester->periode,
                    'installment_number' => $index + 1,
                    'percentage'         => $item->percentage,
                    'amount_paid'        => ($installment->tuition_fee * $item->percentage) / 100,
                    'due_date'           => match ($item->type) {
                        'start_date' => $installment->academicSemester->start_date,
                        'mid_date'   => $installment->academicSemester->mid_date,
                        'end_date'   => $installment->academicSemester->end_date,
                    },
                ]);
            }

        }

        return redirect()->route('student.home')->with('success', 'Angsuran berhasil dibuat.');
    }
}
