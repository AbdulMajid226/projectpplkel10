<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavBar extends Component
{   
    public $name;
    public $role;
    public $email;
    public function __construct($name = 'Guest', $role = 'User', $email = 'user@gmail.com')
    {

        $this->name = $name;
        $this->role = $role;
        $this->email = $email;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }
}