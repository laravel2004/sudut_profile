<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/ckeditor'), $filename);

            $url = asset('storage/ckeditor/' . $filename);
            return response()->json(['uploaded' => 1, 'fileName' => $filename, 'url' => $url]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'File not found.']]);
    }
}
