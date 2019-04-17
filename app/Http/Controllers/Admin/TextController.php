<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\Text;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TextController extends Controller
{
    public function set($key, Request $request) {
        $text = Text::where('key', $key)->first();
        $text->value = $request->value;
        $text->save();
        return back();
    }
}
