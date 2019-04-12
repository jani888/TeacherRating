<?php

namespace App\Http\Controllers\Admin;

use App\Models\SchoolClass;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $stats = $this->getStats();
        $chart = $this->getChartData();
        $table = $this->getTableData();
        return view('admin.dashboard', compact('stats', 'chart', 'table'));
    }

    private function getStats() {
        $voted = User::voted()->count();
        $total = User::count();
        return [
            'voted' => number_format($voted),
            'total' => number_format($total),
            'voted_percentage' => number_format( ($total == 0) ? 0 : $voted / $total * 100) . " %"
        ];
    }

    private function getChartData(){
        $period = CarbonPeriod::create(Carbon::today()->subDays(5), Carbon::today());
        $users = User::all();
        $labels = [];
        $series = [];
        foreach ($period as $date){
            $labels[] = $date->format('Y-m-d');
            $series[] = $users->filter(function ($user) use ($date){
                if(!$user->hasVoted()) return false;
                return $user->voted_at->month == $date->month && $user->voted_at->day == $date->day;
            })->count();
        }
        return compact('labels', 'series');
    }

    private function getTableData() {
        $school_classes = SchoolClass::with('students')->get();
        $table = $school_classes->map(function ($class){
            $class['students_count'] = $class->students->count();
            $class['voted'] = $class->students()->whereNotNull('voted_at')->count();
            $class['percentage'] = $class['students_count'] == 0 ? 0 :$class['voted']/$class['students_count']*100;
            return $class;
        })->toArray();

        return $table;
    }
}
