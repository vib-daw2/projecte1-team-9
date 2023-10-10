<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class NewController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('blog/new');
    }

    /**
     * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function new(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $blog = new Blog();

        if (!auth()->check()) {
            abort(403);
        }

        try {
            $validated = $this->validate(request(), Blog::validate());
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $blog->title = $validated['title'];
        $blog->subtitle = $validated['subtitle'];
        $blog->body = $validated['body'];
        $blog->status = $validated['status'];
        $blog->user_id = Auth::id();
        if (isset($validated['image'])) {
            $imageName = time() . '.' . $blog->title . Auth::id() . '.' . $validated['image']->extension();
            $validated['image']->move(public_path('images'), $imageName);
            $blog->picture = $imageName;
        }
        $blog->save();

        $insertedId = $blog->id;

        return redirect('/blog/' . $insertedId);
    }
}
