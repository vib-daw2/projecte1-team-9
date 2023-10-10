<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class DeleteController extends Controller
{
    /**
     * @param string $id
     * @return Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
     */
    public function delete(string $id): Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
    {
        try {
            $this->authorize('delete', User::find($id));
        } catch (Throwable $th) {
            abort(403, $th->getMessage());
        }

        $user = User::find($id);
        $user->delete();

        return redirect('/admin/users');
    }
}
