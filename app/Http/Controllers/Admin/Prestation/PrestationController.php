<?php

namespace App\Http\Controllers\Admin\Prestation;

use App\Http\Controllers\Controller;
use App\Models\Prestation;
use Illuminate\Http\Request;

class PrestationController extends Controller
{
    private Prestation $prestation;

    public function __construct(Prestation $prestation)
    {
        $this->prestation = $prestation;
    }

    public function index()
    {
        $data = Prestation::query()
            ->when(
                request()->filled('search'),
                fn($query) => $query->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%')
            )
            ->orderBy('created_at', 'desc')
            ->select('id', 'title', 'description', 'image', 'slug', 'meta_description', 'competition_organizer')
            ->paginate(request('limit', 10));

        return view('pages.admin.prestation.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.prestation.create');
    }

    public function store(Request $request)
    {
        try {
            $validateRequest = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png|max:2048',
                'slug' => 'required',
                'meta_description' => 'nullable',
                'competition_organizer' => 'nullable',
            ],
            [
                'title.required' => 'Title is required',
                'description.required' => 'Description is required',
                'image.required' => 'Image is required',
                'image.mimes' => 'Image must be jpg, jpeg, or png',
                'image.max' => 'Image max size is 2048',
                'slug.required' => 'Slug is required',
            ]);

            $image_name = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->extension();
                $image->move(public_path('storage/prestation'), $image_name);
            }

            $this->prestation->create([
                'title' => $validateRequest['title'],
                'description' => $validateRequest['description'],
                'image' => $image_name,
                'slug' => $validateRequest['slug'],
                'meta_description' => $validateRequest['meta_description'],
                'competition_organizer' => $validateRequest['competition_organizer'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data has been saved',
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }

    public function edit($id)
    {
        $data = $this->prestation->findOrFail($id);
        return view('pages.admin.prestation.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validateRequest = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'slug' => 'required',
                'meta_description' => 'nullable',
                'competition_organizer' => 'nullable',
            ],
            [
                'title.required' => 'Title is required',
                'description.required' => 'Description is required',
                'image.image' => 'Image must be jpg, jpeg, or png',
                'image.max' => 'Image max size is 2048',
                'slug.required' => 'Slug is required',
            ]);

            $prestation = $this->prestation->findOrFail($id);
            $image_name = $prestation->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->extension();
                $image->move(public_path('storage/prestation'), $image_name);
            }

            $prestation->update([
                'title' => $validateRequest['title'],
                'description' => $validateRequest['description'],
                'image' => $image_name,
                'slug' => $validateRequest['slug'],
                'meta_description' => $validateRequest['meta_description'],
                'competition_organizer' => $validateRequest['competition_organizer'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data has been updated',
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }

    public function destroy($id)
    {
        try {
            $prestation = $this->prestation->findOrFail($id);
            $prestation->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data has been deleted',
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }
}
