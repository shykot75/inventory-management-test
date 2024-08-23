<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Store an uploaded image.
     *
     * @param UploadedFile $image
     * @param string $path
     * @return string The path to the stored image
     */
//    public function storeImage(UploadedFile $image, string $path = 'uploads/product-images'): string
//    {
//        // create image manager with desired driver
//        $manager = new ImageManager(new Driver());
//        // Generate a unique name for the image
//        $name = Str::random(5) . '.' . $image->getClientOriginalExtension();
//        $destinationPath = 'public/' . $path; // Use the public disk
//
//        $img = $manager->read($image);
//        $img = $img->resize(370, 246);
//        $img->toJpeg(80)->save(base_path($destinationPath . '/' . $name));
//        $save_url = 'uploads/product-images'.'/' . $name;
//
//        // Store the image in the specified directory
//        Storage::put($destinationPath . '/' . $name, (string) $resizedImage->encode());
//
//        return  $save_url; // Return the URL-friendly path
//    }
    public function storeImage(UploadedFile $image, string $path = 'uploads/product-images'): string
    {
        // Create image manager with the desired driver (using default or specified one)
        $manager = new ImageManager(new Driver());

        // Generate a unique name for the image
        $name = Str::random(5) . '.' . $image->getClientOriginalExtension();
        $destinationPath = storage_path('app/public/' . $path); // Use storage path for storage link

        // Ensure the directory exists
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        // Read, resize, and save the image
        $img = $manager->read($image);
        $img = $img->resize(400, 400);
        $img->toJpeg(80)->save($destinationPath . '/' . $name);

        // Prepare the URL-friendly path for storage in the database
        $save_url = $path . '/' . $name;

        return $save_url; // Return the URL-friendly path
    }



    /**
     * Update an existing image.
     *
     * @param UploadedFile $image
     * @param string|null $existingImagePath
     * @param string $path
     * @return string The path to the stored image
     */
    public function updateImage(UploadedFile $image, ?string $existingImagePath, string $path = 'uploads/product-images'): string
    {
        // Delete the existing image if it exists
        if ($existingImagePath && File::exists(storage_path('app/public/' . $existingImagePath))) {
            File::delete(storage_path('app/public/' . $existingImagePath));
        }

        // Store the new image
        return $this->storeImage($image, $path);
    }
}
