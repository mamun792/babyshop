<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaUploadRequest;
use App\Models\MediaFile;
use App\Traits\ImageManipulation;
use Illuminate\Http\Request;

class MediaController extends Controller
{

  use ImageManipulation;

  public function index()
  {
    return view('web.dashboard.media.index');
  }

  public function uploadMedia(MediaUploadRequest $request)
  {
    $request->validated();
      $user = auth()->user()->id;
      $mediaCategories = ['logo', 'favicon', 'loader', 'footer_image'];

      foreach ($mediaCategories as $category) {
          $path = $this->storeImage($request, $category, 'media');
          if ($path) {
              $media = new MediaFile();
              $media->file_name = $category;
              $media->file_type = 'image';
              $media->file_path = $path;
              $media->media_category = $category;
              $media->uploaded_by = $user;
              $media->save();
          }
      }


      toastr()->success('Media files uploaded successfully');

    return back();
  }
}
