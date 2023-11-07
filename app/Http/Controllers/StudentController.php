<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Activity;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

global $students;

class StudentController extends Controller
{
    // memunculkan data siswa sebagian atau yang dipilih aja
    public function show($id) // public function show yang menerima parameter id
    {
        // buat nyari id siswa misal 1 bernama Aiden dia ekskul PMR
        $student = Student::find($id); // find untuk menemukan id
        return view('show', ['student' => $student]);

        //$name = Student::find($id) -> name; // query untuk mencari student dengan id yang dikirim kemudian akses atribut name kemudian direturn ke view
        // $students = Activity::find($id)->students;

        /* buat nyari nama ekskul dan nama siswa
        $activity = Activity::find($id);
        $students = $activity->students; // query untuk mencari student dengan id yang dikirim kemudian akses atribut name kemudian direturn ke view
        return view('example', ['activity' => $activity,'students' => $students]);
        */

        //$activities = $student->activities; // query untuk mencari student dengan id yang dikirim kemudian akses atribut name kemudian direturn ke view
    }

    // untuk memunculkan semua data siswa
    public function index()
    {
        // mengambil data dari user yang telah login
        $user = Auth::user();
        $id = Auth::id();

        //$students = Student::all(); // mengambil semua data
        $students = Student::paginate(2); // untuk pagination
        // misal ada 3 data dan 2 page, maka data ke 1 dan 2 ada di page 1 dan data ke 3 ada di page 2
        return view('index', ['data' => $students, 'user'=>$user, 'id'=>$id]);
    }

    // menyeleksi data dengan atribut tertentu
    public function filter()
    {
        // where ada 3 parameter yaitu 'score' yang difilter, '>=' karena score angka pake pembanding, 85:sebagai batasan
        $students = Student::where('score', '>=', 85)
            ->where('name', 'LIKE', '%r%') // % digunakan untuk kalo ada nama dengan huruf r dimanapun maka akan tampil
            ->get(); // kalo ada where maka diakhiri dengan get()
        return view('filter', compact('students'));  //kalo mau inisalisasi array denga cepat di php pake compact
    }

    // membuat form tambah data
    public function create()
    {
        return view('create');
    }

    // fungsi untuk menyimpan data ke database
    public function store(Request $request)
    {
        // sebelum menjalankan, harus di validate dulu
        // jika salah satu di form ga diisi maka muncul notif misal nama belum diisi
        $request->validate([
            'name' => 'required',
            'score' => 'required'
        ]);

        Student::create([
            'name' => $request->name,
            'score' => $request->score,
            'teacher_id' => 1
        ]);

        return Redirect::route('index');
    }

    // fungsi edit data
    public function edit(Student $student)
    {
        return view('edit', compact('student'));
    }

    // fungsi untuk menyimpan data yang telah diedit
    // parameter request apa yang dikirim dari form
    // parameter student, student apa yang diupdate
    public function update(Request $request, Student $student)
    {
        // data yang akan diupdate
        $student->update([
            'name' => $request->name,
            'score' => $request->score
        ]);

        return Redirect::route('index');
    }

    // delete data
    public function delete(Student $student)
    {
        $student->delete();
        return Redirect::route('index');
    }
}
