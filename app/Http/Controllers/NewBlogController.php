<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
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
        return view('newblog');
    }

    public function uploadBlog(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $blog = new Blog();
        try {
            $this->authorize('create', $blog);
        } catch (\Throwable $th) {
            abort(403);
        }

        try {
            $validated = $this->validate(request(), [
                'title' => 'required|min:3|max:255',
                'subtitle' => 'required|min:3|max:255',
                'body' => 'required|min:3',
                'status' => 'required|in:draft,published'
            ]);
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
