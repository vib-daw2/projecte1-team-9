<?php

namespace App\View\Components;

use App\Models\Comment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class commentSingle extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Comment $comment,
        public bool $isResponse = false,
        public int $id
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comment-single');
    }
}
