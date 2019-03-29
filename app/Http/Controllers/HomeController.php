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
        $teachers = auth()->user()->load('groups')->groups->pluck('teacher');
        $rating_types = RatingType::all();
        dd(['teachers' => $teachers, 'rating_types' => $rating_types]);
        return view('home', ['teachers' => auth()->user()->teachers, 'rating_types' => $rating_types]);
    }
}
