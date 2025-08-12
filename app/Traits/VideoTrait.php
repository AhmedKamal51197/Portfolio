<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait VideoTrait
{
    protected function uploadVideoToDirectory($videoFile, $model = '')
    {
        $model     = Str::plural($model);
        $model     = Str::ucfirst($model);
        $path      = "/Videos/$model";
        $videoName = str_replace(' ', '', 'video_' . time() . $videoFile->getClientOriginalName());

        $videoFile->storeAs($path, $videoName, 'public');

        return $videoName;
    }

    protected function updateModelVideo($model, $videoFile, $directory)
    {

        $this->deleteVideoFromDirectory($model->video, $directory);
        return $this->uploadVideoToDirectory($videoFile, $directory);
    }

    protected function deleteVideoFromDirectory($videoName, $model)
    {
        $model = Str::plural($model);
        $model = Str::ucfirst($model);

        $path = "/Videos/" . $model . '/' . $videoName;

        Storage::disk('public')->delete($path);
    }

    protected function getVideoPathFromDirectory($videoName = null, $directory = null, $defaultVideo = 'default.mp4')
    {
        $directory = Str::plural($directory);
        $directory = Str::ucfirst($directory);

        $videoPath         = "/storage/Videos/$directory/$videoName";
        $fallbackVideoPath = "placeholder_videos/$directory/$defaultVideo";
        dd(file_exists(public_path($videoPath)));
        if ($videoName && $directory && file_exists(public_path($videoPath))) {
            return asset($videoPath);
        } elseif (file_exists($fallbackVideoPath)) {
            return asset($fallbackVideoPath);
        } else {
            return asset("/placeholder_videos/$defaultVideo");
        }
    }
}
