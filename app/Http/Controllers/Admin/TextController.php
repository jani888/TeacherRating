<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\Text;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TextController extends Controller
{
    public function set(Text $text, $value) {
        $text->value = $value;
        $text->save();
        return back();
    }
}
