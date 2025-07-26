<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
trait ImageTrait
{


    protected function uploadImageToDirectory($imageFile, $model = '')
    {
        $model     = Str::plural($model);
        $model     = Str::ucfirst($model);
        $path      = "/Images/$model";
        $imageName = str_replace(' ', '', 'portofolio_' . time() . $imageFile->getClientOriginalName());  // Set Image name
        $imageFile->storeAs($path, $imageName, 'public');
        return $imageName;
    }



    protected function updateModelImage($model, $imageFile, $directory)
    {
        if($model->icon)
        {
            $this->deleteImageFromDirectory($model->icon, $directory);
        }
        $this->deleteImageFromDirectory($model->image, $directory);
        return $this->uploadImageToDirectory($imageFile, $directory);
    }







    protected function deleteImageFromDirectory($imageName, $model)
    {
        $model = Str::plural($model);
        $model = Str::ucfirst($model);

        if ($imageName != 'default.png')
        {
            $path = "/Images/" . $model . '/' . $imageName;
            Storage::disk('public')->delete($path);
        }
    }





    protected function getImagePathFromDirectory($imageName = null, $directory = null, $defaultImage = 'default.svg')
    {
        $directory = Str::plural($directory);
        $directory = Str::ucfirst($directory);

        $imagePath         = "/storage/Images/$directory/$imageName";
        $callbackImagePath = "placeholder_images/$directory/$defaultImage";

        if ($imageName && $directory && file_exists(public_path($imagePath)))
            return asset($imagePath);
        else if (file_exists($callbackImagePath))
            return asset($callbackImagePath);
        else
            return asset("/placeholder_images/$defaultImage");
    }



}