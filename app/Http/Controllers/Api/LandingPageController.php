<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {   $socialMedia = \App\Models\SocialMedia::get();
        // if ($socialMedia->isEmpty()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Social Media not found',
        //     ], 404);
        // }
        

        $heroSection =\App\Http\Resources\HeroSectionResource::make(\App\Models\HeroSection::first()) ;
        


        $myVision = \App\Models\MyVisionMission::where('type','vision')->first();
        // if (!$myVision) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'My Vision not found',
        //     ], 404);
        // }
        $formatMyVision = [
            'title_ar' => $myVision->title_ar,
            'title_en' => $myVision->title_en,
            'description_ar' => $myVision->description_ar,
            'description_en' => $myVision->description_en,
            'image' => $this->getImagePathFromDirectory($myVision->icon,'MyVisionMissions'),
        ];
        $myMission = \App\Models\MyVisionMission::where('type','mission')->first();
        // if (!$myMission) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'My Mission not found',
        //     ], 404);
        // }
        $formatMyMission = [
            'title_ar' => $myMission->title_ar,
            'title_en' => $myMission->title_en,
            'description_ar' => $myMission->description_ar,
            'description_en' => $myMission->description_en,
            'image' => $this->getImagePathFromDirectory($myMission->icon,'MyVisionMissions'),
        ];
        $professionalAppreciation = \App\Models\ProfessionalAppreciationGroup::with('cards')->first();
        // if (!$professionalAppreciation) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Professional Appreciation not found',
        //     ], 404);
        // }
        $cardsProfessionalAppreciation = collect($professionalAppreciation->cards)->keyBy('position');
        // dd($professionalAppreciation);
        $formatProfessionalAppreciation = [
            'title_ar' => $professionalAppreciation->title_ar,
            'title_en' => $professionalAppreciation->title_en,
            'image' => $this->getImagePathFromDirectory($professionalAppreciation->image,'ProfessionalAppreciations'),
            'cards'=> [
                 new \App\Http\Resources\ProfessionalAppreciationCardResource($cardsProfessionalAppreciation->get(1)),
                 new \App\Http\Resources\ProfessionalAppreciationCardResource($cardsProfessionalAppreciation->get(2)),
                 new \App\Http\Resources\ProfessionalAppreciationCardResource($cardsProfessionalAppreciation->get(3)),
            ],
        ];
        

        $adoptedMethodology = \App\Models\AdoptedMethodology::with('cards')->first();
        // if (!$adoptedMethodology) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Adopted Methodology not found',
        //     ], 404);
        // }
        $cardsAdoptedMethodology = collect($adoptedMethodology->cards)->keyBy('position');
        $formatAdoptedMethodology = [
            'title_ar' => $adoptedMethodology->title_ar,
            'title_en' => $adoptedMethodology->title_en,
            'description_ar' => $adoptedMethodology->description_ar,
            'description_en' => $adoptedMethodology->description_en,
            'cards' => [
                     new \App\Http\Resources\AdoptedMethodologyCardResource($cardsAdoptedMethodology->get(1)),
                     new \App\Http\Resources\AdoptedMethodologyCardResource($cardsAdoptedMethodology->get(2)),
                     new \App\Http\Resources\AdoptedMethodologyCardResource($cardsAdoptedMethodology->get(3)),
                     new \App\Http\Resources\AdoptedMethodologyCardResource($cardsAdoptedMethodology->get(4)),
                ],
            
        ];
        // dd('ddd');
       

        $trainingPrograms = \App\Models\TrainingProgram::with('cards')->first();
        // if (!$trainingPrograms) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Training Programs not found',
        //     ], 404);
        // }
        $cardsTrainingPrograms = collect($trainingPrograms->cards)->keyBy('position');
            $formatTrainingPrograms =[
                'title_ar' => $trainingPrograms->title_ar,
                    'title_en' => $trainingPrograms->title_en,
                    'description_ar' => $trainingPrograms->description_ar,
                    'description_en' => $trainingPrograms->description_en,
                    'cards' => [
                            \App\Http\Resources\TrainigProgramCardResource::collection($cardsTrainingPrograms)
                         
                    ],
            ];
       
        $currentProjects = \App\Models\CurrentProject::with('cards')->first();
        // if (!$currentProjects) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Current Projects not found',
        //     ], 404);
        // }
        $cardsCurrentProjects = collect($currentProjects->cards)->keyBy('position');
        $formatCurrentProjects = [
            'title_ar' => $currentProjects->title_ar,
            'title_en' => $currentProjects->title_en,
            'cards' => [
                $cardsCurrentProjects->has(1)
                ?  \App\Http\Resources\CurrentProjectCardResource::make($cardsCurrentProjects->get(1))
                : null,
                $cardsCurrentProjects->has(2)
                ?  \App\Http\Resources\CurrentProjectCardResource::make($cardsCurrentProjects->get(2))
                : null,
                $cardsCurrentProjects->has(3)
                ?  \App\Http\Resources\CurrentProjectCardResource::make($cardsCurrentProjects->get(3))
                : null,
                $cardsCurrentProjects->has(4)
                ?  \App\Http\Resources\CurrentProjectCardResource::make($cardsCurrentProjects->get(4))
                : null,
            ],
        ];
        
        $communityImpact = \App\Models\CommunityImpact::with('cards', 'images')->get();
         $formatCommunityImpact= \App\Http\Resources\ComunityImpactResource::collection($communityImpact);

        // if (!$communityImpact) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Community Impact not found',
        //     ], 404);
        // }
        // $cardsCommunityImpact = collect($communityImpact->cards)->keyBy('position');
        // $formatCommunityImpact = [
        //     'title_ar' => $communityImpact->title_ar,
        //     'title_en' => $communityImpact->title_en,
        //     'images' => $communityImpact->images->map(fn($img) => $this->getImagePathFromDirectory($img->image, 'CommunityImpacts')),
        //     'cards' => [
        //         $cardsCommunityImpact->has(1)
        //     ? new \App\Http\Resources\ComunityImpactCardResource($cardsCommunityImpact->get(1))
        //     : null,
        //             $cardsCommunityImpact->has(2)
        //     ? new \App\Http\Resources\ComunityImpactCardResource($cardsCommunityImpact->get(2))
        //     : null,
        //             $cardsCommunityImpact->has(3)
        //     ? new \App\Http\Resources\ComunityImpactCardResource($cardsCommunityImpact->get(3))
        //     : null,
        //             $cardsCommunityImpact->has(4)
        //     ? new \App\Http\Resources\ComunityImpactCardResource($cardsCommunityImpact->get(4))
        //     : null,

                
        //     ],
        // ];
        // dd($communityImpact->images->map(fn($img) => $this->getImagePathFromDirectory($img->image, 'CommunityImpacts')));

        $evaluation = \App\Models\Evaluation::whereNotNull('video')->get();
        // if ($evaluation->isEmpty()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Evaluation not found',
        //     ], 404);

        // }


        $mapEvaluation = $evaluation->map(function ($item) {
            return [
                'id' => $item->id,
                'client_name_en'=> $item->client_name_en,
                'client_name_ar' => $item->client_name_ar,
                'image' => $this->getImagePathFromDirectory($item->image, 'evaluations'),
                'video'=>$this->getVideoPathFromDirectory($item->video, 'evaluations'),
            ];
        });
        
        $evaluationWithoutVideo = \App\Models\Evaluation::whereNull('video')->get();
        // if ($evaluationWithoutVideo->isEmpty()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Evaluation without video not found',
        //     ], 404);
        // }

        // dd($evaluationWithoutVideo);
        $mapEvaluationWithoutVideo = $evaluationWithoutVideo->map(function ($item) {
            return [
                'id' => $item->id,
                'client_name_en'=> $item->client_name_en,
                'client_name_ar' => $item->client_name_ar,
                'image' => $this->getImagePathFromDirectory($item->image, 'evaluations'),
                'evaluate_ar'=> $item->evaluate_ar,
                'evaluate_en'=> $item->evaluate_en,
            ];
        });

        $instegramBanner = \App\Models\InstegramBroadcast::first();
        // if (!$instegramBanner) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Instagram Banner not found',
        //     ], 404);
        // }

        $instegramBannerFirst = \App\Http\Resources\InstegramBannerResource::make($instegramBanner);
        
        $instegramBroadcasts = \App\Models\InstegramBroadcast::orderBy('id','desc')->take(4)->get();
        
        // if ($instegramBroadcasts->isEmpty()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Instagram Broadcasts not found',
        //     ], 404);
        // }
        $fourBroadCasts = \App\Http\Resources\FourBroadCastsResource::collection($instegramBroadcasts);
        
        $prvicayPolicy = \App\Models\PrivacyPolicy::first();
        // if (!$prvicayPolicy) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Privacy Policy not found',
        //     ], 404);
        // }
        $formatPrivacyPolicy = [
            'title_ar' => $prvicayPolicy->title_ar,
            'title_en' => $prvicayPolicy->title_en,
            'content_ar' => $prvicayPolicy->content_ar,
            'content_en' => $prvicayPolicy->content_en,
        ];
        $termsOfUse = \App\Models\TermsAndConditions::first();
        // if (!$termsOfUse) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Terms of Use not found',
        //     ], 404);
        // }
        $formatTermsOfUse = [
            'title_ar' => $termsOfUse->title_ar,
            'title_en' => $termsOfUse->title_en,
            'content_ar' => $termsOfUse->content_ar,
            'content_en' => $termsOfUse->content_en,
        ];
        
        $landingPageData = [
            'header' => [
                'socialMedia' =>\App\Http\Resources\SocialMediaResource::collection($socialMedia),
            ],
            'heroSection' => $heroSection,
            'myVision' => $formatMyVision,
            'myMission' => $formatMyMission,
            'professionalAppreciation' => $formatProfessionalAppreciation,
            'adoptedMethodology' => $formatAdoptedMethodology,
            'trainingPrograms' => $formatTrainingPrograms,
            'communityImpact' => $formatCommunityImpact,
            'evaluation' => $mapEvaluation,
            'evaluationWithoutVideo' => $mapEvaluationWithoutVideo,
            'liveBanner' => $instegramBannerFirst,
            'fourBroadCasts' => $fourBroadCasts,
            'currentProjects' => $formatCurrentProjects,
            'footer'=>[
                'contactMe' => \App\Http\Resources\SocialMediaResource::collection($socialMedia),
                'followMe' =>\App\Http\Resources\SocialMediaResource::collection($socialMedia) ,
                'privacyPolicy' => $formatPrivacyPolicy,
                'termsOfUse' => $formatTermsOfUse,
            ],
            
        ];
        
        return response()->json([
            'status' => 'success',
            'data' => $landingPageData,
        ]);

    }
}
