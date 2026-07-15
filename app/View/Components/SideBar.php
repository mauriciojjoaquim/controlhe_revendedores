<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBar extends Component
{
    /**
     * Create a new component instance.
     */
    public $menuVert;
    public $menuVertText;
    
    public function __construct($menuVert, $menuVertText)
    {
        $this->menuVert = $menuVert;
        $this->menuVertText = $menuVertText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar');
    }
}