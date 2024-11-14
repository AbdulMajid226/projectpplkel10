<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavBar extends Component
{
    public $items;
    public $name;
    public $role;
    public function __construct($items = [], $name = 'Guest', $role = 'User')
    {
        $this->items = $items;
        $this->name = $name;
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }
}
