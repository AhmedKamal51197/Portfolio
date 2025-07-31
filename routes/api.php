<?php

use App\Http\Controllers\Api\HeroSectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(["prefix"=>"/hero-section"], function () {
    Route::get('/', [HeroSectionController::class, 'index'])->name('hero-section.index');
    Route::get('/{id}', [HeroSectionController::class, 'show'])->name('hero-section.show');
    Route::post('/', [HeroSectionController::class, 'store'])->name('hero-section.store');
    Route::put('/{id}', [HeroSectionController::class, 'update'])->name('hero-section.update');
    Route::delete('/{id}', [HeroSectionController::class, 'destroy'])->name('hero-section.destroy');
    // Add other routes as needed
});
Route::group(["prefix"=>"/my-vision-mission"], function () {
    Route::get('/', [\App\Http\Controllers\Api\MyVisionMissionController::class, 'index'])->name('my-vision-mission.index');
    Route::get('/{id}', [\App\Http\Controllers\Api\MyVisionMissionController::class, 'show'])->name('my-vision-mission.show');
    Route::post('/', [\App\Http\Controllers\Api\MyVisionMissionController::class, 'store'])->name('my-vision-mission.store');
    Route::put('/{id}', [\App\Http\Controllers\Api\MyVisionMissionController::class, 'update'])->name('my-vision-mission.update');
    Route::delete('/{id}', [\App\Http\Controllers\Api\MyVisionMissionController::class, 'destroy'])->name('my-vision-mission.destroy');
    // Add other routes as needed
});
Route::group(["prefix"=>"/professional-appreciation"], function () {
    Route::get('/', [\App\Http\Controllers\Api\ProfessionalAppreciationController::class, 'index'])->name('professional-appreciation.index');
    Route::get('/{id}', [\App\Http\Controllers\Api\ProfessionalAppreciationController::class, 'show'])->name('professional-appreciation.show');
    Route::post('/', [\App\Http\Controllers\Api\ProfessionalAppreciationController::class, 'store'])->name('professional-appreciation.store');
    Route::put('/{id}', [\App\Http\Controllers\Api\ProfessionalAppreciationController::class, 'update'])->name('professional-appreciation.update');
    Route::delete('/{id}', [\App\Http\Controllers\Api\ProfessionalAppreciationController::class, 'destroy'])->name('professional-appreciation.destroy');
    // Add other routes as needed
});

Route::group(["prefix"=>"/adopted-methodology"], function () {
    Route::get('/', [\App\Http\Controllers\Api\AdoptedMethodologyController::class, 'index'])->name('adopted-methodology.index');
    Route::get('/{id}', [\App\Http\Controllers\Api\AdoptedMethodologyController::class, 'show'])->name('adopted-methodology.show');
    Route::post('/', [\App\Http\Controllers\Api\AdoptedMethodologyController::class, 'store'])->name('adopted-methodology.store');
    Route::put('/{id}', [\App\Http\Controllers\Api\AdoptedMethodologyController::class, 'update'])->name('adopted-methodology.update');
    Route::delete('/{id}', [\App\Http\Controllers\Api\AdoptedMethodologyController::class, 'destroy'])->name('adopted-methodology.destroy');
    // Add other routes as needed
});
Route::group(["prefix"=>"/training-program"], function () {
    Route::get('/', [\App\Http\Controllers\Api\TrainingProgramControler::class, 'index'])->name('training-program.index');
    Route::get('/{id}', [\App\Http\Controllers\Api\TrainingProgramControler::class, 'show'])->name('training-program.show');
    Route::post('/', [\App\Http\Controllers\Api\TrainingProgramControler::class, 'store'])->name('training-program.store');
    Route::put('/{id}', [\App\Http\Controllers\Api\TrainingProgramControler::class, 'update'])->name('training-program.update');
    Route::delete('/{itemId}/card/{cardId}', [\App\Http\Controllers\Api\TrainingProgramControler::class, 'destroy'])->name('training-program.destroy');
    // Add other routes as needed
});
Route::group(["prefix"=>"/current-project"], function () {
    Route::get('/', [\App\Http\Controllers\Api\CurrentProjectController::class, 'index'])->name('current-project.index');
    Route::get('/{id}', [\App\Http\Controllers\Api\CurrentProjectController::class, 'show'])->name('current-project.show');
    Route::post('/', [\App\Http\Controllers\Api\CurrentProjectController::class, 'store'])->name('current-project.store');
    Route::put('/{id}', [\App\Http\Controllers\Api\CurrentProjectController::class, 'update'])->name('current-project.update');
    Route::delete('/{id}', [\App\Http\Controllers\Api\CurrentProjectController::class, 'destroy'])->name('current-project.destroy');
    // Add other routes as needed
});
Route::group(["prefix"=>"/community-impact"], function () {
    Route::get('/', [\App\Http\Controllers\Api\CommunityImpactController::class, 'index'])->name('community-impact.index');
    Route::get('/{id}', [\App\Http\Controllers\Api\CommunityImpactController::class, 'show'])->name('community-impact.show');
    Route::post('/', [\App\Http\Controllers\Api\CommunityImpactController::class, 'store'])->name('community-impact.store');
    Route::put('/{id}', [\App\Http\Controllers\Api\CommunityImpactController::class, 'update'])->name('community-impact.update');
    Route::delete('/{id}', [\App\Http\Controllers\Api\CommunityImpactController::class, 'destroy'])->name('community-impact.destroy');
    // Add other routes as needed
});

Route::group(["prefix"=>"/instegram-banner"], function () {
    Route::post('/', [\App\Http\Controllers\Api\InstegramBannerController::class, 'baanerStore'])->name('instegram-banner.store');
    Route::put('/{id}', [\App\Http\Controllers\Api\InstegramBannerController::class, 'baanerUpdate'])->name('instegram-banner.update');
    // Add other routes as needed
});
Route::group(["prefix"=>"/four-broadcasts"],function(){
    Route::get('/', [\App\Http\Controllers\Api\InstegramBannerController::class, 'fourBroadCasts'])->name('four-broadcasts.index');
    Route::put('/{id}', [\App\Http\Controllers\Api\InstegramBannerController::class, 'updateFourBroadCasts'])->name('four-broadcasts.update');

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

