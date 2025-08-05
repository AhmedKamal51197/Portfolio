<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrentProjectRequest;
use App\Http\Requests\UpdateCurrentProjectRequest;
use App\Http\Resources\CurrentProjectResource;
use App\Models\CurrentProject;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class CurrentProjectController extends Controller
{
    public function index()
    {
        $items = CurrentProject::with('cards')->get();

        if ($items->isEmpty()) {
            return $this->success(__('No data found'), data: []);
        }

        return $this->success(__('success'), data: CurrentProjectResource::collection($items));
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        $item = CurrentProject::with('cards')->find($id);

        if (!$item) {
            return $this->failure(__('No data found'), 404);
        }

        return $this->success(__('success'), data: new CurrentProjectResource($item));
    }

    public function store(CurrentProjectRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $item = CurrentProject::create([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
            ]);

            foreach ($data['cards'] as $index => $card) {
                if ($request->hasFile("cards.$index.icon")) {
                    $card['icon'] = $this->uploadImageToDirectory(
                        $request->file("cards.$index.icon"),
                        'CurrentProjects'
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
                data: new CurrentProjectResource($item->load('cards')),
                status: 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }

    public function update(UpdateCurrentProjectRequest $request, $id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $item = CurrentProject::with('cards')->findOrFail($id);

            $item->update([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
           
            ]);

            foreach ($data['cards'] as $index => $cardData) {
                $existingCard = $item->cards()
                    ->where('position', $cardData['position'])
                    ->first();

                if (!$existingCard) {
                    continue;
                }

                if ($request->hasFile("cards.$index.icon")) {
                    $cardData['icon'] = $this->updateModelImage(
                        $existingCard,
                        $request->file("cards.$index.icon"),
                        'CurrentProjects'
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
                __('Item and cards updated successfully'),
                data: new CurrentProjectResource($item->fresh('cards')),
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
        $item = CurrentProject::find($id);

        if (!$item) {
            return $this->failure(__('Item not found'), 404);
        }
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
