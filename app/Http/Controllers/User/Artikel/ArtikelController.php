<?php

namespace App\Http\Controllers\User\Artikel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Artikel::query()->orderBy('created_at', 'desc')->get();
        return view('pages.user.artikel.index', compact('articles'));
    }

    public function show($slug)
    {
        $data = \App\Models\Artikel::where('slug', $slug)->first();
        return view('pages.user.artikel.show', compact('data'));
    }
}
