<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicSemester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;


class AcademicSemesterController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
           $data = AcademicSemester::select('id', 'year', 'semester', 'start_date', 'mid_date', 'end_date')
                ->orderBy('year', 'DESC') // Tahun terbaru dulu
                ->orderByRaw("CASE semester WHEN 'genap' THEN 1 WHEN 'ganjil' THEN 0 END DESC") // Genap sebelum ganjil
                ->get();

            return response()->json(['data' => $data]);
        }

        return view('admin.academic_semesters.index', [
            'titlePages' => 'Semester Akademik',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => [
                'required',
                'digits:4',
                'integer',
                'min:2000',
                Rule::unique('academic_semesters')->where(function ($q) use ($request) {
                    return $q->where('semester', $request->semester);
                }),
            ],
            'semester' => 'required|in:ganjil,genap',
            'start_date' => 'required|date',
            'mid_date' => 'nullable|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'year.required'      => 'Tahun wajib diisi.',
            'year.digits'        => 'Tahun harus terdiri dari 4 digit angka.',
            'year.integer'       => 'Tahun harus berupa angka.',
            'year.min'           => 'Tahun minimal 2000.',
            'year.unique'        => 'Kombinasi tahun dan semester sudah ada.',
        ]);

        AcademicSemester::create($request->all());
        return response()->json(['message' => 'Created']);
    }

    public function edit($id)
    {
        $semester = AcademicSemester::findOrFail($id);
        return view('admin.academic_semesters._modal_edit', compact('semester'))->render();
    }

    public function update(Request $request, $id)
    {
        $semester = AcademicSemester::findOrFail($id);

        $request->validate([
            'year' => [
                'required', 'digits:4', 'integer', 'min:2000',
                Rule::unique('academic_semesters')->ignore($id)->where(function ($q) use ($request) {
                    return $q->where('semester', $request->semester);
                }),
            ],
            'semester' => 'required|in:ganjil,genap',
            'start_date' => 'required|date',
            'mid_date' => 'nullable|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $semester->update($request->all());
        return response()->json(['message' => 'Updated']);
    }

    public function destroy($id)
    {
        AcademicSemester::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
