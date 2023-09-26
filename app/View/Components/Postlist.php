<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Postlist extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $username,
        public string $title,
        public string $id,
        public string $subtitle,
        public string $ownerid,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.postlist');
    }
}
