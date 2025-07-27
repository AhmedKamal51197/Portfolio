<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdoptedMethodologyRequest;
use App\Http\Resources\AdoptedMethodologyResource;
use App\Models\AdoptedMethodology;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class AdoptedMethodologyController extends Controller
{
    public function index()
    {
        $items = AdoptedMethodology::with('cards')->get();

        if ($items->isEmpty()) {
            return $this->success(__('No data found'), data: []);
        }

        return $this->success(__('success'), data: AdoptedMethodologyResource::collection($items));
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        $item = AdoptedMethodology::with('cards')->find($id);

        if (!$item) {
            return $this->failure(__('No data found'), 404);
        }

        return $this->success(__('success'), data: new AdoptedMethodologyResource($item));
    }

    public function store(AdoptedMethodologyRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $item = AdoptedMethodology::create([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
                'description_ar' => $data['description_ar'],
                'description_en' => $data['description_en'],
            ]);

            foreach ($data['cards'] as $index => $card) {
                if ($request->hasFile("cards.$index.icon")) {
                    $card['icon'] = $this->uploadImageToDirectory(
                        $request->file("cards.$index.icon"),
                        'AdoptedMethodologies'
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
                data: new AdoptedMethodologyResource($item->load('cards')),
                status: 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }

    public function update(AdoptedMethodologyRequest $request, $id)
    {
        if (!is_numeric($id)) {
            return $this->failure(__('No data found'), 404);
        }
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $item = AdoptedMethodology::with('cards')->findOrFail($id);

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
                    continue;
                }

                if ($request->hasFile("cards.$index.icon")) {
                    $cardData['icon'] = $this->updateModelImage(
                        $existingCard,
                        $request->file("cards.$index.icon"),
                        'AdoptedMethodologies'
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
                data: new AdoptedMethodologyResource($item->fresh('cards')),
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
        $item = AdoptedMethodology::find($id);

        if (!$item) {
            return $this->failure(__('Item not found'), 404);
        }

        $item->cards()->delete();
        $item->delete();

        return $this->success(__('Item and its cards deleted successfully'));
    }
}
