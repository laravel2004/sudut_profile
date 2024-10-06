<?php

namespace App\Http\Controllers\Admin\WorkExperience;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    private WorkExperience $workExperience;

    public function __construct(WorkExperience $workExperience)
    {
        $this->workExperience = $workExperience;
    }

    public function index()
    {
        $data = WorkExperience::query()
            ->when(
                request()->filled('search'),
                fn($query) => $query->where('company_name', 'like', '%' . request('search') . '%')
                    ->orWhere('position', 'like', '%' . request('search') . '%')
            )
            ->orderBy('created_at', 'desc')
            ->select('id', 'company_name', 'position', 'start_date', 'end_date', 'description')
            ->paginate(request('limit', 10));

        return view('pages.admin.work-experience.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.work-experience.create');
    }

    public function store(Request $request)
    {
        try {
            $validateRequest = $request->validate([
                'company_name' => 'required',
                'position' => 'required',
                'start_date' => 'required',
                'end_date' => 'nullable',
                'description' => 'required',
            ],
            [
                'company_name.required' => 'Company name is required',
                'position.required' => 'Position is required',
                'start_date.required' => 'Start date is required',
                'description.required' => 'Description is required',
            ]);

            $this->workExperience->create($validateRequest);

            return response()->json([
                'status' => 'success',
                'message' => 'Work experience created successfully',
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
        $data = $this->workExperience->findOrFail($id);
        return view('pages.admin.work-experience.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validateRequest = $request->validate([
                'company_name' => 'required',
                'position' => 'required',
                'start_date' => 'required',
                'end_date' => 'nullable',
                'description' => 'required',
            ],
            [
                'company_name.required' => 'Company name is required',
                'position.required' => 'Position is required',
                'start_date.required' => 'Start date is required',
                'description.required' => 'Description is required',
            ]);

            $workExperience = $this->workExperience->findOrFail($id);
            $workExperience->update($validateRequest);

            return response()->json([
                'status' => 'success',
                'message' => 'Work experience updated successfully',
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
            $workExperience = $this->workExperience->findOrFail($id);
            $workExperience->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Work experience deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }
}
