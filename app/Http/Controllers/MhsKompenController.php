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
                    $btn .= '<button onclick="showRequestModal(\'' . $kompen->UUID_Kompen . '\')" class="btn btn-success btn-sm">Request</button>';
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
        $kompen = KompenModel::with(['jenisTugas', 'kompetensi'])->find($UUID_Kompen);
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
        'kelas' => 'nullable|string|max:100', // Adding kelas as nullable
        'semester' => 'nullable|string|max:100', // Adding semester as nullable
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
            'kelas' => $validatedData['kelas'] ?? null, // Adding kelas field
            'semester' => $validatedData['semester'] ?? null, // Adding semester field
        ]);

        return redirect()->route('mhskompen.index', $validatedData['UUID_Kompen'])->with('success', 'Request kompen berhasil diajukan.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal mengajukan request kompen: ' . $e->getMessage());
    }
}

    public function create_ajax($UUID_Kompen)
{
    $kompen = KompenModel::where('UUID_Kompen', $UUID_Kompen)->firstOrFail();
    return view('mhskompen.create_ajax', compact('kompen'))->render();
}

public function store_ajax(Request $request)
{
    $validatedData = $request->validate([
        'ni' => 'required|string|max:18|exists:m_user,ni',
        'nama' => 'required|string|max:100',
        'UUID_Kompen' => 'required|string|size:36|exists:t_kompen,UUID_Kompen',
        'kelas' => 'required|string|max:100', // Adding kelas as nullable
        'semester' => 'required|string|max:100', // Adding semester as nullable
    ]);
    

    $existingRequest = MahasiswaKompen::where('ni', $validatedData['ni'])
        ->where('UUID_Kompen', $validatedData['UUID_Kompen'])
        ->first();

    if ($existingRequest) {
        return response()->json(['error' => 'Anda sudah mengajukan request untuk kompen ini.'], 422);
    }

    try {
        MahasiswaKompen::create([
            'ni' => $validatedData['ni'],
            'nama' => $validatedData['nama'],
            'UUID_Kompen' => $validatedData['UUID_Kompen'],
            'status_Acc' => null,
            'kelas' => $validatedData['kelas'], // Adding kelas field
            'semester' => $validatedData['semester'], // Adding semester field
        ]);
        
        return response()->json(['success' => 'Request kompen berhasil diajukan.']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal mengajukan request kompen: ' . $e->getMessage()], 500);
    }
}
    
}