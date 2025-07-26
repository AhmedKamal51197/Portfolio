<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionalAppreciationRequest;
use App\Http\Resources\ProfessionalAppreciationGroupResource;
use App\Models\ProfessionalAppreciationGroup;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ProfessionalAppreciationController extends Controller
{
    public function index()
    {
        $groups = ProfessionalAppreciationGroup::with('cards')->get();

        if ($groups->isEmpty()) {
            return $this->success(__('No data found'), data: []);
        }

        return $this->success(__('success'), data: ProfessionalAppreciationGroupResource::collection($groups));
    }

    public function show($id)
    {
        $group = ProfessionalAppreciationGroup::with('cards')->find($id);
        
        if (!$group) {
            return $this->failure(__('No data found'), 404);
        }

        return $this->success(__('success'), data: new ProfessionalAppreciationGroupResource($group));
    }

    public function store(ProfessionalAppreciationRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            // 1. Create the group
            $group = ProfessionalAppreciationGroup::create([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
            ]);

            // 2. Add related cards
            foreach ($data['cards'] as $index => $card) {
                if (request()->hasFile("cards.$index.icon")) {
                    $card['icon'] = $this->uploadImageToDirectory(
                        request()->file("cards.$index.icon"),
                        'ProfessionalAppreciations'
                    );
                }

                $group->cards()->create([
                    'position' => $card['position'],
                    'description_ar' => $card['description_ar'],
                    'description_en' => $card['description_en'],
                    'icon' => $card['icon'],
                ]);
            }

            DB::commit();

            return $this->success(
                __('Group and cards created successfully'),
                data: new ProfessionalAppreciationGroupResource($group->load('cards')),
                status: 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
          dd($e->getMessage());
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }


    public function update(ProfessionalAppreciationRequest $request, $id)
    {
        $data = $request->validated();
    
        DB::beginTransaction();
    
        try {
            $group = ProfessionalAppreciationGroup::with('cards')->findOrFail($id);
    
            // 1. تحديث عنوان المجموعة
            $group->update([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
            ]);
    
            // 2. تحديث البطاقات الموجودة فقط
            foreach ($data['cards'] as $index => $cardData) {
                $existingCard = $group->cards()
                    ->where('position', $cardData['position'])
                    ->first();
    
                if (!$existingCard) {
                    // تخطي هذه البطاقة إذا لم تكن موجودة (ممنوع الإنشاء)
                    continue;
                }
    
                // معالجة الصورة إذا أُرسلت
                if ($request->hasFile("cards.$index.icon")) {
                    $cardData['icon'] = $this->updateModelImage(
                        $existingCard,
                        $request->file("cards.$index.icon"),
                        'ProfessionalAppreciations'
                    );
                }
    
                $existingCard->update([
                    'description_ar' => $cardData['description_ar'],
                    'description_en' => $cardData['description_en'],
                    'icon' => $cardData['icon'] ?? $existingCard->icon,
                ]);
            }
    
            DB::commit();
    
            return $this->success(
                __('Group and cards updated successfully'),
                data: new ProfessionalAppreciationGroupResource($group->fresh('cards')),
                status: 200
            );
    
        }catch (ModelNotFoundException $t)
        {
            DB::rollBack();
        
            return $this->failure(__('No data found'), 404);
        } 
        catch (\Exception $e) {
            DB::rollBack();
        
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
    
    

    public function destroy($id)
    {
        $group = ProfessionalAppreciationGroup::find($id);

        if (!$group) {
            return $this->failure(__('Group not found'), 404);
        }

        // delete cards and group
        $group->cards()->delete();
        $group->delete();

        return $this->success(__('Group and its cards deleted successfully'));
    }
}
