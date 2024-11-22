<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MahasiswaKompen;

class MahasiswaKompenController extends Controller
{
    // Mahasiswa mengajukan kompen
    public function createKompenRequest(Request $request)
    {
        $validatedData = $request->validate([
            'ni' => 'required|string|max:18|exists:m_user,ni',
            'UUID_Kompen' => 'required|string|size:36|exists:t_kompen,UUID_Kompen',
        ]);

        try {
            $kompen = MahasiswaKompen::create([
                'ni' => $validatedData['ni'],
                'UUID_Kompen' => $validatedData['UUID_Kompen'],
                'status_Acc' => null, // Default null
            ]);

            return response()->json([
                'message' => 'Kompen request submitted successfully.',
                'data' => $kompen,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to submit kompen request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Dosen mengupdate status acc
    public function updateStatusAcc(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status_Acc' => 'required|boolean',
        ]);

        try {
            $kompen = MahasiswaKompen::findOrFail($id);
            $kompen->update([
                'status_Acc' => $validatedData['status_Acc'],
            ]);

            return response()->json([
                'message' => 'Status updated successfully.',
                'data' => $kompen,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update status.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
