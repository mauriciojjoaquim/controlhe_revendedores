<?php

namespace App\View\Components;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LayoutCustomerApp extends Component
{
    
    public $pageTitle;
    public $colorSiteBg;
    public $bgColorTable;
    public $colorTableText;
    public $colorCardBg;
    public $colorCardText;
    public $bgColorMenuVert;
    public $colorMenuVertText;
    public $bgColorMenuHor;
    public $colorMenuHorText;
    public $textColorSite;

    
    /**
     * Create a new component instance.
     */
    public function __construct($pageTitle = null, $colorSiteBg, $bgColorTable, $colorTableText, $colorCardBg, $colorCardText, $bgColorMenuVert, $colorMenuVertText, $bgColorMenuHor, $colorMenuHorText, $textColorSite)
    {
        $this->pageTitle = $pageTitle;
        $this->colorSiteBg = $colorSiteBg;
        $this->bgColorTable = $bgColorTable;
        $this->colorTableText = $colorTableText;
        $this->colorCardBg = $colorCardBg;
        $this->colorCardText = $colorCardText;
        $this->bgColorMenuVert = $bgColorMenuVert;
        $this->colorMenuVertText = $colorMenuVertText;
        $this->bgColorMenuHor = $bgColorMenuHor;
        $this->colorMenuHorText = $colorMenuHorText;
        $this->textColorSite = $textColorSite;

        
 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout-customer-app');
    }
}