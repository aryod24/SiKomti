<?php

namespace App\Http\Controllers;

use App\Models\ProgressModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF facade
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HistoryMhsController extends Controller
{
    public function historyKompenMhs()
    {
        $userNi = Auth::user()->ni; // Get the logged-in user's NI

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
                return '<a href="#" class="btn btn-info btn-sm">Detail</a>
                        <a href="' . route('historymhs.exportPdf', $row->id) . '" class="btn btn-success btn-sm">Export PDF</a>';
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