<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class profilestats extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $username,
        public int $posts,
        public int $likes
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profilestats');
    }
}
