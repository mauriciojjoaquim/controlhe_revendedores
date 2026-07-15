<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserBar extends Component
{
    /**
     * Create a new component instance.
     */
    public $menuHorText;
    public $menuHor;
    
    public function __construct($menuHorText, $menuHor)
    {
        $this->menuHorText = $menuHorText;
        $this->menuHor = $menuHor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-bar');
    }
}