<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $stats = $this->getStats();
        return view('admin.dashboard', compact('stats'));
    }

    private function getStats() {
        $voted = User::voted()->count();
        $total = User::count();
        return [
            'voted' => number_format($voted),
            'total' => number_format($total),
            'voted_percentage' => number_format($voted / $total * 100) . " %"
        ];
    }
}
