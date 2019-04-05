<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class TeachersImport implements ToModel
{

    /**
     * @param array $row
     *
     * @return Model|Model[]|null
     */
    public function model(array $row) {
        if(Teacher::findByName($row[4])){
            return null;
        }
        return new Teacher(['name' => $row[4]]);
    }
}
