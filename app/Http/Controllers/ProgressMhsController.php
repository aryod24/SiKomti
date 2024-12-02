<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaKompen;
use App\Models\ProgressModel;
use App\Models\KompenModel;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

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
        $kompenRequests = MahasiswaKompen::with(['kompen', 'progress'])
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
                $buttons = '<button onclick="showDetail(\'' . $request->id_MahasiswaKompen . '\')" class="btn btn-info btn-sm mr-1">Detail</button>';
                
                if ($request->status_Acc == 1) {
                    $buttons .= '<button onclick="uploadBukti(\'' . $request->UUID_Kompen . '\')" class="btn btn-primary btn-sm mr-1">Upload Bukti</button>';
                    
                    $progress = $request->progress()->first();
                    if ($progress && $progress->bukti_kompen) {
                        $buttons .= '<button onclick="viewBukti(\'' . $request->UUID_Kompen . '\')" class="btn btn-success btn-sm">Lihat Bukti</button>';
                    }
                }
                
                return $buttons;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function showAjaxReq($id)
    {
        $kompenRequest = MahasiswaKompen::with('kompen')->findOrFail($id);
        return view('progressmhs.show_ajaxreq', compact('kompenRequest'));
    }

    public function createBukti($uuidKompen)
    {
        $mahasiswaKompen = MahasiswaKompen::where('UUID_Kompen', $uuidKompen)->firstOrFail();
        $progress = ProgressModel::where('UUID_Kompen', $uuidKompen)->first() ?? new ProgressModel();
        
        return view('progressmhs.create_bukti', [
            'mahasiswaKompen' => $mahasiswaKompen,
            'progress' => $progress,
            'uuidKompen' => $uuidKompen
        ]);
    }

    public function uploadBukti(Request $request)
    {
        $request->validate([
            'UUID_Kompen' => 'required',
            'nama_progres' => 'required|string|max:255',
            'bukti_kompen' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,zip|max:4048',
        ]);

        $progress = ProgressModel::where('UUID_Kompen', $request->UUID_Kompen)->first();
        
        if (!$progress) {
            $progress = new ProgressModel();
            $progress->UUID_Kompen = $request->UUID_Kompen;
            $progress->id_progres = Str::uuid();
        }

        $file = $request->file('bukti_kompen');
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        $file->storeAs('public/bukti_kompen', $fileName);

        $progress->nama_progres = $request->nama_progres;
        $progress->bukti_kompen = $fileName;
        $progress->save();

        return response()->json([
            'success' => true,
            'message' => 'Bukti kompen berhasil diupload.',
            'file_name' => $fileName,
            'file_url' => "/storage/bukti_kompen/$fileName"
        ], 200);
    }

    public function viewBukti($uuidKompen)
    {
        $progress = ProgressModel::where('UUID_Kompen', $uuidKompen)->firstOrFail();
        return view('progressmhs.show_bukti', compact('progress'));
    }

    public function downloadBukti($uuidKompen)
    {
        $progress = ProgressModel::where('UUID_Kompen', $uuidKompen)->firstOrFail();
        
        if (!$progress->bukti_kompen) {
            return response()->json(['message' => 'Bukti tidak ditemukan'], 404);
        }

        $filePath = storage_path('app/public/bukti_kompen/' . $progress->bukti_kompen);
        
        if (!file_exists($filePath)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        return response()->download($filePath, $progress->bukti_kompen);
    }
}