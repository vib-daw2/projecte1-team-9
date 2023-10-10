<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Throwable;

class ReadController extends Controller
{
    public function render(): Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
    {
        try {
            $this->authorize('viewAny', User::class);
        } catch (Throwable $th) {
            abort(403, $th->getMessage());
        }
        $query = request()->query('s');

        $users = User::search($query)
            ->paginate(25)->withQueryString();

        return view('admin/users', ['users' => $users]);
    }


}