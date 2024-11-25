<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaKompen;
use App\Models\ProgressModel;
use App\Models\KompenModel;
use Illuminate\Http\Request;

class ApplyApiController extends Controller
{
    public function updateStatus(Request $request)
    {
        $ni = $request->input('ni');
        $UUID_Kompen = $request->input('UUID_Kompen');

        // Fetch the related KompenModel
        $kompen = KompenModel::where('UUID_Kompen', $UUID_Kompen)->firstOrFail();

        // Check if the quota is being exceeded
        $acceptedRequests = MahasiswaKompen::where('UUID_Kompen', $UUID_Kompen)
            ->where('status_Acc', 1)
            ->count();

        // If the accepted requests are already equal to or greater than the quota
        if ($acceptedRequests >= $kompen->quota && $request->status_Acc == 1) {
            return response()->json(['message' => 'Quota already full. Cannot accept more requests.'], 400);
        }

        // Fetch the MahasiswaKompen record
        $mahasiswaKompen = MahasiswaKompen::where('ni', $ni)
            ->where('UUID_Kompen', $UUID_Kompen)
            ->firstOrFail();

        // Check if status_Acc is changing from NULL to 1 (accept request)
        if (is_null($mahasiswaKompen->status_Acc) && $request->status_Acc == 1) {
            $mahasiswaKompen->status_Acc = 1;
            $mahasiswaKompen->save();

            // Create a new record in t_progres_kompen
            ProgressModel::create([
                'nama_progres' => null, // You can customize this value
                'bukti_kompen' => null, // You can customize this value
                'UUID_Kompen' => $mahasiswaKompen->UUID_Kompen,
                'ni' => $mahasiswaKompen->ni,
                'nama' => $mahasiswaKompen->nama,
                'jam_kompen' => $kompen->jam_kompen,
                'status_acc' => null,
            ]);

            return response()->json(['message' => 'Status updated and progress created successfully.'], 200);
        }

        // Check if status_Acc is changing from NULL to 0 (reject request)
        if (is_null($mahasiswaKompen->status_Acc) && $request->status_Acc == 0) {
            $mahasiswaKompen->status_Acc = 0;
            $mahasiswaKompen->save();

            return response()->json(['message' => 'Anda Menolak Request ini'], 200);
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
}
