<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Row;

class TeachersImport implements ToModel, WithChunkReading, WithProgressBar, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return Model|Model[]|null
     */
    public function model(array $row) {
        if(Teacher::findByName($row['tanar'])->first() != null){
            return null;
        }
        return new Teacher(['name' => $row['tanar']]);
    }

    /**
     * @return int
     */
    public function chunkSize(): int {
        return 500;
    }
}
