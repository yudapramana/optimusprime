<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon; // pastikan ini ditambahkan

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/student/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $faculties = Faculty::orderBy('name')->get();
        return view('auth.register', compact('faculties'));
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            // Validasi student
            'nim' => ['required', 'string', 'max:20', 'unique:students,nim'],
            'gender' => ['required', 'in:L,P'],
            'birth_place' => ['required', 'string'],
            'birth_date' => ['required', 'date', 'before_or_equal:' . now()->subYears(15)->format('Y-m-d')],
            'phone_number' => ['required', 'string'],
            'address' => ['required', 'string'],
            'enrollment_year' => ['required', 'digits:4', 'integer'],
            'entry_semester' => ['required', 'in:ganjil,genap'],
            'faculty_id' => ['required', 'exists:faculties,id'],
        ], [
            'birth_date.before_or_equal' => 'Tanggal lahir menunjukkan usia kurang dari 15 tahun.',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $user->id,
            'nim' => $data['nim'],
            'name' => $data['name'],
            'gender' => $data['gender'],
            'birth_place' => $data['birth_place'],
            'birth_date' => $data['birth_date'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'enrollment_year' => $data['enrollment_year'],
            'entry_semester' => $data['entry_semester'],
            'status' => 'aktif',
            'faculty_id' => $data['faculty_id'],
        ]);

        return $user;
    }

}
