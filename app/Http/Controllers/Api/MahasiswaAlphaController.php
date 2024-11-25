<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaAlpha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaAlphaController extends Controller
{
    public function index()
    {
        // Load all mahasiswa alpha
        return MahasiswaAlpha::all();
    }

    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'ni'          => 'required|string|max:18|exists:m_user,ni',
            'nama'     => 'required|string|max:100',
            'jam_alpha'   => 'required|integer',
            'semester'    => 'required|string|max:10',
            'jam_kompen'  => 'nullable|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Create mahasiswa alpha
        $mahasiswaAlpha = MahasiswaAlpha::create($request->all());
    
        return response()->json([
            'message' => 'Data mahasiswa alpha berhasil ditambahkan.',
            'data'    => $mahasiswaAlpha,
        ], 201);
    }
    

    public function show(MahasiswaAlpha $mahasiswaAlpha)
    {
        // Show specific mahasiswa alpha
        return response()->json($mahasiswaAlpha);
    }

    public function showByNi($ni)
    {
        // Validate ni
        if (!$ni) {
            return response()->json(['message' => 'NI tidak ditemukan'], 400);
        }

        // Find mahasiswa alpha by ni and group by semester
        $mahasiswaAlpha = MahasiswaAlpha::where('ni', $ni)
                             ->orderBy('semester', 'asc')
                             ->get();

        if ($mahasiswaAlpha->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($mahasiswaAlpha);
    }

    public function update(Request $request, MahasiswaAlpha $mahasiswaAlpha)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'ni'          => 'sometimes|string|max:18|exists:m_user,ni',
            'nama'     => 'sometimes|string|max:100',
            'jam_alpha'   => 'sometimes|integer',
            'semester'    => 'sometimes|string|max:10',
            'jam_kompen'  => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update mahasiswa alpha
        $mahasiswaAlpha->update($request->all());

        return response()->json([
            'status'  => true,
            'data'    => $mahasiswaAlpha,
            'message' => 'Data mahasiswa alpha berhasil diperbarui',
        ], 200);
    }

    public function destroy(MahasiswaAlpha $mahasiswaAlpha)
    {
        $mahasiswaAlpha->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
    }
}
