<?php

namespace App\Http\Controllers;

use App\Models\ProgressModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\KompenModel;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HistoryMhsController extends Controller
{
    public function historyKompenMhs()
    {
        $userNi = Auth::user()->ni;

        $progress = ProgressModel::where('ni', $userNi)
            ->where('status_acc', 1)
            ->whereHas('kompen', function ($query) {
                $query->where('Is_Selesai', 1);
            })
            ->with(['kompen.user'])
            ->get();

        return DataTables::of($progress)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '<a href="' . route('historymhs.show', $row->UUID_Kompen) . '" class="btn btn-info btn-sm">Detail</a>
                        <a href="' . route('historymhs.exportPdf', $row->UUID_Kompen) . '" class="btn btn-success btn-sm">Export PDF</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
    public function indexMhs()
    {
        $breadcrumb = (object) [
            'title' => 'History Kompen Mahasiswa',
            'list'  => ['Home', 'Kompen', 'History']
        ];
        $page = (object) [
            'title' => 'History kompen yang telah diselesaikan oleh mahasiswa'
        ];
        $activeMenu = 'history_mahasiswa';

        return view('historymhs.kompen_mahasiswa', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function show($UUID_Kompen)
    {
        $kompen = KompenModel::with(['user', 'level', 'jenisTugas', 'kompetensi', 'progresKompen' => function($query) {
            $query->where('status_acc', 1);
        }])->find($UUID_Kompen);
    
        if (!$kompen) {
            abort(404, 'Data kompen tidak ditemukan');
        }
    
        $breadcrumb = (object) [
            'title' => 'Detail Kompen',
            'list' => ['Home', 'History Kompen', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail Kompen'
        ];
        $activeMenu = 'historymhs'; // set menu yang sedang aktif
    
        return view('historymhs.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompen' => $kompen,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function exportPdf($UUID_Kompen)
{
    $ni = auth()->user()->ni; // Ambil 'ni' dari pengguna yang sedang login

    // Cek apakah progress dengan UUID_Kompen dan ni ada
    $progress = ProgressModel::where('UUID_Kompen', $UUID_Kompen)
                             ->where('ni', $ni)
                             ->firstOrFail();
    
                             $qrCode = QrCode::size(150)->generate(
                                "Kompen: " . $progress->kompen->nama_kompen . "\n\n" .
                                "UUID: " . $progress->UUID_Kompen . "\n\n" .
                                "Oleh: " . $progress->kompen->user->nama . "\n\n" .
                                "Jam Kompen: " . $progress->kompen->jam_kompen . " jam"
                            );
                            

    $pdf = Pdf::loadView('historymhs.export_pdf', compact('progress', 'qrCode'));
    return $pdf->stream('historymhs_mahasiswa.pdf');
}
}