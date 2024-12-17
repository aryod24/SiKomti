<?php

namespace App\Http\Controllers;

use App\Models\KompenModel;
use App\Models\MahasiswaKompen;
use App\Models\ProgressModel;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class PengajuanKompenController extends Controller
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
        $activeMenu = 'pengajuankompen'; // set menu yang sedang aktif
        return view('pengajuankompen.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

<<<<<<< HEAD
    // Ambil data kompen dalam bentuk json untuk datatables
    public function list(Request $request)
    {
=======
    public function list(Request $request)
    {
        // Start building the query
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
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
<<<<<<< HEAD

        if ($request->has('level_id') && $request->level_id != '') {
            $kompens->where('level_id', $request->level_id); // Apply level_id filter if provided
        }

        // Return data untuk DataTables
        return DataTables::of($kompens)
            ->addIndexColumn() // menambahkan kolom index / nomor urut
            ->addColumn('aksi_request', function ($kompen) {
                return '<button onclick="showRequestModal(\'' . $kompen->UUID_Kompen . '\')" class="btn btn-info btn-sm">Request</button>';
            })
            ->rawColumns(['aksi_request']) // memberitahu bahwa kolom aksi berisi HTML
=======
    
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
            ->addColumn('aksi_request', function ($kompen) {
                return '<button onclick="showRequestModal(\'' . $kompen->UUID_Kompen . '\')" class="btn btn-info btn-sm">Request</button>';
            })
            ->rawColumns(['aksi_request']) // Indicate that the action column contains HTML
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
            ->make(true);
    }

    public function updateStatus(Request $request)
    {
        $ni = $request->input('ni');
        $UUID_Kompen = $request->input('UUID_Kompen');
    
        // Fetch the related KompenModel
        $kompen = KompenModel::where('UUID_Kompen', $UUID_Kompen)->firstOrFail();
    
        // Fetch the MahasiswaKompen record
        $mahasiswaKompen = MahasiswaKompen::where('ni', $ni)
            ->where('UUID_Kompen', $UUID_Kompen)
            ->firstOrFail();
    
        // Check if status_Acc is changing to 1 (accept request)
        if ($request->status_Acc == 1) {
            // Check if the quota is being exceeded
            $acceptedRequests = MahasiswaKompen::where('UUID_Kompen', $UUID_Kompen)
                ->where('status_Acc', 1)
                ->count();
    
            // If the accepted requests are already equal to or greater than the quota
            if ($acceptedRequests >= $kompen->quota) {
                return response()->json(['message' => 'Quota already full. Cannot accept more requests.'], 400);
            }
    
            $mahasiswaKompen->status_Acc = 1;
            $mahasiswaKompen->save();
    
            // Create a new record in t_progres_kompen if not already exists
            ProgressModel::firstOrCreate(
                [
                    'UUID_Kompen' => $mahasiswaKompen->UUID_Kompen,
                    'ni' => $mahasiswaKompen->ni,
                ],
                [
                    'nama_progres' => null, // You can customize this value
                    'bukti_kompen' => null, // You can customize this value
                    'nama' => $mahasiswaKompen->nama,
                    'jam_kompen' => $kompen->jam_kompen,
                    'status_acc' => null,
<<<<<<< HEAD
                ]
            );
=======
                    'kelas' => $mahasiswaKompen->kelas, // Adding kelas field
                    'semester' => $mahasiswaKompen->semester, // Adding semester field
                ]
            );
            
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    
            return response()->json(['message' => 'Status updated and progress created successfully.'], 200);
        }
    
        // Check if status_Acc is changing to 0 (reject request)
        if ($request->status_Acc == 0) {
            $mahasiswaKompen->status_Acc = 0;
            $mahasiswaKompen->save();
    
            return response()->json(['message' => 'Request rejected successfully.'], 200);
        }
    
        return response()->json(['message' => 'No status change or invalid status.'], 400);
    }
    

    public function deleteRequest(Request $request)
    {
        $ni = $request->input('ni');
        $UUID_Kompen = $request->input('UUID_Kompen');

        $mahasiswaKompen = MahasiswaKompen::where('ni', $ni)
            ->where('UUID_Kompen', $UUID_Kompen)
            ->firstOrFail();

        $mahasiswaKompen->delete();

        return response()->json(['message' => 'Request deleted successfully.'], 200);
    }

    public function getKompenRequestByUuid($uuidKompen)
    {
        try {
            // Fetch all kompen requests for the given UUID_Kompen
            $kompenRequests = MahasiswaKompen::where('UUID_Kompen', $uuidKompen)
                ->get();

            if ($kompenRequests->isEmpty()) {
                return response()->json([
                    'message' => 'No kompen request found for this UUID_Kompen',
                ], 404);
            }

            return response()->json([
                'message' => 'Kompen requests fetched successfully.',
                'data' => $kompenRequests,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch kompen requests.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}