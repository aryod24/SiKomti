<?php
namespace App\Http\Controllers;

use App\Models\JenisTugas;
use App\Models\KompenModel;
use App\Models\LevelModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Kompetensi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class HistoryKompenController extends Controller
{
    // Menampilkan halaman awal history kompen
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Riwayat Kompen',
            'list'  => ['Home', 'History Kompen']
        ];
        $page = (object) [
            'title' => 'Riwayat kompensasi yang telah selesai'
        ];
        $activeMenu = 'history_kompen'; // set menu yang sedang aktif
        $level = LevelModel::all();
        return view('history_kompen.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data history kompen dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        // Start building the query
        $historyKompen = KompenModel::with(['user', 'level']) // Eager load the user and level relationships
            ->where('is_selesai', true) // Filter hanya data yang sudah selesai
            ->select(
                'UUID_Kompen',
                'nama_kompen',
                'deskripsi',
                'jenis_tugas',
                'quota',
                'jam_kompen',
                'status_dibuka',
                'tanggal_mulai',
                'tanggal_akhir',
                'is_selesai',
                'id_kompetensi',
                'periode_kompen',
                'user_id',
                'nama',
                'level_id' // Add level_id to select fields
            );

        // Check if the user is logged in as Dosen (level_id 3) or Tendik (level_id 4)
        if (auth()->check()) {
            $userLevel = auth()->user()->level_id; // Get the logged-in user's level_id
            $userId = auth()->user()->user_id; // Get the logged-in user's ID

            if ($userLevel == 3 || $userLevel == 4) {
                // Filter history kompen based on user_id for level_id 3 and 4
                $historyKompen->where('user_id', $userId);
            }
        }

        // Apply level_id filter if provided
        if ($request->has('level_id') && $request->level_id != '') {
            $historyKompen->where('level_id', $request->level_id); // Apply level_id filter if provided
        }

        // Return data for DataTables
        return DataTables::of($historyKompen)
            ->addIndexColumn() // Add index column
            ->addColumn('aksi', function ($kompen) {
                // Add action buttons for detail and download (if applicable)
                $btn = '<a href="' . url('/history-kompen/' . $kompen->UUID_Kompen) . '" class="btn btn-info btn-sm">Detail</a> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Indicate that the action column contains HTML
            ->make(true);
    }

    public function show($UUID_Kompen)
    {
        $kompen = KompenModel::with(['user', 'level', 'jenisTugas', 'kompetensi', 'progresKompen' => function($query) {
            $query->where('status_acc', 1);
        }])->find($UUID_Kompen);
    
        if (!$kompen) {
            abort(404, 'Data kompen tidak ditemukan');
        }
    
        // Generate QR Code
        $qrCode = QrCode::size(150)->generate(
            'Anda telah menyelesaikan ' . $kompen->nama_kompen . ' dengan UUID: ' . $kompen->UUID_Kompen . "\n" .
            'Oleh: ' . $kompen->user->nama . "\n" .
            'Jam Kompen berjumlah: ' . $kompen->jam_kompen . "\n"
        );
    
        $breadcrumb = (object) [
            'title' => 'Detail Kompen',
            'list' => ['Home', 'History Kompen', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail Kompen'
        ];
        $activeMenu = 'history_kompen'; // set menu yang sedang aktif
    
        return view('history_kompen.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompen' => $kompen,
            'activeMenu' => $activeMenu,
            'qrCode' => $qrCode, // Kirim QR Code ke view
        ]);
    }
}