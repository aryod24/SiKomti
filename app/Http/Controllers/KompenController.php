<?php
namespace App\Http\Controllers;

use App\Models\KompenModel;
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
        return view('kompen.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data kompen dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $kompens = KompenModel::select('UUID_Kompen', 'nama_kompen', 'deskripsi', 'jenis_tugas', 'quota', 'jam_kompen', 'status_dibuka', 'tanggal_mulai', 'tanggal_akhir', 'Is_Selesai', 'periode_kompen');
        
        // Return data untuk DataTables
        return DataTables::of($kompens)
            ->addIndexColumn() // menambahkan kolom index / nomor urut
            ->addColumn('aksi', function ($kompen) {
                // Menambahkan kolom aksi untuk edit, detail, dan hapus
                $btn = '<a href="' . url('/kompen/' . $kompen->UUID_Kompen) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/kompen/' . $kompen->UUID_Kompen . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kompen/' . $kompen->UUID_Kompen) . '">'
                    . csrf_field() . method_field('DELETE') . 
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

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
        return view('kompen.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data kompen baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kompen' => 'required|string|max:100', // nama kompen harus diisi dan maksimal 100 karakter
            'deskripsi' => 'nullable|string', // deskripsi boleh kosong
            'jenis_tugas' => 'nullable|integer', // jenis tugas bisa kosong atau integer
            'quota' => 'nullable|integer', // quota bisa kosong atau integer
            'jam_kompen' => 'nullable|integer', // jam kompen bisa kosong atau integer // status dibuka bisa kosong atau boolean
            'tanggal_mulai' => 'nullable|date', // tanggal mulai bisa kosong atau tanggal
            'tanggal_akhir' => 'nullable|date', // tanggal akhir bisa kosong atau tanggal // status selesai bisa kosong atau boolean
            'periode_kompen' => 'nullable|string|max:50', // periode kompen bisa kosong atau string
        ]);

        KompenModel::create([
            'nama_kompen' => $request->nama_kompen,
            'deskripsi' => $request->deskripsi,
            'jenis_tugas' => $request->jenis_tugas,
            'quota' => $request->quota,
            'jam_kompen' => $request->jam_kompen,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'periode_kompen' => $request->periode_kompen,
        ]);

        return redirect('/kompen')->with('success', 'Data kompen berhasil disimpan');
    }

    // Menampilkan detail kompen
    public function show(string $UUID_Kompen)
    {
        $kompen = KompenModel::find($UUID_Kompen);
        $breadcrumb = (object) [
            'title' => 'Detail Kompen',
            'list'  => ['Home', 'Kompen', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail kompen'
        ];
        $activeMenu = 'kompen'; // set menu yang sedang aktif
        return view('kompen.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kompen' => $kompen, 'activeMenu' => $activeMenu]);
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
        return view('kompen.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kompen' => $kompen, 'activeMenu' => $activeMenu]);
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
            'periode_kompen' => 'nullable|string|max:50', // periode kompen bisa kosong atau string
        ]);

        KompenModel::find($id)->update([
            'nama_kompen' => $request->nama_kompen,
            'deskripsi' => $request->deskripsi,
            'jenis_tugas' => $request->jenis_tugas,
            'quota' => $request->quota,
            'jam_kompen' => $request->jam_kompen,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'periode_kompen' => $request->periode_kompen,
        ]);
        
        return redirect('/kompen')->with('success', 'Data kompen berhasil diubah');
    }

    // Menghapus data kompen
    public function destroy(string $id)
    {
        $check = KompenModel::find($id);
        if (!$check) {  // untuk mengecek apakah data kompen dengan id yang dimaksud ada atau tidak
            return redirect('/kompen')->with('error', 'Data kompen tidak ditemukan');
        }

        try {
            KompenModel::destroy($id);  // Hapus data kompen

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
            'id_kompetensi'   => 'required|integer',                        // ID kompetensi wajib diisi dan berupa angka
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
