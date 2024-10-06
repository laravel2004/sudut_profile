<?php

namespace App\Http\Controllers\User\Prestation;

use App\Http\Controllers\Controller;
use App\Models\Prestation;
use Illuminate\Http\Request;

class PrestationController extends Controller
{
    public function show($slug)
    {
        $data = Prestation::where('slug', $slug)->first();
        return view('pages.user.prestation.index', compact('data'));
    }
}
