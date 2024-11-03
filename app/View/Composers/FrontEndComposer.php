<?php

namespace App\View\Composers;

use Illuminate\View\View;

class FrontEndComposer
{
    public function compose(View $view)
    {
        // $data 
        // Prepare data to be shared with the specific view
        $view->with('composerCartList', 'value');
    }
}
