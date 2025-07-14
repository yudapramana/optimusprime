<?php

namespace App\Http\Controllers\Admin\Verification;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class StudentVerificationController extends Controller
{
    public function index()
    {
        $students = Student::with('faculty', 'user')
            ->where('account_status', '!=', 'verified')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.students.verification', [
            'titlePages' => 'Verifikasi Akun Mahasiswa',
            'students' => $students
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
        ]);

        $student->account_status = $request->status;
        $student->save();

        return redirect()->back()->with('success', 'Status akun mahasiswa berhasil diperbarui.');
    }
}
