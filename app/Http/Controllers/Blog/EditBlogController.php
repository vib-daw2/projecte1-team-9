<?php

namespace App\Http\Controllers\Blog;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

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

        $blog->title = request('title');
        $blog->subtitle = request('subtitle');
        $blog->body = request('body');
        $blog->status = request('status');
        $blog->save();

        return redirect('/blog/'.request('id'));
    }
}
