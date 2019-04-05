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

class GroupsImport implements OnEachRow
{

    /**
     * @param Row $row
     */
    public function onRow(Row $row) {
        $group = Group::firstOrCreate([
            'name' => $row[1] ?? $row[0]
        ]);
        $teacher = Teacher::findByName($row[4]);
        $group->teachers()->attach($teacher);
    }
}
