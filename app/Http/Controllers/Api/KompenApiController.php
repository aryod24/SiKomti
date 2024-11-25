<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\KompenModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KompenApiController extends Controller
{
    // Mendapatkan daftar kompen
    public function index(Request $request)
    {
        $userId = $request->query('user_id'); // Mengambil parameter user_id dari query string

        if ($userId) {
            $kompens = KompenModel::where('user_id', $userId)->get(); // Mendapatkan kompen berdasarkan user_id
        } else {
            $kompens = KompenModel::all(); // Mendapatkan semua kompen jika user_id tidak ada
        }

        return response()->json(['status' => true, 'data' => $kompens], 200);
    }


    // Mendapatkan detail kompen berdasarkan UUID
    public function show($UUID_Kompen)
    {
        $kompen = KompenModel::find($UUID_Kompen);
        
        if ($kompen) {
            return response()->json(['status' => true, 'data' => $kompen], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Data kompen tidak ditemukan'], 404);
        }
    }

    // Menyimpan data kompen baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kompen'    => 'required|string|max:100',
            'deskripsi'      => 'nullable|string',
            'jenis_tugas'    => 'nullable|integer',
            'quota'          => 'nullable|integer',
            'jam_kompen'     => 'nullable|integer',
            'status_dibuka'  => 'nullable|boolean',
            'tanggal_mulai'  => 'nullable|date',
            'tanggal_akhir'  => 'nullable|date|after_or_equal:tanggal_mulai',
            'is_selesai'     => 'nullable|boolean',
            'id_kompetensi'  => 'nullable|integer',
            'periode_kompen' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            Log::error('Validasi gagal', ['errors' => $validator->errors()]);
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        try {

            $kompen = KompenModel::create([
                'UUID_Kompen'    => Str::uuid(),
                'nama_kompen'    => $request->nama_kompen,
                'deskripsi'      => $request->deskripsi,
                'jenis_tugas'    => $request->jenis_tugas,
                'quota'          => $request->quota,
                'jam_kompen'     => $request->jam_kompen,
                'status_dibuka'  => $request->status_dibuka,
                'tanggal_mulai'  => $request->tanggal_mulai,
                'tanggal_akhir'  => $request->tanggal_akhir,
                'is_selesai'     => $request->is_selesai,
                'id_kompetensi'  => $request->id_kompetensi,
                'periode_kompen' => $request->periode_kompen,
                'nama'        => $request->nama, // Mengisi user_id secara otomatis
                'level_id'       => $request->level_id, // Mengisi level_id secara otomatis
            ]);

            return response()->json(['status' => true, 'data' => $kompen, 'message' => 'Data kompen berhasil disimpan'], 201);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat menyimpan kompen', ['error' => $e->getMessage()]);
            return response()->json(['status' => false, 'message' => 'Terjadi kesalahan saat menyimpan kompen'], 500);
        }
    }

    // Memperbarui data kompen berdasarkan UUID
    public function update(Request $request, $UUID_Kompen)
{
    $kompen = KompenModel::find($UUID_Kompen);

    if (!$kompen) {
        return response()->json(['status' => false, 'message' => 'Data kompen tidak ditemukan'], 404);
    }

    // Validator untuk memastikan input yang diberikan valid
    $validator = Validator::make($request->all(), [
        'nama_kompen'    => 'nullable|string|max:100',
        'deskripsi'      => 'nullable|string',
        'jenis_tugas'    => 'nullable|integer',
        'quota'          => 'nullable|integer',
        'jam_kompen'     => 'nullable|integer',
        'status_dibuka'  => 'nullable|boolean',
        'tanggal_mulai'  => 'nullable|date',
        'tanggal_akhir'  => 'nullable|date|after_or_equal:tanggal_mulai',
        'is_selesai'     => 'nullable|boolean',
        'id_kompetensi'  => 'nullable|integer',
        'periode_kompen' => 'nullable|string|max:50',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    // Perbarui hanya jika data ada dalam request
    if ($request->has('nama_kompen')) {
        $kompen->nama_kompen = $request->nama_kompen;
    }
    if ($request->has('deskripsi')) {
        $kompen->deskripsi = $request->deskripsi;
    }
    if ($request->has('jenis_tugas')) {
        $kompen->jenis_tugas = $request->jenis_tugas;
    }
    if ($request->has('quota')) {
        $kompen->quota = $request->quota;
    }
    if ($request->has('jam_kompen')) {
        $kompen->jam_kompen = $request->jam_kompen;
    }
    if ($request->has('status_dibuka')) {
        $kompen->status_dibuka = $request->status_dibuka;
    }
    if ($request->has('tanggal_mulai')) {
        $kompen->tanggal_mulai = $request->tanggal_mulai;
    }
    if ($request->has('tanggal_akhir')) {
        $kompen->tanggal_akhir = $request->tanggal_akhir;
    }
    if ($request->has('is_selesai')) {
        $kompen->is_selesai = $request->is_selesai;
    }
    if ($request->has('id_kompetensi')) {
        $kompen->id_kompetensi = $request->id_kompetensi;
    }
    if ($request->has('periode_kompen')) {
        $kompen->periode_kompen = $request->periode_kompen;
    }

    // Simpan perubahan
    $kompen->save();

    return response()->json(['status' => true, 'data' => $kompen, 'message' => 'Data kompen berhasil diperbarui'], 200);
}


    // Menghapus data kompen berdasarkan UUID
    public function destroy($UUID_Kompen)
    {
        $kompen = KompenModel::find($UUID_Kompen);

        if (!$kompen) {
            return response()->json(['status' => false, 'message' => 'Data kompen tidak ditemukan'], 404);
        }

        $kompen->delete();

        return response()->json(['status' => true, 'message' => 'Data kompen berhasil dihapus'], 200);
    }
}
