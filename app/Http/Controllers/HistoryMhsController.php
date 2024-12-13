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

    public function exportPdf($UUID_Kompen)
    {
        $progress = ProgressModel::where('UUID_Kompen', $UUID_Kompen)->firstOrFail();
        
        // Generate QR code for single entry
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
        
        // Load view and generate PDF
        $pdf = Pdf::loadView('historymhs.export_pdf', compact('progress', 'qrCode'));
        return $pdf->stream('history_kompen_mahasiswa.pdf');
    }
}
