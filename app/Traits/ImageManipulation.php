<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
trait ImageManipulation
{
    /**
     * Store a newly uploaded image.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $inputName
     * @param string $directory
     * @return string|null
     */
    public function storeImage(Request $request, string $inputName, string $directory): ?string
    {
        $prefix = 'images';
        if ($request->hasFile($inputName) && $request->file($inputName)->isValid()) {
            $image = $request->file($inputName);
            $path = $this->saveFile($image, $prefix.'/'.$directory);
            return $path;
        }

        return null;
    }

    /**
     * Update an existing image.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $inputName
     * @param string $directory
     * @param string|null $oldImagePath
     * @return string|null
     */
    public function updateImage(Request $request, string $inputName, string $directory, ?string $oldImagePath): ?string
    {
        if ($request->hasFile($inputName)) {
            // Delete the old image if it exists
            if ($oldImagePath && file_exists(public_path($oldImagePath))) {
                unlink(public_path($oldImagePath));
            }

            // Store the new image
            $image = $request->file($inputName);
            $path = $this->saveFile($image, $directory);
            return $path;
        }

        return $oldImagePath;
    }

    /**
     * Delete an existing image.
     *
     * @param string $imagePath
     * @return bool
     */
    public function deleteImage(string $imagePath): bool
    {
        if (file_exists(public_path($imagePath))) {
            return unlink(public_path($imagePath));
        }

        return false;
    }

    /**
     * Save a file to the specified directory.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string
     */
    protected function saveFile(UploadedFile $file, string $directory): string
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path($directory), $filename);

        return $directory . '/' . $filename;
    }
}

