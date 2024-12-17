<?php
namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];
        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem',
        ];
        $activeMenu = 'user'; // set menu yang sedang aktif
        $level = LevelModel::all(); //ambil data level untuk filter level
        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level ,'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
<<<<<<< HEAD
        $user = UserModel::select('user_id', 'username', 'nama','jurusan','ni', 'level_id')
=======
        $user = UserModel::select('user_id', 'username', 'nama','jurusan','ni','kelas', 'semester', 'level_id')
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
            ->with('level');

        if ($request->level_id){
            $user->where('level_id',$request->level_id);
        }
        return DataTables::of($user)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
    // Menampilkan halaman form tambah user
    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Form Tambah User',
        ];
        $level = LevelModel::all(); // Ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; // Set menu yang sedang aktif
        return view('user.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }
    
    // Menyimpan data user baru
    public function store(Request $request) {
        // Validasi data input
        $request->validate([
<<<<<<< HEAD
             // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik ditabel m_user komol username
            'username' =>'required|string|min:3|unique:m_user,username',
            'nama'     =>'required|string|max:100',
            'jurusan'  => 'nullable|string|max:100',
            'ni'       => 'nullable|string|max:18',
            'password' => 'required|min:5',
            'level_id' =>'required|integer'
=======
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100',
            'jurusan'  => 'nullable|string|max:100',
            'ni'       => 'nullable|string|max:18',
            'kelas'    => 'nullable|string|max:100', // Kelas bersifat opsional
            'semester' => 'nullable|string|max:100', // Semester bersifat opsional
            'password' => 'required|string|min:5', // Password harus diisi
            'level_id' => 'required|integer'
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        ]);
    
        // Simpan data user ke dalam database dengan enkripsi password
        UserModel::create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'jurusan'  => $request->jurusan,
            'ni'       => $request->ni,
<<<<<<< HEAD
            'password' =>  bcrypt($request->password),
=======
            'kelas'    => $request->kelas,
            'semester' => $request->semester,
            'password' => bcrypt($request->password), // Enkripsi password sebelum disimpan
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
            'level_id' => $request->level_id
        ]);
    
        // Redirect dengan pesan sukses
        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }
    
     // Menampilkan halaman detail user
    public function show(string $id){
        $user = usermodel::with('level')->find($id);
        $breadcrumb = (object) [
            'title' => 'Detail user',
            'list' => ['Home','User','Detail']
        ];
        $page = (object)[
            'title'=>'Detail user'
        ];
        $activeMenu = 'user';
        return view('user.show',['breadcrumb' =>$breadcrumb,'page'=>$page,'user'=>$user, 'activeMenu'=>$activeMenu]);
    }
    // Menampilkan halaman form edit user
    public function edit(string $id){
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit user',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit User'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif
        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }
    // Menyimpan perubahan data user
    public function update(Request $request, string $id){
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'nullable|string|max:100',
            'jurusan'  => 'nullable|string|max:100',
            'ni'       => 'nullable|string|max:18',
<<<<<<< HEAD
=======
            'kelas'    => 'nullable|string|max:100', // Adding kelas as nullable
            'semester' => 'nullable|string|max:100',  // Adding semester as nullable
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
            'password' => 'nullable|min:5',
            'level_id' => 'nullable|integer'
        ]);
        $user = UserModel::find($id);

        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'jurusan'  => $request->jurusan,
            'ni'       => $request->ni,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'kelas'    => $request->kelas,
            'semester' => $request->semester,
            'level_id' => $request->level_id
        ]);
        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }
    // Menghapus data user
    public function destroy(string $id)
    {
        // Cek apakah data user dengan ID yang dimaksud ada atau tidak
        $check = UserModel::find($id);

        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }
        try {
            // Hapus data user
            UserModel::destroy($id);
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    public function importMahasiswa(Request $request)
    {
        $rules = [
            'file_mahasiswa' => ['required', 'mimes:xlsx,xls', 'max:1024'], // Allow both .xlsx and .xls
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $file = $request->file('file_mahasiswa');
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, false, true, true);
    
        // Logging the data for debugging
        Log::info('Imported Data:', $data);
    
        $insert = [];
    
        if (count($data) > 1) {
            foreach ($data as $baris => $value) {
                if ($baris > 1) {
                    // Insert data, trimming extra spaces
                    $insert[] = [
                        'level_id' => 2, // level_id for mahasiswa
                        'username' => trim($value['A']),
                        'nama' => trim($value['B']),
                        'jurusan' => trim($value['C']),
                        'ni' => trim($value['D']),
                        'password' => bcrypt(trim($value['E'])),
                        'kelas' => trim($value['F']),
                        'semester' => trim($value['G']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
    
            // Check if the insert array is populated
            Log::info('Data to be inserted:', $insert);
    
            // Insert data into the database
            if (count($insert) > 0) {
                try {
                    UserModel::insertOrIgnore($insert);
                } catch (\Exception $e) {
                    Log::error('Error inserting data: ', ['error' => $e->getMessage()]);
                }
            }
    
            return redirect('/user')->with('success', 'Data mahasiswa berhasil diimport');
        }
    
        return redirect()->back()->with('error', 'Tidak ada data yang diimport');
    }
    
    public function importDosenTendik(Request $request)
    {
        $rules = [
            'file_dosen_tendik' => ['required', 'mimes:xlsx,xls', 'max:1024'], // Allow both .xlsx and .xls
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $file = $request->file('file_dosen_tendik');
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, false, true, true);
    
        // Logging the data for debugging
        Log::info('Imported Data:', $data);
    
        $insert = [];
    
        if (count($data) > 1) {
            foreach ($data as $baris => $value) {
                if ($baris > 1) {
                    // Insert data, allowing jurusan to be null
                    $insert[] = [
                        'level_id' => trim($value['A']), // level_id for dosen or tendik
                        'username' => trim($value['B']),
                        'nama' => trim($value['C']),
                        'jurusan' => trim($value['D']) !== '' ? trim($value['D']) : null, // Allow jurusan to be null
                        'ni' => trim($value['E']),
                        'password' => bcrypt(trim($value['F'])),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
    
            // Check if the insert array is populated
            Log::info('Data to be inserted:', $insert);
    
            // Insert data into the database
            if (count($insert) > 0) {
                try {
                    UserModel::insertOrIgnore($insert);
                } catch (\Exception $e) {
                    Log::error('Error inserting data: ', ['error' => $e->getMessage()]);
                }
            }
    
            return redirect('/user')->with('success', 'Data dosen/tendik berhasil diimport');
        }
    
        return redirect()->back()->with('error', 'Tidak ada data yang diimport');
    }
}