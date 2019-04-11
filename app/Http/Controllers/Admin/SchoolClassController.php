<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{

    public function index() {
        $classes = SchoolClass::orderBy(\DB::raw('cast(name as unsigned)'))->get();
        return view('admin.classes', compact('classes'));
    }

    public function store(Request $request) {
        SchoolClass::query()->update(['can_vote' => false]);
        foreach($request->can_vote as $class_id => $can_vote){
            SchoolClass::find($class_id)->update(['can_vote' => true]);
        }
        $request->session()->flash('status', 'success');
        return back();
    }
}
