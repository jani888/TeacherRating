<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function show(Teacher $teacher) {
        dd($teacher->name);
        return view('teacher.show', ['teacher' => $teacher]);
    }
}
