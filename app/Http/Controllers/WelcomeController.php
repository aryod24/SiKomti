<?php

<<<<<<< HEAD
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
=======

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\KompenModel;
use App\Models\MahasiswaKompen;
use App\Models\Kompetensi;
use App\Models\JenisTugas;
use App\Models\MahasiswaAlpha;
use Illuminate\Support\Facades\Auth;

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
    $jumlahKompenSelesai = KompenModel::where('is_selesai', 1)->count();

    $breadcrumb = (object) [
        'title' => 'Selamat Datang',
        'list' => ['Home', 'Welcome']
    ];

    $activeMenu = 'dashboard';

    // Check if the user is a mahasiswa (level_id 2)
    if (Auth::user()->level_id == 2) {
        $ni = Auth::user()->ni;
        $akumulasiData = MahasiswaAlpha::where('ni', $ni)
            ->selectRaw('semester, SUM(jam_alpha) as total_jam_alpha, SUM(jam_kompen) as total_jam_kompen')
            ->groupBy('semester')
            ->orderBy('semester')
            ->get();

        return view('welcomemhs', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'akumulasiData' => $akumulasiData
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        ]);
    }

    // For non-mahasiswa users
    return view('welcome', [
        'breadcrumb' => $breadcrumb,
        'activeMenu' => $activeMenu,
        'jumlahUser' => $jumlahUser,
        'jumlahKompentensi' => $jumlahKompentensi,
        'jumlahKompen' => $jumlahKompen,
        'jumlahMahasiswaKompen' => $jumlahMahasiswaKompen,
        'jumlahJenisKompen' => $jumlahJenisKompen,
        'jumlahKompenSelesai' => $jumlahKompenSelesai,
    ]);
}
}