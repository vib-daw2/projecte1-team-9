<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class DeleteController extends Controller
{
    /**
     * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function delete(): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $blog = Blog::where('id', request('id'))->first();

        try {
            $this->authorize('delete', $blog);
        } catch (\Throwable $th) {
            return redirect('/blog/' . request('id'))->with('status', ['success' => false, 'title' => 'Failed to delete blog', 'message' => 'You dont have permissions to delete this blog']);
        }

        $blog->delete();

        return redirect('/blog')->with('status', ['success' => true, 'title' => 'Blog deleted succesfully', 'message' => '']);
    }
}