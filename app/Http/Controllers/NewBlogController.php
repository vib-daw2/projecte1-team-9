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
        return view('newblog');
    }

    public function uploadBlog(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $validated = $this->validate(request(), [
                'title' => 'required|min:3|max:255',
                'subtitle' => 'required|min:3|max:255',
                'body' => 'required|min:3',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $blog = new Blog();
        $blog->title = $validated['title'];
        $blog->subtitle = $validated['subtitle'];
        $blog->body = $validated['body'];
        $blog->status = 'published';
        $blog->user_id = Auth::id();
        $blog->save();

        return redirect('/');
    }
}
