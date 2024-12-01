<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaKompen;
use App\Models\KompenModel;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProgressMhsController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Progress Kompen',
            'list'  => ['Home', 'Progress']
        ];
        $page = (object) [
            'title' => 'Daftar Progress Kompen'
        ];
        $activeMenu = 'progressmhs';

        return view('progressmhs.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list($ni)
    {
        $kompenRequests = MahasiswaKompen::with('kompen')
            ->where('ni', $ni)
            ->select('m_mahasiswa_kompen.*');

        return DataTables::of($kompenRequests)
            ->addIndexColumn()
            ->addColumn('nama_kompen', function ($request) {
                return $request->kompen->nama_kompen;
            })
            ->addColumn('pembuat_tugas', function ($request) {
                return $request->kompen->nama;
            })
            ->addColumn('status', function ($request) {
                if ($request->status_Acc === null) {
                    return 'Menunggu';
                } elseif ($request->status_Acc == 1) {
                    return 'Disetujui';
                } else {
                    return 'Ditolak';
                }
            })
            ->addColumn('aksi', function ($request) {
                return '<button onclick="showDetail(\'' . $request->id_MahasiswaKompen . '\')" class="btn btn-info btn-sm">Detail</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function showAjaxReq($id)
    {
        $kompenRequest = MahasiswaKompen::with('kompen')->findOrFail($id);
        return view('progressmhs.show_ajaxreq', compact('kompenRequest'));
    }
}