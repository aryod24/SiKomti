<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KompenModel;
use App\Models\MahasiswaKompen;
use Yajra\DataTables\Facades\DataTables;

class MhsKompenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompen',
            'list'  => ['Home', 'Kompen']
        ];
        $page = (object) [
            'title' => 'Daftar kompen yang tersedia'
        ];
        $activeMenu = 'mhskompen';
        return view('mhskompen.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list()
{
    $kompens = KompenModel::select('UUID_Kompen', 'nama_kompen', 'deskripsi', 'quota', 'jam_kompen', 'tanggal_mulai', 'tanggal_akhir', 'status_dibuka');

    return DataTables::of($kompens)
        ->addIndexColumn()
        ->addColumn('aksi', function ($kompen) {
            $btn = '<a href="' . route('mhskompen.show', $kompen->UUID_Kompen) . '" class="btn btn-info btn-sm">Detail</a> ';
            if ($kompen->status_dibuka == 1) {
                $btn .= '<a href="' . route('mhskompen.create', ['UUID_Kompen' => $kompen->UUID_Kompen]) . '" class="btn btn-success btn-sm">Request</a>';
            } else {
                $btn .= '<button class="btn btn-secondary btn-sm" disabled>Ditutup</button>';
            }
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}


    public function show($UUID_Kompen)
    {
        $kompen = KompenModel::where('UUID_Kompen', $UUID_Kompen)->firstOrFail();
        $kompenRequests = MahasiswaKompen::where('UUID_Kompen', $UUID_Kompen)->get();

        $breadcrumb = (object) [
            'title' => 'Detail Kompen',
            'list'  => ['Home', 'Kompen', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail kompen dan daftar request'
        ];
        $activeMenu = 'mhskompen';

        return view('mhskompen.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'kompen' => $kompen,
            'kompenRequests' => $kompenRequests
        ]);
    }

    public function create($UUID_Kompen)
    {
        $kompen = KompenModel::where('UUID_Kompen', $UUID_Kompen)->firstOrFail();
        
        $breadcrumb = (object) [
            'title' => 'Request Kompen',
            'list'  => ['Home', 'Kompen', 'Request']
        ];
        $page = (object) [
            'title' => 'Request Kompen'
        ];
        $activeMenu = 'mhskompen';
    
        return view('mhskompen.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'kompen' => $kompen
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ni' => 'required|string|max:18|exists:m_user,ni',
            'nama' => 'required|string|max:100',
            'UUID_Kompen' => 'required|string|size:36|exists:t_kompen,UUID_Kompen',
        ]);
    
        $existingRequest = MahasiswaKompen::where('ni', $validatedData['ni'])
            ->where('UUID_Kompen', $validatedData['UUID_Kompen'])
            ->first();
    
        if ($existingRequest) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan request untuk kompen ini.');
        }
    
        try {
            MahasiswaKompen::create([
                'ni' => $validatedData['ni'],
                'nama' => $validatedData['nama'],
                'UUID_Kompen' => $validatedData['UUID_Kompen'],
                'status_Acc' => null,
            ]);
    
            return redirect()->route('mhskompen.index', $validatedData['UUID_Kompen'])->with('success', 'Request kompen berhasil diajukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengajukan request kompen: ' . $e->getMessage());
        }
    }
    
}