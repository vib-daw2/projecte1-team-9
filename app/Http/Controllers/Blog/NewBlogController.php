<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class NewBlogController extends Controller
{
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $this->authorize('create', Blog::class);
        } catch (\Throwable $th) {
            abort(403);
        }
        return view('blog/new');
    }

    public function create(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $blog = new Blog();
        try {
            $this->authorize('create', $blog);
        } catch (\Throwable $th) {
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
        $blog->save();

        $insertedId = $blog->id;

        return redirect('/blog/' . $insertedId);
    }
}
