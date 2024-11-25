<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MahasiswaKompen;
use App\Models\KompenModel;

class MahasiswaKompenApiController extends Controller
{
    // Mahasiswa mengajukan kompen
    public function createKompenRequest(Request $request)
{
    // Validate input
    $validatedData = $request->validate([
        'ni' => 'required|string|max:18|exists:m_user,ni',
        'nama' => 'required|string|max:100',
        'UUID_Kompen' => 'required|string|size:36|exists:t_kompen,UUID_Kompen',
    ]);

    // Check if the combination of ni and UUID_Kompen already exists
    $existingRequest = MahasiswaKompen::where('ni', $validatedData['ni'])
        ->where('UUID_Kompen', $validatedData['UUID_Kompen'])
        ->first();

    if ($existingRequest) {
        return response()->json([
            'message' => 'You have already submitted a request for this kompen.',
        ], 400); // Bad request as the user has already requested this kompen
    }

    try {
        // Create a new kompen request
        $kompen = MahasiswaKompen::create([
            'ni' => $validatedData['ni'],
            'nama' => $validatedData['nama'], // Adding the nama field
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


public function checkExistingRequest(Request $request)
{
    // Validate input
    $validatedData = $request->validate([
        'ni' => 'required|string|max:18|exists:m_user,ni',
        'UUID_Kompen' => 'required|string|size:36|exists:t_kompen,UUID_Kompen',
    ]);

    // Check if the combination of ni and UUID_Kompen already exists
    $existingRequest = MahasiswaKompen::where('ni', $validatedData['ni'])
        ->where('UUID_Kompen', $validatedData['UUID_Kompen'])
        ->exists();

    return response()->json([
        'exists' => $existingRequest,
    ], 200);
}

// Menampilkan list seluruh kompen yang diajukan oleh mahasiswa
public function getKompenRequests($ni)
{
    try {
        // Fetch all kompen requests for the given ni
        $kompenRequests = MahasiswaKompen::where('ni', $ni)->get();

        if ($kompenRequests->isEmpty()) {
            return response()->json([
                'message' => 'No kompen requests found for this NI.',
            ], 404);
        }

        // Fetch related data from KompenModel and merge it into $kompenRequests
        $kompenData = KompenModel::whereIn('UUID_Kompen', $kompenRequests->pluck('UUID_Kompen'))->get()->keyBy('UUID_Kompen');

        $mergedRequests = $kompenRequests->map(function ($request) use ($kompenData) {
            $request->kompen_details = $kompenData->get($request->UUID_Kompen);
            return $request;
        });

        return response()->json([
            'message' => 'Kompen requests fetched successfully.',
            'data' => $mergedRequests,
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to fetch kompen requests.',
            'error' => $e->getMessage(),
        ], 500);
    }
}



// Menampilkan kompen request berdasarkan UUID_Kompen
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


    // Menampilkan seluruh kompen requests
    public function getAllKompenRequests()
    {
        try {
            // Fetch all kompen requests
            $kompenRequests = MahasiswaKompen::all();

            if ($kompenRequests->isEmpty()) {
                return response()->json([
                    'message' => 'No kompen requests found.',
                ], 404);
            }

            return response()->json([
                'message' => 'All kompen requests fetched successfully.',
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
