<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaAlpha;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataMahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Data Mahasiswa Alpha',
            'list'  => ['Home', 'Data Mahasiswa Alpha']
        ];
        $page = (object) [
            'title' => 'Daftar mahasiswa alpha yang terdaftar dalam sistem'
        ];
        $activeMenu = 'datamahasiswa';
        return view('datamahasiswa.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $mahasiswaAlpha = MahasiswaAlpha::select('id_alpha', 'ni', 'jam_alpha', 'nama', 'semester', 'jam_kompen');
        return DataTables::of($mahasiswaAlpha)
            ->addIndexColumn()
            ->addColumn('aksi', function ($mahasiswaAlpha) {
                $btn = '<a href="' . url('/datamahasiswa/' . $mahasiswaAlpha->id_alpha) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/datamahasiswa/' . $mahasiswaAlpha->id_alpha . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/datamahasiswa/' . $mahasiswaAlpha->id_alpha) . '">'
                    . csrf_field() . method_field('DELETE') . 
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data Mahasiswa Alpha',
            'list'  => ['Home', 'Data Mahasiswa Alpha', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah data mahasiswa alpha baru'
        ];
        $activeMenu = 'datamahasiswa';
        return view('datamahasiswa.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ni' => 'required|string|max:20',
            'jam_alpha' => 'nullable|integer',
            'nama' => 'required|string|max:100',
            'semester' => 'nullable|integer',
            'jam_kompen' => 'nullable|integer',
        ]);

        MahasiswaAlpha::create($request->all());

        return redirect('/datamahasiswa')->with('success', 'Data mahasiswa alpha berhasil disimpan');
    }

    public function show($id_alpha)
    {
        $mahasiswaAlpha = MahasiswaAlpha::findOrFail($id_alpha);

        $breadcrumb = (object)[
            'title' => 'Detail Data Mahasiswa Alpha',
            'list' => ['Home', 'Data Mahasiswa Alpha', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail Data Mahasiswa Alpha'
        ];
        $activeMenu = 'datamahasiswa';
        return view('datamahasiswa.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'mahasiswaAlpha' => $mahasiswaAlpha, 'activeMenu' => $activeMenu]);
    }

    public function edit($id_alpha)
    {
        $mahasiswaAlpha = MahasiswaAlpha::findOrFail($id_alpha);
        $breadcrumb = (object) [
            'title' => 'Edit Data Mahasiswa Alpha',
            'list'  => ['Home', 'Data Mahasiswa Alpha', 'Edit']
        ];
        $page = (object) [
            'title' => 'Edit data mahasiswa alpha'
        ];
        $activeMenu = 'datamahasiswa';
        return view('datamahasiswa.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'mahasiswaAlpha' => $mahasiswaAlpha, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $id_alpha)
    {
        $request->validate([
            'ni' => 'required|string|max:20',
            'jam_alpha' => 'nullable|integer',
            'nama' => 'nullable|string|max:100',
            'semester' => 'nullabke|integer',
            'jam_kompen' => 'nullable|integer',
        ]);

        $mahasiswaAlpha = MahasiswaAlpha::findOrFail($id_alpha);
        $mahasiswaAlpha->update($request->all());

        return redirect('/datamahasiswa')->with('success', 'Data mahasiswa alpha berhasil diubah');
    }

    public function destroy($id_alpha)
    {
        $mahasiswaAlpha = MahasiswaAlpha::findOrFail($id_alpha);
        $mahasiswaAlpha->delete();

        return redirect('/datamahasiswa')->with('success', 'Data mahasiswa alpha berhasil dihapus');
    }
}