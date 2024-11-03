<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PolicyForm extends Component
{
    public $route;
    public $type;
    public $policies;
    
    public function __construct($route, $type, $policies)
    {
        $this->route = $route;
        $this->type = $type;
        $this->policies = $policies;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.policy-form');
    }
}
