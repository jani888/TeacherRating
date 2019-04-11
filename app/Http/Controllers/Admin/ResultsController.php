<?php

namespace App\Http\Controllers\Admin;

use App\Models\SchoolClass;
use App\Models\Teacher;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
    public function index() {
        $stats = $this->getStats();
        //$chart = $this->getChartData();
        $by_teachers_table = $this->getByTeachersTable();
        $by_classes_table = $this->getByClassesTableData();
        return view('admin.results', compact('stats', 'by_teachers_table', 'by_classes_table'));
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

    private function getByClassesTableData() {
        $school_classes = SchoolClass::with('students')->get();
        $table = $school_classes->map(function ($class){
            $class['students_count'] = $class->students->count();
            $class['voted'] = $class->students()->whereNotNull('voted_at')->count();
            $class['percentage'] = $class['students_count'] == 0 ? 0 :$class['voted']/$class['students_count']*100;
            return $class;
        })->toArray();

        return $table;
    }

    private function getByTeachersTable() {
        $teachers = Teacher::with('ratings')->get();
        $results = $teachers->map(function (Teacher $teacher){
            return [
                'name' => $teacher->name,
                'count' => $teacher->ratings->count(),
                'avg' => $teacher->ratings->count() == 0 ? '-' : $teacher->ratings->sum('value') / $teacher->ratings->count()
            ];
        });
        return $results;
    }
}
