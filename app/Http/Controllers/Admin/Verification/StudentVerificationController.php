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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $students = Student::with('faculty', 'user')
                ->where('account_status', '!=', 'verified')
                ->orderBy('created_at', 'desc')
                ->get();

            return datatables()->of($students)
                ->addIndexColumn()
                ->addColumn('photo', fn($student) => '<img src="' . ($student->photo_url ?? asset('images/default-avatar.png')) . '" class="img-circle" width="40" height="40">')
                ->addColumn('faculty', fn($student) => $student->faculty->name ?? '-')
                ->addColumn('status', function ($student) {
                    $badgeClass = match ($student->account_status) {
                        'pending' => 'warning',
                        'verified' => 'success',
                        'rejected' => 'danger',
                        default => 'secondary',
                    };
                    return '<span class="badge badge-' . $badgeClass . '">' . ucfirst($student->account_status) . '</span>';
                })
                ->addColumn('action', function ($student) {
                    $statusOptions = '
                        <div class="d-flex align-items-center">
                            <select class="form-control form-control-sm status-select me-2 mr-2" data-id="' . $student->id . '">
                                <option value="">-- Pilih --</option>
                                <option value="verified" ' . ($student->account_status === 'verified' ? 'selected' : '') . '>Verifikasi</option>
                                <option value="rejected" ' . ($student->account_status === 'rejected' ? 'selected' : '') . '>Tolak</option>
                            </select>
                            <button class="btn btn-sm btn-primary btn-save-status" data-id="' . $student->id . '">Simpan</button>
                        </div>';
                    return $statusOptions;
                })
                ->rawColumns(['photo', 'status', 'action'])
                ->make(true);
        }

        return view('admin.students.verification', [
            'titlePages' => 'Verifikasi Akun Mahasiswa'
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected'
        ]);

        $student = Student::findOrFail($id);
        $student->account_status = $request->status;
        $student->save();

        return response()->json(['message' => 'Status akun berhasil diperbarui.']);
    }
}
