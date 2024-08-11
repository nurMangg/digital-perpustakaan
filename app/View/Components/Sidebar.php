<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{

    public $menuItems;
    public $active;

    /**
     * Create a new component instance.
     */
    public function __construct($menuItems = [], $active = null)
    {
        $this->menuItems = $menuItems;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}