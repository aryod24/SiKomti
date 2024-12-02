<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KompenModel;
use App\Models\ProgressModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    // Get the history of Kompen created by a specific user and completed
    public function historyKompenDosen($userId)
    {
        $kompen = KompenModel::where('user_id', $userId)
            ->where('Is_Selesai', 1)
            ->get();

        if ($kompen->isEmpty()) {
            return response()->json(['message' => 'No completed Kompen found for this user.'], 404);
        }

        return response()->json(['kompen' => $kompen], 200);
    }

// Get the history of Kompen for students with accepted status and completed
public function historyKompenMhs($ni)
{
    $progress = ProgressModel::where('ni', $ni)
        ->where('status_acc', 1)
        ->whereHas('kompen', function($query) {
            $query->where('Is_Selesai', 1);
        })
        ->with('kompen') // Include the related Kompen data
        ->get();

    if ($progress->isEmpty()) {
        return response()->json(['message' => 'No completed or accepted Kompen found for this student.'], 404);
    }

    foreach ($progress as $item) {
        if (isset($item->kompen->user_id)) {
            $userDetails = UserModel::find($item->kompen->user_id);
            $item->kompen->user_details = $userDetails;
        }
    }

    return response()->json(['progress' => $progress], 200);
}
}