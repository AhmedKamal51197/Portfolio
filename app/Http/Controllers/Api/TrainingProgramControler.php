<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingProgramRequest;
use App\Http\Resources\TrainingProgramResource;
use App\Models\ProfessionalAppreciationCard;
use App\Models\TrainingProgram;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingProgramControler extends Controller
{
    public function index()
    {
        $items = TrainingProgram::with('cards')->get();


        if ($items->isEmpty()) {
            return $this->success(__('No data found'), data: []);
        }

        return $this->success(__('success'), data: TrainingProgramResource::collection($items));
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
    
        $item = TrainingProgram::with('cards')->find($id);

        if (!$item) {
            return $this->failure(__('No data found'), 404);
        }

        return $this->success(__('success'), data: new TrainingProgramResource($item));
    }

    // public function store(TrainingProgramRequest $request)
    // {
    //     $data = $request->validated();

    //     DB::beginTransaction();

    //     try {
    //         $item = TrainingProgram::create([
    //             'title_ar' => $data['title_ar'],
    //             'title_en' => $data['title_en'],
    //             'description_ar' => $data['description_ar'],
    //             'description_en' => $data['description_en'],
    //         ]);

    //         foreach ($data['cards'] as $index => $card) {
    //             if ($request->hasFile("cards.$index.icon")) {
    //                 $card['icon'] = $this->uploadImageToDirectory(
    //                     $request->file("cards.$index.icon"),
    //                     'TrainingPrograms'
    //                 );
    //             }

    //             $item->cards()->create([
    //                 'position' => $card['position'],
    //                 'description_ar' => $card['description_ar'],
    //                 'description_en' => $card['description_en'],
    //                 'icon' => $card['icon'],
    //             ]);
    //         }

    //         DB::commit();

    //         return $this->success(
    //             __('Item and cards created successfully'),
    //             data: new TrainingProgramResource($item->load('cards')),
    //             status: 201
    //         );
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return $this->failure(__('An error occurred while processing your request, please try again'), 500);
    //     }
    // }
    public function store(TrainingProgramRequest $request)
{
    $data = $request->validated();

   

    try {
        DB::beginTransaction();
        // 1. إنشاء البرنامج التدريبي الجديد
        $item = TrainingProgram::create([
            'title_ar' => $data['title_ar'],
            'title_en' => $data['title_en'],
            'description_ar' => $data['description_ar'],
            'description_en' => $data['description_en'],
        ]);

        // 2. محاولة جلب كروت قديمة بدون cardable_id حالي
        $oldCards = ProfessionalAppreciationCard::where('cardable_type', TrainingProgram::class)
        ->whereNotNull('cardable_id') // أو: ->where('cardable_id', '<>', $item->id)
        ->get();

        // 3. نقل الكروت القديمة لهذا البرنامج الجديد (إن وجدت)
        if ($oldCards->isNotEmpty()) {
            foreach ($oldCards as $card) {
                $card->update([
                    'cardable_id' => $item->id,
                ]);
            }
        }

        // 4. إنشاء الكروت الجديدة (إن وجدت)
        foreach ($data['cards'] as $index => $card) {
            if ($request->hasFile("cards.$index.icon")) {
                $card['icon'] = $this->uploadImageToDirectory(
                    $request->file("cards.$index.icon"),
                    'TrainingPrograms'
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
            data: new TrainingProgramResource($item->load('cards')),
            status: 201
        );
    } catch (\Exception $e) {
        DB::rollBack();
        return $this->failure(__('An error occurred while processing your request, please try again'), 500);
    }
}


    public function update(TrainingProgramRequest $request, $id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $item = TrainingProgram::with('cards')->findOrFail($id);

            $item->update([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
                'description_ar' => $data['description_ar'],
                'description_en' => $data['description_en'],
            ]);

            foreach ($data['cards'] as $index => $cardData) {
                $existingCard = $item->cards()
                    ->where('position', $cardData['position'])
                    ->first();

                if (!$existingCard) {
                    // If the card does not exist, create a new one
                    if ($request->hasFile("cards.$index.icon")) {
                        $cardData['icon'] = $this->uploadImageToDirectory(
                            $request->file("cards.$index.icon"),
                            'TrainingPrograms'
                        );
                    }

                    $item->cards()->create([
                        'position' => $cardData['position'],
                        'description_ar' => $cardData['description_ar'],
                        'description_en' => $cardData['description_en'],
                        'icon' => $cardData['icon'],
                    ]);
                }
                else{

                    if ($request->hasFile("cards.$index.icon")) {
                        $cardData['icon'] = $this->updateModelImage(
                            $existingCard,
                            $request->file("cards.$index.icon"),
                            'TrainingPrograms'
                        );
                    }
                    $existingCard->update([
                        'description_ar' => $cardData['description_ar'],
                        'description_en' => $cardData['description_en'],
                        'icon' => $cardData['icon'] ?? $existingCard->icon,
                    ]);
                }

            }

            DB::commit();

            return $this->success(
                __('Item and cards updated successfully'),
                data: new TrainingProgramResource($item->fresh('cards')),
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

    public function destroy($itemId,$cardId)
    {
        try{
        $card = ProfessionalAppreciationCard::findOrFail($cardId);

        
        // Delete the card
        $item = TrainingProgram::findOrFail($itemId);
        if ($item->cards->count() <= 1) {
            // If this is the last card,throw an exception to prevent deletion
            return $this->failure(__('Cannot delete the last card of the item'), 400);
            
        }
        // Delete the card's image if it exists
        if ($card->icon) {
            $this->deleteImageFromDirectory($card->icon, 'TrainingPrograms');
        }
        $card->delete();
        return $this->success(__('Card deleted successfully'), status: 200);
        }catch(ModelNotFoundException $e){
            return $this->failure(__('No data found'), 404);
        }
        catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }

    }
}
