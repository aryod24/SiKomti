<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;     // Import UserModel
use App\Models\KompenModel;   // Import KompenModel
use App\Models\MahasiswaKompen; // Import MahasiswaKompen
use App\Models\Kompetensi;
use App\Models\JenisTugas;   // Import JenisKompen

class WelcomeController extends Controller
{
    public function index() 
    {
        // Menghitung jumlah pengguna, kompen, mahasiswa dalam kompen, dan jenis kompen
        $jumlahUser = UserModel::count();
        $jumlahKompen = KompenModel::count();
        $jumlahKompentensi = Kompetensi::count();
        $jumlahMahasiswaKompen = MahasiswaKompen::count();
        $jumlahJenisKompen = JenisTugas::count();

        // Menghitung jumlah kompen yang selesai (is_selesai = 1)
        $jumlahKompenSelesai = KompenModel::where('is_selesai', 1)->count();

        // Breadcrumb dan menu aktif
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        // Mengirim data ke view
        return view('welcome', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jumlahUser' => $jumlahUser,
            'jumlahKompentensi' => $jumlahKompentensi,
            'jumlahKompen' => $jumlahKompen,
            'jumlahMahasiswaKompen' => $jumlahMahasiswaKompen,
            'jumlahJenisKompen' => $jumlahJenisKompen,
            'jumlahKompenSelesai' => $jumlahKompenSelesai, // Kirimkan data kompen selesai
        ]);
    }
}
