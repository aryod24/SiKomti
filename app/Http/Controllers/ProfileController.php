<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LevelModel;
class ProfileController extends Controller
{
    public function show()
    {
        $breadcrumb = (object) [
            'title' => 'Profile Anda',
            'list'  => ['']
        ];
        $page = (object) [
            'title' => ''
        ];
        $activeMenu = 'profile';
        $level = LevelModel::all();
        return view('profile.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }
    public function showUpdateProfileForm()
    {
        return view('profile.update'); // Halaman form update profile
    }
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'password' => 'nullable|min:5|confirmed', // Password harus minimal 5 karakter jika ada perubahan
        ]);
    
        $user = Auth::user();
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->jurusan = $request->input('jurusan');
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
    
        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }
    
    public function showUpdateImagesForm()
    {
        return view('profile.updateImages'); // Halaman form upload foto
    }
    public function updateImages(Request $request)
    {
        //validasi memastikan dile upload tidak lebi 2 mb
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $user = auth()->user();
        //menyimpan file
        if ($request->hasFile('avatar')) {
            $avatarName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('images'), $avatarName);
            $user->avatar = $avatarName;
            $user->save();
        }
        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('profile.update.images')->with('success', 'Foto profil berhasil diperbarui!');
    }
}