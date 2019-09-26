<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('admin.dashboard')
            ->with('post_count', Post::all()->count())
            ->with('trashed_count', Post::onlyTrashed()->get()->count())
            ->with('user_count', User::all()->count())
            ->with('category_count', Category::all()->count());
    }
}
