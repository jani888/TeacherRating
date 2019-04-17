<?php

namespace App\Http\Controllers;

use App\Models\RatingType;
use App\Models\Text;
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
        $rating_info = Text::where('key', 'rating_info')->first()->value;
        $teachers = auth()->user()->load('groups')->groups->pluck('teachers')->flatten()->unique('name');
        $rating_types = RatingType::all();
        return view('home', ['teachers' => $teachers, 'rating_types' => $rating_types, 'rating_info' => $rating_info]);
    }
}
