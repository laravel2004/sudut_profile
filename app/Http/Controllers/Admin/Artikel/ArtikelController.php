<?php

namespace App\Http\Controllers\Admin\Artikel;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    private Artikel $artikel;

    public function __construct(Artikel $artikel)
    {
        $this->artikel = $artikel;
    }

    public function index()
    {
        $data = Artikel::query()
            ->when(request('search'), function ($query) {
                $query->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('slug', 'like', '%' . request('search') . '%');
            })
            ->orderBy('created_at', 'desc')
            ->select('id', 'title', 'slug', 'image', 'meta_description', 'meta_keywords')
            ->paginate(request('limit', 10));

        return view('pages.admin.artikel.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.artikel.create');
    }

    public function store(Request $request)
    {
        try {
            // Validasi request
            $validateRequest = $request->validate([
                'title' => 'required',
                'content' => 'required',
                'slug' => 'required',
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'image' => 'required|image',
            ], [
                'title.required' => 'Title is required',
                'content.required' => 'Content is required',
                'slug.required' => 'Slug is required',
                'meta_description.required' => 'Meta Description is required',
                'meta_keywords.required' => 'Meta Keywords is required',
                'image.required' => 'Image is required',
                'image.image' => 'The file must be an image',
            ]);

            // Upload gambar
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/artikel'), $imageName);
            }

            $this->artikel->create([
                'title' => $validateRequest['title'],
                'content' => $validateRequest['content'],
                'slug' => $validateRequest['slug'],
                'meta_description' => $validateRequest['meta_description'],
                'meta_keywords' => $validateRequest['meta_keywords'],
                'image' => $imageName,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Artikel created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }


    public function edit($id)
    {
        $data = $this->artikel->findOrFail($id);

        return view('pages.admin.artikel.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Ubah validasi untuk gambar agar opsional
            $validateRequest = $request->validate([
                'title' => 'required',
                'content' => 'required',
                'slug' => 'required',
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'image' => 'nullable|image', // Gambar tidak wajib saat update
            ],
                [
                    'title.required' => 'Title is required',
                    'content.required' => 'Content is required',
                    'slug.required' => 'Slug is required',
                    'meta_description.required' => 'Meta Description is required',
                    'meta_keywords.required' => 'Meta Keywords is required',
                    'image.image' => 'The file must be an image',
                ]);

            $artikel = $this->artikel->findOrFail($id);
            $imageName = $artikel->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/artikel'), $imageName);
            }

            $artikel->update([
                'title' => $validateRequest['title'],
                'content' => $validateRequest['content'],
                'slug' => $validateRequest['slug'],
                'meta_description' => $validateRequest['meta_description'],
                'meta_keywords' => $validateRequest['meta_keywords'],
                'image' => $imageName,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Artikel updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }


    public function destroy($id)
    {
        try {
            $this->artikel->findOrFail($id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Artikel deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
