<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Http\Resources\EvaluationsResource;
use App\Models\Evaluation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $evaluations = Evaluation::whereNotNull('video')->paginate(10);
        $pagination =   [
            'last_page' => $evaluations->lastPage(),
        ];
        if ($evaluations->isEmpty()) {
            return $this->failure(__('No data found'), 404);
        }

        return $this->success(__('success'), data: [$pagination,EvaluationsResource::collection($evaluations)]);
    }
    public function show($id)
    {
        try {
            $evaluation = Evaluation::findOrFail($id);
            return $this->success(__('success'), data: new EvaluationsResource($evaluation));
        }catch(ModelNotFoundException $th)
        {
            return $this->failure(__('No data found'), 404);
        } 
        catch (\Exception $e) {
            return $this->failure(__('No data found'), 404);
        }
    }
    public function store(EvaluationRequest $request)
    {
        $data = $request->validated();
        
        try{
            //check if request has image 
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImageToDirectory($request->file('image'), 'Evaluations');
            }
            //check if request has video
            if ($request->hasFile('video')) {
                $data['video'] = $this->uploadVideoToDirectory($request->file('video'), 'Evaluations');
            }
            
            $evaluation = Evaluation::create($data);
            return $this->success(__('Evaluation created successfully'), data: new EvaluationsResource($evaluation), status: 201);
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
    public function update(UpdateEvaluationRequest $request, $id)
    {
        try {
            $evaluation = Evaluation::findOrFail($id);
            $data = $request->validated();

            //check if request has image 
            if ($request->hasFile('image')) {
                $data['image'] = $this->updateModelImage($evaluation,$request->file('image'), 'Evaluations');
            }
            //check if request has video
            if ($request->hasFile('video')) {
                $data['video'] = $this->updateModelVideo($evaluation,$request->file('video'), 'Evaluations');
            }

            $evaluation->update($data);
            return $this->success(__('Evaluation updated successfully'), data: new EvaluationsResource($evaluation));
        } catch (ModelNotFoundException $th) {
            return $this->failure(__('No data found'), 404);
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
    public function destroy($id)
    {
        try {
            $evaluation = Evaluation::findOrFail($id);
            //delete image if exists
            if ($evaluation->image) {
                $this->deleteImageFromDirectory($evaluation->image, 'Evaluations');
            }
            //delete video if exists
            if ($evaluation->video) {
                $this->deleteVideoFromDirectory($evaluation->video, 'Evaluations');
            }
            $evaluation->delete();
            return $this->success(__('Evaluation deleted successfully'));
        } catch (ModelNotFoundException $th) {
            return $this->failure(__('No data found'), 404);
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
}
