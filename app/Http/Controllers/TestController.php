<?php

namespace App\Http\Controllers;

use app\Traits\ImageManipulation;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use ImageManipulation;
    function newImageUpload(Request $request)
    {

        try {
            return   $this->storeImage($request, 'file', 'products');
        } catch (\Exception $e) {
            return $e->getMessage();
            //throw $th;
        }
    }


    
    function delete() {
        try {
            return   $this->deleteImage('products/1721039234_Capture.PNG');
        } catch (\Exception $e) {
            return $e->getMessage();
            //throw $th;
        } 
    }
}
