<?php

namespace App\Exports;

use App\Models\RatingType;
use App\Models\Teacher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ResultsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting {


    /**
     * @param Teacher $teacher
     *
     * @return array
     */
    public function map($teacher): array {
        $row = [];
        $row[] = $teacher->name;
        $row[] = $teacher->rating_count;
        $row[] = number_format($teacher->ratingAverage, 2);
        $ratings = $teacher->ratings->pluck('average')->toArray();
        $ratings = array_map(function ($rating) {
            return number_format($rating, 2);
        }, $ratings);
        $row = array_merge($row, $ratings);
        return $row;
    }

    /**
     * @return Collection
     */
    public function collection() {
        return Teacher::with([
            'ratings',
            'ratings.ratingType',
        ])->get()->map(function ($teacher) {
            $teacher->ratings = $teacher->ratings->sortBy('ratingType.id')->groupBy('rating_type_id')->map(function ($row) {
                return (object) [
                    'average' => $row->count() == 0 ? 0 : $row->sum('value') / $row->count(),
                    'count' => $row->count(),
                    'ratingType' => $row[0]->ratingType ?? null,
                ];
            });
            return $teacher;
        });
    }

    public function headings(): array {
        $ratingTypes = RatingType::orderBy('id')->get()->pluck('name')->toArray();
        $header = [
            'Tanár',
            'Összes értékelő diák',
            'Átlag',
        ];
        $header = array_merge($header, $ratingTypes);
        return $header;
    }

    /**
     * @return array
     */
    public function columnFormats(): array {
        return [
            NumberFormat::FORMAT_GENERAL,
            NumberFormat::FORMAT_NUMBER,
            NumberFormat::FORMAT_NUMBER,
        ];
    }
}
