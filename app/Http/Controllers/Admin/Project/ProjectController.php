<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private Project $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function index()
    {
        $data = Project::query()
            ->when(request('search'), function ($query) {
                $query->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('slug', 'like', '%' . request('search') . '%');
            })
            ->orderBy('created_at', 'desc')
            ->select('id', 'title', 'slug', 'image', 'meta_description', 'meta_keywords', 'link')
            ->paginate(request('limit', 10));

        return view('pages.admin.project.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.project.create');
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
                'link' => 'required',
            ], [
                'title.required' => 'Title is required',
                'content.required' => 'Content is required',
                'slug.required' => 'Slug is required',
                'meta_description.required' => 'Meta Description is required',
                'meta_keywords.required' => 'Meta Keywords is required',
                'image.required' => 'Image is required',
                'image.image' => 'The file must be an image',
                'link.required' => 'Link is required',
            ]);

            // Upload gambar
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('storage/project'), $imageName);
            }

            // Simpan data
            $this->project->create([
                'title' => $validateRequest['title'],
                'content' => $validateRequest['content'],
                'slug' => $validateRequest['slug'],
                'meta_description' => $validateRequest['meta_description'],
                'meta_keywords' => $validateRequest['meta_keywords'],
                'image' => $imageName,
                'link' => $validateRequest['link'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }

    public function edit($id)
    {
        $data = $this->project->find($id);
        return view('pages.admin.project.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi request
            $validateRequest = $request->validate([
                'title' => 'required',
                'content' => 'required',
                'slug' => 'required',
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'image' => 'nullable|image',
                'link' => 'required',
            ], [
                'title.required' => 'Title is required',
                'content.required' => 'Content is required',
                'slug.required' => 'Slug is required',
                'meta_description.required' => 'Meta Description is required',
                'meta_keywords.required' => 'Meta Keywords is required',
                'link.required' => 'Link is required',
            ]);

            $project = $this->project->find($id);

            // Upload gambar
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('storage/project'), $imageName);
                $project->image = $imageName;
            }

            // Simpan data
            $project->title = $validateRequest['title'];
            $project->content = $validateRequest['content'];
            $project->slug = $validateRequest['slug'];
            $project->meta_description = $validateRequest['meta_description'];
            $project->meta_keywords = $validateRequest['meta_keywords'];
            $project->link = $validateRequest['link'];
            $project->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->project->find($id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }
}
