<?php

namespace App\Http\Controllers\Admin;

use App\Models\RatingType;
use App\Models\Text;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingTypeController extends Controller
{
    public function index() {
        $rating_info = Text::where('key', 'rating_info')->first()->value;
        $rating_types = RatingType::all();
        return view('admin.rating_types', compact('rating_types', 'rating_info'));
    }

    public function on() {
        RatingType::get()->update(['on' => true]);
        return back();
    }

    public function off() {
        RatingType::get()->update(['on' => false]);
        return back();
    }

    public function delete(RatingType $ratingType) {
        $ratingType->delete();
        return back();
    }

    public function store(Request $request) {
        RatingType::create($request->only(['name', 'description']));
        return back();
    }

    public function update(RatingType $ratingType, Request $request) {
        $ratingType->update($request->only(['name', 'description']));
        return back();
    }
}
