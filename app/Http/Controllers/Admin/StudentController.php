<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $data = Student::where('account_status', 'verified')->with('faculty', 'user')->orderBy('faculty_id')->get();
            return response()->json(['data' => $data]);
        }

        return view('admin.students.index', [
            'titlePages' => 'Mahasiswa',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'nim'        => 'required|string|max:20|unique:students,nim',
            'email'      => 'required|email|unique:students,email|unique:users,email',
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        // Buat user terlebih dahulu
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('password'), // password default
        ]);

        // Simpan data mahasiswa
        Student::create([
            'user_id'    => $user->id,
            'nim'        => $request->nim,
            'email'      => $request->email,
            'faculty_id' => $request->faculty_id,
        ]);

        return response()->json(['message' => 'Mahasiswa berhasil ditambahkan']);
    }


    public function edit(Student $student)
    {
        $student->load('user');
        return view('admin.students._modal_edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'nim' => [
                'required', 'string', 'max:20',
                Rule::unique('students')->ignore($student->id),
            ],
            'email' => [
                'required', 'email',
                Rule::unique('students')->ignore($student->id),
                Rule::unique('users')->ignore($student->user_id),
            ],
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        // Update student
        $student->update([
            'nim'        => $request->nim,
            'email'      => $request->email,
            'faculty_id' => $request->faculty_id,
        ]);

        // Update user
        $student->user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Data mahasiswa berhasil diperbarui']);
    }

    public function destroy(Student $student)
    {
        // Hapus user terkait terlebih dahulu
        $student->user->delete();

        // Hapus student (relasi user_id sudah tidak berlaku)
        $student->delete();

        return response()->json(['message' => 'Data mahasiswa dan user berhasil dihapus']);
    }
}
