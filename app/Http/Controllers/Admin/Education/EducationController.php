<?php

namespace App\Http\Controllers\Admin\Education;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    private Education $education;

    public function __construct(Education $education)
    {
        $this->education = $education;
    }

    public function index()
    {
        $data = Education::query()
            ->when(
                request()->filled('search'),
                fn($query) => $query->where('school_name', 'like', '%' . request('search') . '%')
                    ->orWhere('jurusan', 'like', '%' . request('search') . '%')
            )
            ->orderBy('order', 'asc')
            ->select('id', 'school_name', 'start_year', 'end_year', 'jurusan')
            ->paginate(request('limit', 10));

        return view('pages.admin.education.index', compact('data'));

    }

    public function create()
    {
        return view('pages.admin.education.create');
    }

    public function store(Request $request)
    {
        try {
            $validateRequest = $request->validate([
                'school_name' => 'required',
                'order' => 'required',
                'start_year' => 'required',
                'end_year' => 'required',
                'jurusan' => 'nullable',
                'link' => 'nullable',
            ],
            [
                'school_name.required' => 'School Name is required',
                'start_year.required' => 'Start Year is required',
                'end_year.required' => 'End Year is required',
                'order.required' => 'Order is required',
            ]);

            $this->education->create($validateRequest);

            return response()->json([
                'status' => 'success',
                'message' => 'Education created successfully'
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
        $data = $this->education->findOrFail($id);

        return view('pages.admin.education.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validateRequest = $request->validate([
                'school_name' => 'required',
                'start_year' => 'required',
                'end_year' => 'required',
                'jurusan' => 'nullable',
                'order' => 'required',
                'link' => 'nullable',
            ],
            [
                'school_name.required' => 'School Name is required',
                'start_year.required' => 'Start Year is required',
                'end_year.required' => 'End Year is required',
                'order.required' => 'Order is required',
            ]);

            $this->education->findOrFail($id)->update($validateRequest);

            return response()->json([
                'status' => 'success',
                'message' => 'Education updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->education->findOrFail($id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Education deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }
}
