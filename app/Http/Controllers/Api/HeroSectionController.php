<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeroSectionRequest;
use App\Http\Resources\HeroSectionResource;
use App\Models\HeroSection;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class HeroSectionController extends Controller
{
  
    
    public function index()
    {
        $heroSection = HeroSection::all();
        if ($heroSection->isEmpty()) {
            return $this->success(__('No data found'),data:[]);
        }
        return $this->success(__('success'),data:HeroSectionResource::collection($heroSection));

    }
    public function show($id)
    {
        $heroSection = HeroSection::find($id);
        if (!$heroSection) {
            return $this->error(__('No data found'), 404);
        }
        return $this->success(__('success'),data:new HeroSectionResource($heroSection));
    }
    public function store(HeroSectionRequest $request){
        $data = $request->validated();

        try{
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageToDirectory($request->file('image'), 'HeroSection');
        }
        $heroSection = HeroSection::create($data);
        return $this->success(__('Hero section created successfully'), status: 201);
    }catch (\Exception $e) {
        return $this->failure(__('An error occurred while processing your request please try again'), 500);
        // return $this->failure($e->getMessage(), 500);

    }
    }
    public function update(HeroSectionRequest $request, $id)
    {
        $heroSection = HeroSection::find($id);
        if (!$heroSection) {
            return $this->error(__('No data found'), 404);
        }

        $data = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $data['image'] = $this->updateModelImage($heroSection,$request->file('image'), 'HeroSection');
            }
            $heroSection->update($data);
            return $this->success(__('Hero section updated successfully'), data: new HeroSectionResource($heroSection));
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request please try again'), 500);
        //  return $this->failure($e->getMessage(), 500);
        
        }
    }
    public function destroy($id)
    {
        $heroSection = HeroSection::find($id);
        if (!$heroSection) {
            return $this->error(__('No data found'), 404);
        }
        try {
            $this->deleteImageFromDirectory($heroSection->image, 'HeroSection');
            $heroSection->delete();
            return $this->success(__('Hero section deleted successfully'));
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request please try again'), 500);
        }
    }
}
