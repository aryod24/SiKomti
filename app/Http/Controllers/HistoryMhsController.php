<?php

namespace App\Http\Controllers;

use App\Models\ProgressModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF facade
=======
use App\Models\KompenModel;
use Barryvdh\DomPDF\Facade\Pdf;
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HistoryMhsController extends Controller
{
    public function historyKompenMhs()
    {
<<<<<<< HEAD
        $userNi = Auth::user()->ni; // Get the logged-in user's NI
=======
        $userNi = Auth::user()->ni;
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4

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
<<<<<<< HEAD
                return '<a href="#" class="btn btn-info btn-sm">Detail</a>
                        <a href="' . route('historymhs.exportPdf', $row->id) . '" class="btn btn-success btn-sm">Export PDF</a>';
=======
                return '<a href="' . route('historymhs.show', $row->UUID_Kompen) . '" class="btn btn-info btn-sm">Detail</a>
                        <a href="' . route('historymhs.exportPdf', $row->UUID_Kompen) . '" class="btn btn-success btn-sm">Export PDF</a>';
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
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

<<<<<<< HEAD
    public function exportPdf()
    {
        // Assume $progress is predefined or fetched differently, not by ID
        $progress = ProgressModel::first(); // Example: Fetch the first progress entry
        
        // Check if progress is found
        if (!$progress) {
            return response()->json(['error' => 'Progress not found'], 404);
        }
    
        // Generate QR code for single entry
        $qrCode = QrCode::size(150)->generate('UUID_Kompen: ' . $progress->UUID_Kompen);
        
        // Load view and generate PDF
        $pdf = Pdf::loadView('historymhs.export_pdf', compact('progress', 'qrCode'));
        return $pdf->stream('history_kompen_mahasiswa.pdf');
    }
}
=======
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
        $progress = ProgressModel::where('UUID_Kompen', $UUID_Kompen)->firstOrFail();
        
        $qrCode = QrCode::size(150)->generate(
            'Anda telah menyelesaikan ' . $progress->kompen->nama_kompen . ' dengan UUID: ' . $progress->UUID_Kompen . "\n" .
            'Oleh: ' . $progress->kompen->user->nama . "\n" .
            'Jam Kompen berjumlah: ' . $progress->kompen->jam_kompen . "\n" .
            'Detail Mahasiswa:' . "\n" .
            'Nama: ' . $progress->nama . "\n" .
            'NIM: ' . $progress->ni . "\n" .
            'Kelas: ' . $progress->kelas . "\n" .
            'Semester: ' . $progress->semester
        );        
        
        $pdf = Pdf::loadView('historymhs.export_pdf', compact('progress', 'qrCode'));
        return $pdf->stream('historymhs_mahasiswa.pdf');
    }
}
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
