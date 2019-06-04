<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ResultsExport;
use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\User;
use Maatwebsite\Excel\Facades\Excel;

class ResultsController extends Controller {

    public function index() {
	ini_set("memory_limit", "2048M");
        $stats = $this->getStats();
        //$chart = $this->getChartData();
        $resultsByTeachers = $this->getResultsByTeachers();
        $by_classes_table = $this->getByClassesTableData();
        return view('admin.results', compact('stats', 'resultsByTeachers', 'by_classes_table'));
    }

    public function export() {
        ini_set('memory_limit', '1024M');
        return Excel::download(new ResultsExport, 'eredmeny.xlsx');
    }

    private function getStats() {
        $voted = User::voted()->count();
        $total = User::count();
        return [
            'voted'            => number_format($voted),
            'total'            => number_format($total),
            'voted_percentage' => number_format($voted / $total * 100) . " %",
        ];
    }

    private function getResultsByTeachers() {
        return Teacher::with([
            'ratings',
            'ratings.ratingType',
        ])->orderBy('name')->get()->map(function ($teacher) {
            $teacher->ratings = $teacher->ratings->groupBy('rating_type_id')->map(function ($row) {
                return (object) [
                    'average'    => $row->count() == 0 ? 0 : $row->sum('value') / $row->count(),
                    'count'      => $row->count(),
                    'ratingType' => $row[0]->ratingType ?? null,
                ];
            });
            return $teacher;
        });
    }

    private function getByClassesTableData() {
        $school_classes = SchoolClass::with('students')->get();
        $table = $school_classes->map(function ($class) {
            $class['students_count'] = $class->students->count();
            $class['voted'] = $class->students()->whereNotNull('voted_at')->count();
            $class['percentage'] = $class['students_count'] == 0 ? 0 : $class['voted'] / $class['students_count'] * 100;
            return $class;
        })->toArray();

        return $table;
    }
}
