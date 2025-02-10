<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    //

    public function store(User $user, Request $request)
    {
        // cuando se relaciona con la misma tabla
        $user->followers()->attach(Auth::user()->id);
        return back();
    }

    public function destroy(User $user) {
        $user->followers()->detach(Auth::user()->id);
        return back();
    }

    public function consultar(User $user) {
        return  response()->json([
            'follows' => $user->siguiendo(Auth::user()),
            'following' => $user->following->count(),
            'followers' => $user->followers->count()
        ]);
    }
}
