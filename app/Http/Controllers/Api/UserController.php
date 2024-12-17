<?php
namespace App\Http\Controllers\Api;
<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
=======

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\LevelModel; // Assuming you have a LevelModel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
class UserController extends Controller
{
    public function index()
    {
        // Load all users along with their level relationship
        return UserModel::with('level')->get();
    }
<<<<<<< HEAD
    
=======

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100',                     
            'password' => 'required|min:5', 
<<<<<<< HEAD
            'jurusan' => 'required|min:5',
            'ni'       => 'required|string|max:18',                           
            'level_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
=======
            'jurusan'  => 'required|min:5',
            'ni'       => 'required|string|max:18',                           
            'level_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        // Create user
        $user = UserModel::create($request->all());
        
        return response()->json($user->load('level'), 201);
    }
<<<<<<< HEAD
=======

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    public function show(UserModel $user)
    {
        // Load level relationship for the user
        return response()->json($user->load('level'));
    }
<<<<<<< HEAD
=======

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    public function update(Request $request, UserModel $user)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'username' => [
                'sometimes',
                'string',
                'min:3',
                'max:20',
            ],
            'nama'     => 'sometimes|string|max:100',
            'password' => 'sometimes|string|min:5',
            'jurusan'  => 'sometimes|string|min:5',
            'ni'       => 'sometimes|string|max:18',
            'level_id' => 'sometimes|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
<<<<<<< HEAD
        // Perbarui hanya jika data ada dalam request
=======
        // Update only if data is present in the request
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        if ($request->has('username')) {
            $user->username = $request->username;
        }
        if ($request->has('nama')) {
            $user->nama = $request->nama;
        }
        if ($request->has('password') && !empty($request->password)) {
            $user->password = bcrypt($request->password); // Encrypt password if present
        }
        if ($request->has('jurusan')) {
            $user->jurusan = $request->jurusan;
        }
        if ($request->has('ni')) {
            $user->ni = $request->ni;
        }
        if ($request->has('level_id')) {
            $user->level_id = $request->level_id;
        }
    
        // Save the updated user
        $user->save();
    
        return response()->json([
            'status' => true,
            'data' => $user->load('level'), // Include related data (level)
            'message' => 'Data user berhasil diperbarui'
        ], 200);
    }
<<<<<<< HEAD
    
=======
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4

    public function destroy(UserModel $user)
    {
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
    }
<<<<<<< HEAD
}
=======
    public function getLevels()
{
    return LevelModel::all();
}

}
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
