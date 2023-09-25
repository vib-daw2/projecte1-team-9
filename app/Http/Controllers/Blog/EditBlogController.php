<?php

namespace App\Http\Controllers\Blog;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EditBlogController extends Controller
{
    public function render(string $id){
        $blog = Blog::where('id', $id)->first();

        try {
            $this->authorize('update', $blog);
        } catch (\Throwable $th) {
            return redirect('/blog/'.$id);
        }

        return view('editblog', ['blog' => $blog, 'id' => $id]);
    }

    public function edit(){
        $blog = Blog::where('id', request('id'))->first();

        try {
            $this->authorize('update', $blog);
        } catch (\Throwable $th) {
            return redirect('/blog/'.request('id'));
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

        return redirect('/blog/'.request('id'));
    }
}
