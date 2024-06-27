<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $route;
    public $attr;
    public $upload;
    public $update;

    public function __construct($route = null,$upload = false, $update = null, $attr = null)
    {
        $this->route  = $route;
        $this->attr   = $attr;
        $this->upload = $upload;
        $this->update = $update; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
