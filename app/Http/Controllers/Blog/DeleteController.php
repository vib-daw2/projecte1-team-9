<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete(){
        $blog = Blog::where('id', request('id'))->first();

        try {
            $this->authorize('delete', $blog);
        } catch (\Throwable $th) {
            return redirect('/blog/'.request('id'));
        }

        $blog->delete();

        return redirect('/blog');
    }
}
