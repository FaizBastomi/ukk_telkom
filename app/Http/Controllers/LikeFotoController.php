<?php

namespace App\Http\Controllers;

use App\Models\LikeFoto;
use Illuminate\Http\Request;

class LikeFotoController extends Controller
{
    public function toggleLike(Request $request)
    {
        $user_id = auth()->id();
        $foto_id = $request->foto_id;
        $like = LikeFoto::where('foto_id', $foto_id)->where('user_id', $user_id)->first();

        if ($like) {
            $like->delete();
        } else {
            LikeFoto::create([
                'foto_id' => $foto_id,
                'user_id' => $user_id,
            ]);
        }

        return back();
    }
}
