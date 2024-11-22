<?php

namespace App\Http\Controllers;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KompetensiController extends Controller
    {
        // Menampilkan halaman daftar kompetensi
        public function index()
        {
            $breadcrumb = (object) [
                'title' => 'Daftar Kompetensi',
                'list'  => ['Home', 'Kompetensi']
            ];
            $page = (object) [
                'title' => 'Daftar kompetensi yang terdaftar dalam sistem'
            ];
            $activeMenu = 'kompetensi'; // set menu yang sedang aktif
            return view('kompetensi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
        }
    
        // Ambil data kompetensi dalam bentuk json untuk datatables
        public function list(Request $request)
        {
            $kompetensi = Kompetensi::select('id_kompetensi', 'nama_kompetensi');
            // Return data untuk DataTables
            return DataTables::of($kompetensi)
                ->addIndexColumn() // menambahkan kolom index / nomor urut
                ->addColumn('aksi', function ($kompetensi) {
                    // Menambahkan kolom aksi untuk edit, detail, dan hapus
                    $btn = '<a href="' . url('/kompetensi/' . $kompetensi->id_kompetensi) . '" class="btn btn-info btn-sm">Detail</a> ';
                    $btn .= '<a href="' . url('/kompetensi/' . $kompetensi->id_kompetensi . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kompetensi/' . $kompetensi->id_kompetensi) . '">'
                        . csrf_field() . method_field('DELETE') . 
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                    return $btn;
                })
                ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi berisi HTML
                ->make(true);
        }
    
        // Menampilkan halaman form tambah kompetensi
        public function create()
        {
            $breadcrumb = (object) [
                'title' => 'Tambah Kompetensi',
                'list'  => ['Home', 'Kompetensi', 'Tambah']
            ];
            $page = (object) [
                'title' => 'Tambah kompetensi baru'
            ];
            $activeMenu = 'kompetensi'; // set menu yang sedang aktif
            return view('kompetensi.create', [
                'breadcrumb' => $breadcrumb, 
                'page' => $page, 
                'activeMenu' => $activeMenu,
            ]);
        }
    
        // Menyimpan data kompetensi baru
        public function store(Request $request)
        {
            $request->validate([
                'nama_kompetensi' => 'required|string|max:100', // nama kompetensi wajib diisi dan string dengan maksimal 100 karakter
            ]);
    
            Kompetensi::create([
                'nama_kompetensi' => $request->nama_kompetensi,
            ]);
    
            return redirect('/kompetensi')->with('success', 'Kompetensi berhasil disimpan');
        }
    
        // Menampilkan detail kompetensi
        public function show($id_kompetensi)
        {
            $kompetensi = Kompetensi::findOrFail($id_kompetensi);
            $breadcrumb = (object)[
                'title' => 'Detail Kompetensi',
                'list' => ['Home', 'Kompetensi', 'Detail']
            ];
            $page = (object)[
                'title' => 'Detail Kompetensi'
            ];
            $activeMenu = 'kompetensi';
            return view('kompetensi.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kompetensi' => $kompetensi, 'activeMenu' => $activeMenu]);
        }
    
        // Menampilkan halaman form edit kompetensi
        public function edit($id_kompetensi)
        {
            $kompetensi = Kompetensi::findOrFail($id_kompetensi);
            $breadcrumb = (object) [
                'title' => 'Edit Kompetensi',
                'list'  => ['Home', 'Kompetensi', 'Edit']
            ];
            $page = (object) [
                'title' => 'Edit kompetensi'
            ];
            $activeMenu = 'kompetensi'; // set menu yang sedang aktif
            return view('kompetensi.edit', [
                'breadcrumb' => $breadcrumb, 
                'page' => $page, 
                'kompetensi' => $kompetensi, 
                'activeMenu' => $activeMenu,
            ]);
        }
    
        // Menyimpan perubahan data kompetensi
        public function update(Request $request, $id_kompetensi)
        {
            $request->validate([
                'nama_kompetensi' => 'required|string|max:100', // nama kompetensi wajib diisi dan string dengan maksimal 100 karakter
            ]);
    
            $kompetensi = Kompetensi::findOrFail($id_kompetensi);
            $kompetensi->update([
                'nama_kompetensi' => $request->nama_kompetensi,
            ]);
    
            return redirect('/kompetensi')->with('success', 'Kompetensi berhasil diubah');
        }
    
        // Menghapus data kompetensi
        public function destroy($id_kompetensi)
        {
            $kompetensi = Kompetensi::findOrFail($id_kompetensi);
            $kompetensi->delete();
    
            return redirect('/kompetensi')->with('success', 'Kompetensi berhasil dihapus');
        }
    }
    