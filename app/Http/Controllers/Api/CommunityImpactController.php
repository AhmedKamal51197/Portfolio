<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityImpactRequest;
use App\Http\Resources\ComunityImpactResource;
use App\Models\CommunityImpact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommunityImpactController extends Controller
{
    public function index()
    {
        $items = CommunityImpact::with('cards', 'images')->get();

        if ($items->isEmpty()) {
            return $this->success(__('No data found'), data: []);
        }

        return $this->success(__('success'), data: ComunityImpactResource::collection($items));
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }

        $item = CommunityImpact::with('cards', 'images')->find($id);

        if (!$item) {
            return $this->failure(__('No data found'), 404);
        }

        return $this->success(__('success'), data: new ComunityImpactResource($item));
    }

    public function store(CommunityImpactRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $item = CommunityImpact::create([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
            ]);

            // رفع الصور العامة
            if ($request->hasFile('image_array')) {
                foreach ($request->file('image_array') as $index=>$image) {
                    $imagePath = $this->uploadImageToDirectory($image, 'ComunityImpacts');
                    $item->images()->create(['image' => $imagePath, 'position' => $index]);
                }
            }

            // رفع بيانات البطاقات
            foreach ($data['cards'] as $index => $card) {
                if ($request->hasFile("cards.$index.icon")) {
                    $card['icon'] = $this->uploadImageToDirectory(
                        $request->file("cards.$index.icon"),
                        'ComunityImpacts'
                    );
                }

                $item->cards()->create([
                    'position' => $card['position'],
                    'description_ar' => $card['description_ar'],
                    'description_en' => $card['description_en'],
                    'icon' => $card['icon'],
                ]);
            }

            DB::commit();

            return $this->success(
                __('Item and cards created successfully'),
                data: new ComunityImpactResource($item->load('cards', 'images')),
                status: 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
    public function update(CommunityImpactRequest $request, $id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }

        $data = $request->validated();

        DB::beginTransaction();

        try {
            $item = CommunityImpact::with('cards', 'images')->findOrFail($id);

            $item->update([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
            ]);

           // الصور الحالية المرتبطة بالمشروع
            $existingImages = $item->images->values(); // [0 => img1, 1 => img2, 2 => img3]
                
            if ($request->hasFile('image_array')) {
                foreach ($request->file('image_array') as $index => $newImage) {
                    // تحقق إن كانت هناك صورة موجودة في نفس الموضع
                    
                    $existing = $existingImages->get($index);
                    // dd($existing->image);
                    if ($existing) {
                        $newImageUploaded=$this->updateModelImage($existing,$newImage, 'ComunityImpacts');
                        $existing->update(['image' => $newImageUploaded]);

                    }
                    
                    
                }
            }
            // تحديث البطاقات
            foreach ($data['cards'] as $index => $cardData) {
                $card = $item->cards()->where('position', $cardData['position'])->first();

                if (!$card) {
                    continue;
                }

                if ($request->hasFile("cards.$index.icon")) {
                    $cardData['icon'] = $this->updateModelImage(
                        $card,
                        $request->file("cards.$index.icon"),
                        'ComunityImpacts'
                    );
                }

                $card->update([
                    'description_ar' => $cardData['description_ar'],
                    'description_en' => $cardData['description_en'],
                    'icon' => $cardData['icon'] ?? $card->icon,
                ]);
            }

            DB::commit();

            return $this->success(
                __('Item and cards updated successfully'),
                data: new ComunityImpactResource($item->fresh('cards', 'images')),
                status: 200
            );
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return $this->failure(__('No data found'), 404);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }

    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        $item = CommunityImpact::find($id);

        if (!$item) {
            return $this->failure(__('Item not found'), 404);
        }
        // Delete associated images
        foreach ($item->images as $image) {
            $this->deleteImageFromDirectory($image->image, 'ComunityImpacts');
        }
        $item->images()->delete();

        // Delete associated cards with it's images
        foreach ($item->cards as $card) {
            if ($card->icon) {
                $this->deleteImageFromDirectory($card->icon, 'CurrentProjects');
            }
        }
        $item->cards()->delete();
        $item->delete();

        return $this->success(__('Item and its cards deleted successfully'));
    }
}
