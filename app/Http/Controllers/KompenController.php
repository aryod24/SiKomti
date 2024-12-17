<?php
namespace App\Http\Controllers;

use App\Models\JenisTugas;
use App\Models\KompenModel;
use App\Models\LevelModel;
use App\Models\Kompetensi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
class KompenController extends Controller
{
    // Menampilkan halaman awal kompen
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompen',
            'list'  => ['Home', 'Kompen']
        ];
        $page = (object) [
            'title' => 'Daftar kompen yang terdaftar dalam sistem'
        ];
        $activeMenu = 'kompen'; // set menu yang sedang aktif
        $level = LevelModel::all();
        return view('kompen.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data kompen dalam bentuk json untuk datatables
    public function list(Request $request)
    {
<<<<<<< HEAD
        $kompens = KompenModel::select(
            'UUID_Kompen',
            'nama_kompen',
            'deskripsi',
            'jenis_tugas',
            'quota',
            'jam_kompen',
            'status_dibuka',
            'tanggal_mulai',
            'tanggal_akhir',
            'is_selesai',
            'id_kompetensi',
            'periode_kompen',
            'user_id',
            'nama',
            'level_id' // Add level_id to select fields
        );
    
=======
        // Start building the query
        $kompens = KompenModel::with(['user', 'level']) // Eager load the user and level relationships
            ->select(
                'UUID_Kompen',
                'nama_kompen',
                'deskripsi',
                'jenis_tugas',
                'quota',
                'jam_kompen',
                'status_dibuka',
                'tanggal_mulai',
                'tanggal_akhir',
                'is_selesai',
                'id_kompetensi',
                'periode_kompen',
                'user_id',
                'nama',
                'level_id' // Add level_id to select fields
            );
    
        // Check if the user is logged in as Dosen (level_id 3) or Tendik (level_id 4)
        if (auth()->check()) {
            $userLevel = auth()->user()->level_id; // Get the logged-in user's level_id
            $userId = auth()->user()->user_id; // Get the logged-in user's ID
    
            if ($userLevel == 3 || $userLevel == 4) {
                // Filter kompen based on user_id for level_id 3 and 4
                $kompens->where('user_id', $userId);
            }
        }
    
        // Apply level_id filter if provided
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        if ($request->has('level_id') && $request->level_id != '') {
            $kompens->where('level_id', $request->level_id); // Apply level_id filter if provided
        }
    
<<<<<<< HEAD
        // Return data untuk DataTables
=======
        // Return data for DataTables
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        return DataTables::of($kompens)
            ->addIndexColumn() // Add index column
            ->addColumn('aksi', function ($kompen) {
                // Add action buttons for edit, detail, and delete
                $btn = '<a href="' . url('/kompen/' . $kompen->UUID_Kompen) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/kompen/' . $kompen->UUID_Kompen . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kompen/' . $kompen->UUID_Kompen) . '">'
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // Indicate that the action column contains HTML
            ->make(true);
    }
    
<<<<<<< HEAD
=======
    
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    // Menampilkan halaman form tambah kompen
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kompen',
            'list'  => ['Home', 'Kompen', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah kompen baru'
        ];
        $activeMenu = 'kompen'; // set menu yang sedang aktif
        $kompetensi = Kompetensi::all();
        $jenisTugas = JenisTugas::all();
        return view('kompen.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kompetensi' => $kompetensi,
        'jenisTugas' => $jenisTugas ]);
    }
    // Menyimpan data kompen baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kompen'    => 'required|string|max:100',
            'deskripsi'      => 'nullable|string',
            'jenis_tugas'    => 'nullable|integer',
            'quota'          => 'nullable|integer',
            'jam_kompen'     => 'nullable|integer',
            'status_dibuka'  => 'nullable|boolean',
            'tanggal_mulai'  => 'nullable|date',
            'tanggal_akhir'  => 'nullable|date',
            'is_selesai'     => 'nullable|boolean',
            'id_kompetensi'  => 'nullable|integer',
            'periode_kompen' => 'nullable|string|max:50'
        ]);

        KompenModel::create([
            'UUID_Kompen'    => Str::uuid(),
            'nama_kompen'    => $request->nama_kompen,
            'deskripsi'      => $request->deskripsi,
            'jenis_tugas'    => $request->jenis_tugas,
            'quota'          => $request->quota,
            'jam_kompen'     => $request->jam_kompen,
            'status_dibuka'  => $request->status_dibuka,
            'tanggal_mulai'  => $request->tanggal_mulai,
            'tanggal_akhir'  => $request->tanggal_akhir,
            'is_selesai'     => $request->is_selesai,
            'id_kompetensi'  => $request->id_kompetensi,
            'periode_kompen' => $request->periode_kompen,
            'nama'           => auth()->user()->nama, 
            'user_id'        => auth()->id(),
            'level_id'       => auth()->user()->level_id, 
        ]);
        
        return redirect('/kompen')->with('success', 'Data kompen berhasil disimpan');
        
    
        return redirect('/kompen')->with('success', 'Data kompen berhasil disimpan');
    }

    // Menampilkan detail kompen
    public function show(string $UUID_Kompen)
    {
        $kompen = KompenModel::with(['jenisTugas', 'kompetensi'])->find($UUID_Kompen);
        
        $breadcrumb = (object) [
            'title' => 'Detail Kompen',
            'list' => ['Home', 'Kompen', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail kompen'
        ];
        $activeMenu = 'kompen'; // set menu yang sedang aktif
<<<<<<< HEAD
        return view('kompen.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kompen' => $kompen, 'activeMenu' => $activeMenu, ]);
=======
    
        return view('kompen.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompen' => $kompen,
            'activeMenu' => $activeMenu,
        ]);
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    }
    
    // Menampilkan halaman form edit kompen
    public function edit(string $id)
    {
        $kompen = KompenModel::find($id);
        $breadcrumb = (object) [
            'title' => 'Edit Kompen',
            'list'  => ['Home', 'Kompen', 'Edit']
        ];
        $page = (object) [
            'title' => 'Edit kompen'
        ];
        $activeMenu = 'kompen'; // set menu yang sedang aktif
        $kompetensi = Kompetensi::all();
        $jenisTugas = JenisTugas::all();
        return view('kompen.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kompen' => $kompen, 'activeMenu' => $activeMenu, 'kompetensi' => $kompetensi,
        'jenisTugas' => $jenisTugas ]);
    }
    // Menyimpan perubahan data kompen
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kompen' => 'required|string|max:100', // nama kompen harus diisi dan maksimal 100 karakter
            'deskripsi' => 'nullable|string', // deskripsi boleh kosong
            'jenis_tugas' => 'nullable|integer', // jenis tugas bisa kosong atau integer
            'quota' => 'nullable|integer', // quota bisa kosong atau integer
            'jam_kompen' => 'nullable|integer', // jam kompen bisa kosong atau integer
            'status_dibuka' => 'nullable|boolean', // status dibuka bisa kosong atau boolean
            'tanggal_mulai' => 'nullable|date', // tanggal mulai bisa kosong atau tanggal
            'tanggal_akhir' => 'nullable|date', // tanggal akhir bisa kosong atau tanggal// status selesai bisa kosong atau boolean
            'is_selesai'     => 'nullable|boolean',
            'id_kompetensi'  => 'nullable|integer',
            'periode_kompen' => 'nullable|string|max:50', // periode kompen bisa kosong atau string
        ]);
        KompenModel::find($id)->update([
            'nama_kompen' => $request->nama_kompen,
            'deskripsi' => $request->deskripsi,
            'jenis_tugas' => $request->jenis_tugas,
            'quota' => $request->quota,
            'jam_kompen' => $request->jam_kompen,
            'status_dibuka'  => $request->status_dibuka,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'is_selesai'     => $request->is_selesai,
            'id_kompetensi'  => $request->id_kompetensi,
            'periode_kompen' => $request->periode_kompen,
        ]);
        
        return redirect('/kompen')->with('success', 'Data kompen berhasil diubah');
    }
    // Menghapus data kompen
    public function destroy(string $UUID_Kompen)
    {
        $check = KompenModel::find($UUID_Kompen);
        if (!$check) {  // untuk mengecek apakah data kompen dengan id yang dimaksud ada atau tidak
            return redirect('/kompen')->with('error', 'Data kompen tidak ditemukan');
        }
        try {
            KompenModel::destroy($UUID_Kompen);  // Hapus data kompen
            return redirect('/kompen')->with('success', 'Data kompen berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/kompen')->with('error', 'Data kompen gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    public function create_ajax()
{
    // Ambil data yang diperlukan, misalnya untuk level kompetensi atau data lainnya jika perlu
    $kompetensi = KompenModel::select('id_kompetensi', 'nama_kompetensi')->get();
    return view('kompen.create_ajax')
        ->with('kompetensi', $kompetensi); // Kirim data kompetensi ke view
}
public function store_ajax(Request $request) {
    // Cek apakah request berupa ajax
    if ($request->ajax() || $request->wantsJson()) {
        // Aturan validasi untuk data kompen
        $rules = [
            'nama_kompen'     => 'required|string|min:3|max:100',          // Nama kompen wajib diisi, minimal 3 karakter
            'deskripsi'       => 'nullable|string',                         // Deskripsi kompen boleh kosong
            'jenis_tugas'     => 'required|integer',                        // Jenis tugas wajib diisi dan berupa angka
            'quota'           => 'required|integer|min:1',                  // Quota wajib diisi dan harus angka lebih dari 0
            'jam_kompen'      => 'required|integer|min:1',                  // Jam kompen wajib diisi dan lebih dari 0                       // Status dibuka wajib diisi dan berupa boolean
            'tanggal_mulai'   => 'required|date',                           // Tanggal mulai wajib diisi dengan format tanggal
            'tanggal_akhir'   => 'required|date|after_or_equal:tanggal_mulai', // Tanggal akhir wajib diisi dan setelah tanggal mulai                       // Is selesai wajib diisi dan berupa boolean
            'id_kompetensi'   => 'required|integer', 
            'is_selesai'     => 'nullable|boolean',
            'id_kompetensi'  => 'nullable|integer',                       // ID kompetensi wajib diisi dan berupa angka
            'periode_kompen'  => 'nullable|string|max:50',                  // Periode kompen boleh kosong
        ];
        // Menggunakan Validator untuk memvalidasi input
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Jika validasi gagal, kirimkan pesan error ke frontend
            return response()->json([
                'status' => false, // response status, false: error/gagal, true: berhasil
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(), // pesan error validasi
            ]);
        }
        // Simpan data kompen ke database
        KompenModel::create([
            'nama_kompen'   => $request->nama_kompen,
            'deskripsi'     => $request->deskripsi,
            'jenis_tugas'   => $request->jenis_tugas,
            'quota'         => $request->quota,
            'jam_kompen'    => $request->jam_kompen,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'id_kompetensi' => $request->id_kompetensi,
            'is_selesai'    => $request->is_selesai,
            'periode_kompen'=> $request->periode_kompen,
        ]);
        // Jika berhasil, kirimkan response sukses
        return response()->json([
            'status' => true,
            'message' => 'Data kompen berhasil disimpan'
        ]);
    }
    return redirect('/');
}
}