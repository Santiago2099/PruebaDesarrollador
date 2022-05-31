<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Models\roles;

class MedicoController extends Controller
{
    public function roles()
    {
        $roles = roles::all();
        return response()->json([
            'data' => $roles,
        ], 200);
    }
}
