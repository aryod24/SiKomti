<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgressModel;
use App\Models\KompenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplyBuktiController extends Controller
{
    public function updateBukti(Request $request)
    {
        $id_progres = $request->input('id_progres');
        $status_acc = $request->input('status_acc');

        $progress = ProgressModel::findOrFail($id_progres);

        // Update the status_acc field
        $progress->status_acc = $status_acc;
        $progress->save();

        if ($status_acc == 1) {
            return response()->json(['message' => 'Request approved successfully.'], 200);
        } elseif ($status_acc == 0) {
            return response()->json(['message' => 'Request rejected successfully.'], 200);
        }

        return response()->json(['message' => 'Invalid status.'], 400);
    }

    public function deleteRequest(Request $request)
    {
        $id_progres = $request->input('id_progres');

        $progress = ProgressModel::findOrFail($id_progres);
        $progress->delete();

        return response()->json(['message' => 'Request deleted successfully.'], 200);
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

    public function uploadBukti(Request $request)
    {
        // Validate the request
        $request->validate([
            'id_progres' => 'required|exists:t_progres_kompen,id_progres', // Ensure the progress ID exists
            'nama_progres' => 'required|string|max:255',
            'bukti_kompen' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,zip|max:4048', // Max file size 4MB
        ]);
    
        // Retrieve the progress
        $progress = ProgressModel::findOrFail($request->input('id_progres'));
    
        // Handle the file upload
        $file = $request->file('bukti_kompen');
        $fileName = $file->getClientOriginalName(); // Use the original file name
    
        // Store the file in the 'bukti_kompen' directory but only save the file name in the database
        $file->storeAs('public/bukti_kompen', $fileName);
    
        // Save the file information in the database
        $progress->nama_progres = $request->input('nama_progres');
        $progress->bukti_kompen = $fileName; // Save only the file name
        $progress->save();
    
        // Return a success response
        return response()->json([
            'message' => 'Bukti kompen uploaded successfully.',
            'file_name' => $fileName,
            'file_url' => "/storage/bukti_kompen/$fileName" // Directly reference the relative path
        ], 200);
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
    public function viewProgressKompen($ni)
{
    // Ambil data progres berdasarkan ni (Nomor Induk) mahasiswa
    $progress = ProgressModel::where('ni', $ni)->get();

    // Jika tidak ada data progres ditemukan
    if ($progress->isEmpty()) {
        return response()->json(['message' => 'No progress found for the given NI.'], 404);
    }

    // Jika data progres ditemukan, kembalikan dalam bentuk JSON
    return response()->json(['progress' => $progress], 200);
}

}
