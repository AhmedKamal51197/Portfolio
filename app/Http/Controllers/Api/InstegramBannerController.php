<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\InstegramBannerRequest;
use App\Http\Resources\InstegramBannerResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\FourBroadCastsRequest;
use App\Http\Resources\FourBroadCastsResource;
use App\Models\InstegramBroadcast;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstegramBannerController extends Controller
{

    public function baanerStore(InstegramBannerRequest $request)
    {
        $data = $request->validated();
        try {
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImageToDirectory(
                    $request->file('image'),
                    'InstegramBanners'
                );
            }
            $instegramBanner = InstegramBroadcast::create($data);
            return $this->success(
                __('Instegram banner created successfully'),
                new InstegramBannerResource($instegramBanner)
            );
        } catch (\Exception $e) {
            // return $this->failure(__('An error occurred while processing your request, please try again'), 500);

            return $this->failure(__('Image upload failed: ') . $e->getMessage(), 500);
        }
    }

    public function baanerUpdate(InstegramBannerRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $instegramBanner = InstegramBroadcast::findOrFail($id);
            if ($request->hasFile('image')) {
                $data['image'] = $this->updateModelImage(
                    $instegramBanner,
                    $request->file('image'),
                    'InstegramBanners'
                    // 'FourBroadCasts'
                );
            }
            $instegramBanner->update($data);
            return $this->success(
                __('Instegram banner updated successfully'),
                new InstegramBannerResource($instegramBanner)
            );
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);

            // return $this->failure(__('Image upload failed: ') . $e->getMessage(), 500);
        }
    }

    public function fourBroadCasts()
    {
        $instegramBanners = InstegramBroadcast::latest()->take(4)->get();
        return $this->success(
            __('four-broadcasts retrieved successfully'),
            FourBroadCastsResource::collection($instegramBanners)
        );
    }

    public function updateFourBroadCasts($id, FourBroadCastsRequest $request)
    {
        $data = $request->validated();
        
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        try {
            DB::beginTransaction();
            $instegramBanner = InstegramBroadcast::findOrFail($id);
            if ($request->hasFile('image')) {
                $data['image'] = $this->updateModelImage(
                    $instegramBanner,
                    $request->file('image'),
                    'FourBroadCasts'
                );
            }
            $instegramBanner->update([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
                'broadcast_link' => $data['broadcast_link'],
                'image' => $data['image'] ?? $instegramBanner->image,
            ]);
            DB::commit();
            return $this->success(
                __('four-broadcasts updated successfully'),
                new FourBroadCastsResource($instegramBanner)
            );
        }
        catch(ModelNotFoundException $th)
        {
            DB::rollBack();
            return $this->failure(__('No data found'), 404);

        } 
        catch (\Exception $e) {
            DB::rollBack();
            
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
}
