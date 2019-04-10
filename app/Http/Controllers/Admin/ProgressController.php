<?php

namespace App\Http\Controllers\Admin;

use App\Models\ImportProgress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgressController extends Controller
{

    public function show(ImportProgress $progress) {
        return $progress;
    }
}
