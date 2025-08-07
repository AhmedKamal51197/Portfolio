<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\MyVisionMissionRequest;
use App\Http\Resources\MyVisionMissionResource;
use App\Models\MyVisionMission;
use Illuminate\Http\Request;

class MyVisionMissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $myVisionMission = MyVisionMission::all();
        if ($myVisionMission->isEmpty()) {
            return $this->success(__('No data found'), data: []);
        }

        return $this->success(__('success'), data: MyVisionMissionResource::collection($myVisionMission));
    }
    public function show($id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        $myVisionMission = MyVisionMission::find($id);
        if (!$myVisionMission) {
            return $this->error(__('No data found'), 404);
        }

        return $this->success(__('success'), data: new MyVisionMissionResource($myVisionMission));
    }
    public function store(MyVisionMissionRequest $request)
    {
        $data = $request->validated();

        try {
            if ($request->hasFile('icon')) {
                $data['icon'] = $this->uploadImageToDirectory($request->file('icon'), 'MyVisionMission');
            }
            $myVisionMission = MyVisionMission::create($data);
            return $this->success(__('My Vision/Mission created successfully'), status: 201);
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
    public function update(MyVisionMissionRequest $request, $id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        $myVisionMission = MyVisionMission::find($id);
        if (!$myVisionMission) {
            return $this->error(__('No data found'), 404);
        }

        $data = $request->validated();

        try {
            if ($request->hasFile('icon')) {
                $data['icon'] = $this->updateModelImage($myVisionMission, $request->file('icon'), 'MyVisionMission');
            }
            $myVisionMission->update($data);
            return $this->success(__('My Vision/Mission updated successfully'), data: new MyVisionMissionResource($myVisionMission));
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        $myVisionMission = MyVisionMission::find($id);
        if (!$myVisionMission) {
            return $this->error(__('No data found'), 404);
        }
        try {
            $this->deleteImageFromDirectory($myVisionMission->icon, 'MyVisionMission');
            $myVisionMission->delete();
            return $this->success(__('My Vision/Mission deleted successfully'));
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request please try again'), 500);
        }
    }
}
