<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\SchoolClass;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SchoolClassesImport implements OnEachRow, WithHeadingRow, WithChunkReading, ShouldQueue
{

    /**
     * @param Row $row
     */
    public function onRow(Row $row) {
        if($row->toArray()['osztaly'] == null) return;
        SchoolClass::firstOrCreate(['name' => $row->toArray()['osztaly']]);
    }

    /**
     * @return int
     */
    public function chunkSize(): int {
        return 500;
    }
}
