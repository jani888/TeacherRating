<?php

namespace App\Http\Controllers;

use App\Models\RatingType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $teachers = auth()->user()->load('groups')->groups->pluck('teachers')->flatten()->unique();
        $rating_types = RatingType::all();
        return view('home', ['teachers' => $teachers, 'rating_types' => $rating_types]);
    }
}
