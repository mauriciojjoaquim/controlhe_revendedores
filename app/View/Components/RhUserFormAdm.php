<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RhUserFormAdm extends Component
{
    public $departments;
    public $colaborator;
    /**
     * Create a new component instance.
     */
    public function __construct($departments, $colaborator)
    {
        $this->departments = $departments;
        $this->colaborator = $colaborator;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rh-user-form-adm');
    }
}
