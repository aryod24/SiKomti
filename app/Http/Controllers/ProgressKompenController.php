<?php

namespace App\Http\Controllers;

use App\Models\KompenModel;
use App\Models\ProgressModel;
use App\Models\MahasiswaAlpha;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ProgressKompenController extends Controller
{
    // Menampilkan halaman awal kompen
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompen',
            'list'  => ['Home', 'Kompen']
        ];
        $page = (object) [
            'title' => 'Daftar kompen yang terdaftar dalam sistem'
        ];
        $activeMenu = 'progresskompen'; // set menu yang sedang aktif
        return view('progresskompen.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data kompen dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        // Start building the query
        $kompens = KompenModel::select(
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
                // Filter kompen based on user_id for level_id 3 and 4
                $kompens->where('user_id', $userId);
            }
        }
    
        // Apply level_id filter if provided
        if ($request->has('level_id') && $request->level_id != '') {
            $kompens->where('level_id', $request->level_id); // Apply level_id filter if provided
        }
    
        // Return data for DataTables
        return DataTables::of($kompens)
            ->addIndexColumn() // Add index column
            ->addColumn('aksi_progress', function ($kompen) {
                return '<button onclick="showProgressModal(\'' . $kompen->UUID_Kompen . '\')" class="btn btn-info btn-sm">Progress</button>';
            })
            ->rawColumns(['aksi_progress']) // Indicate that the action column contains HTML
            ->make(true);
    }
    public function updateBukti(Request $request)
{
    $id_progres = $request->input('id_progres');
    $status_acc = $request->input('status_acc');

    // Temukan data progres berdasarkan ID
    $progress = ProgressModel::findOrFail($id_progres);

    // Dapatkan semester dari data progres
    $semesterText = $progress->semester; // Asumsi ada field "semester" di tabel ProgressModel
    preg_match('/\d+/', $semesterText, $matches); // Ekstrak angka dari teks seperti 'Semester 2'
    $semester = isset($matches[0]) ? (int)$matches[0] : null;

    if (is_null($semester)) {
        return response()->json(['message' => 'Invalid semester data.'], 400);
    }

    // Cari mahasiswa di model MahasiswaAlpha berdasarkan NI dan semester
    $mahasiswa = MahasiswaAlpha::where('ni', $progress->ni)
                                ->where('semester', $semester)
                                ->first();

    if (!$mahasiswa) {
        return response()->json(['message' => 'Mahasiswa not found for the given semester.'], 404);
    }

    // Update jam_kompen di model MahasiswaAlpha jika status_acc disetujui
    if ($status_acc == 1) {
        $mahasiswa->jam_kompen += $progress->jam_kompen; // Asumsi ada field jam_kompen di ProgressModel
        $mahasiswa->save();
    }

    // Update status_acc pada tabel ProgressModel
    $progress->status_acc = $status_acc;
    $progress->save();

    if ($status_acc == 1) {
        return response()->json(['message' => 'Progress Diterima.'], 200);
    } elseif ($status_acc == 0) {
        return response()->json(['message' => 'Progress Ditolak.'], 200);
    }

    return response()->json(['message' => 'Invalid status.'], 400);
}

    public function viewBukti($uuidKompen)
    {
        $bukti = ProgressModel::where('UUID_Kompen', $uuidKompen)->get();

        if ($bukti->isEmpty()) {
            return response()->json(['message' => 'No evidence found for the given UUID_Kompen.'], 404);
        }

        return response()->json(['bukti' => $bukti], 200);
    }

    public function selesaikanKompen($uuidKompen)
    {
        $kompen = KompenModel::where('UUID_Kompen', $uuidKompen)->firstOrFail();

        if ($kompen->Is_Selesai == 1) {
            return response()->json(['message' => 'Kompen is already marked as completed.'], 400);
        }

        $kompen->Is_Selesai = 1;
        $kompen->save();

        return response()->json(['message' => 'Kompen marked as completed successfully.'], 200);
    }

    public function showDetailBukti($uuidKompen)
    {
        // Find the progress record based on the UUID_Kompen
        $progress = ProgressModel::where('UUID_Kompen', $uuidKompen)->first();

        if (!$progress || !$progress->bukti_kompen) {
            return response()->json(['message' => 'No bukti found for the given UUID_Kompen.'], 404);
        }

        // Get the path of the bukti file
        $filePath = storage_path('app/' . $progress->bukti_kompen);

        // Check if the file exists
        if (!file_exists($filePath)) {
            return response()->json(['message' => 'Bukti file not found.'], 404);
        }

        // Return the file as a download response
        return response()->download($filePath, basename($filePath));
    }

    public function showDownloadBukti($uuidKompen, $idProgres)
    {
        // Find the progress record based on the UUID_Kompen and id_progres
        $progress = ProgressModel::where('UUID_Kompen', $uuidKompen)
                                  ->where('id_progres', $idProgres)
                                  ->first();

        if (!$progress) {
            return response()->json(['message' => 'No progress found for the given UUID_Kompen and id_progres.'], 404);
        }

        // Return the entire progress details as a response
        return response()->json(['progress_details' => $progress], 200);
 
    }
    
}
