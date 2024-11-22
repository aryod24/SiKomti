<?php

namespace App\Http\Controllers;

use App\Models\JenisTugas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisTugasController extends Controller
{
    // Menampilkan halaman daftar jenis tugas
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Jenis Tugas',
            'list'  => ['Home', 'Jenis Tugas']
        ];
        $page = (object) [
            'title' => 'Daftar jenis tugas yang terdaftar dalam sistem'
        ];
        $activeMenu = 'jenistugas'; // set menu yang sedang aktif
        return view('jenistugas.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data jenis tugas dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $jenisTugas = JenisTugas::select('id_tugas', 'jenis_tugas');
        // Return data untuk DataTables
        return DataTables::of($jenisTugas)
            ->addIndexColumn() // menambahkan kolom index / nomor urut
            ->addColumn('aksi', function ($jenisTugas) {
                // Menambahkan kolom aksi untuk edit, detail, dan hapus
                $btn = '<a href="' . url('/jenistugas/' . $jenisTugas->id_tugas) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/jenistugas/' . $jenisTugas->id_tugas . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/jenistugas/' . $jenisTugas->id_tugas) . '">'
                    . csrf_field() . method_field('DELETE') . 
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    // Menampilkan halaman form tambah jenis tugas
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Jenis Tugas',
            'list'  => ['Home', 'Jenis Tugas', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah jenis tugas baru'
        ];
        $activeMenu = 'jenistugas'; // set menu yang sedang aktif
        return view('jenistugas.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data jenis tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis_tugas' => 'required|string|max:100', // jenis tugas harus diisi, berupa string, maksimal 100 karakter
        ]);

        JenisTugas::create([
            'jenis_tugas' => $request->jenis_tugas,
        ]);

        return redirect('/jenistugas')->with('success', 'Jenis tugas berhasil disimpan');
    }

    // Menampilkan detail jenis tugas
    public function show($id_tugas)
    {
        $jenisTugas = JenisTugas::findOrFail($id_tugas);

        $breadcrumb = (object)[
            'title' => 'Detail Jenis Tugas',
            'list' => ['Home', 'Jenis Tugas', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail Jenis Tugas'
        ];
        $activeMenu = 'jenistugas';
        return view('jenistugas.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jenisTugas' => $jenisTugas, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit jenis tugas
    public function edit($id_tugas)
    {
        $jenisTugas = JenisTugas::findOrFail($id_tugas);
        $breadcrumb = (object) [
            'title' => 'Edit Jenis Tugas',
            'list'  => ['Home', 'Jenis Tugas', 'Edit']
        ];
        $page = (object) [
            'title' => 'Edit jenis tugas'
        ];
        $activeMenu = 'jenistugas'; // set menu yang sedang aktif
        return view('jenistugas.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jenisTugas' => $jenisTugas, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data jenis tugas
    public function update(Request $request, $id_tugas)
    {
        $request->validate([
            'jenis_tugas' => 'required|string|max:100', // jenis tugas harus diisi, berupa string, maksimal 100 karakter
        ]);

        $jenisTugas = JenisTugas::findOrFail($id_tugas);
        $jenisTugas->update([
            'jenis_tugas' => $request->jenis_tugas,
        ]);

        return redirect('/jenistugas')->with('success', 'Jenis tugas berhasil diubah');
    }

    // Menghapus data jenis tugas
    public function destroy($id_tugas)
    {
        $jenisTugas = JenisTugas::findOrFail($id_tugas);
        $jenisTugas->delete();

        return redirect('/jenistugas')->with('success', 'Jenis tugas berhasil dihapus');
    }
}
