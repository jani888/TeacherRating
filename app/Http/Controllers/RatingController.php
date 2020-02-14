<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Rating;
use App\Models\RatingType;
use App\Models\Teacher;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function __construct() {
        //$this->middleware('auth');
    }

    public function create(Request $request){
        //$this->validate($request, ['ratings' => 'required|array', 'ratings.*.*' => 'required|integer|min:0|max:9']);

        $ratings = $request->ratings;

        foreach ($ratings as $teacher_id => $teacher_ratings){
            $teacher = Teacher::findOrFail($teacher_id);
            abort_if(!$teacher->groups->contains(function (Group $group){
                return $group->users()->get()->contains(function (User $user){
                    return $user->id == auth()->user()->id;
                });
            }), 404);
            $teacher->increment('rating_count');

            foreach ($teacher_ratings as $rating_type_id => $rating){
                if($rating == '-') continue;
                RatingType::findOrFail($rating_type_id);
                Rating::create([
                    'teacher_id' => $teacher_id,
                    'rating_type_id' => $rating_type_id,
                    'school_class_id' => auth()->user()->school_class_id,
                    'value' => $rating
                ]);
            }
        }
        auth()->user()->voted_at = Carbon::now();
        auth()->user()->save();
        return back();
    }
}
