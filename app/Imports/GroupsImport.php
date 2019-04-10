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

class GroupsImport implements OnEachRow, WithChunkReading, WithProgressBar, WithHeadingRow
{
    use Importable;
    /**
     * @param Row $row
     */
    public function onRow(Row $row) {
        $group = Group::firstOrCreate([
            'name' => $row->toArray()['osztalycsoport']
        ]);
        $teacher = Teacher::findByName($row->toArray()['alkalmazott_neve'])->first();
        $group->teachers()->attach($teacher->id);
    }

    /**
     * @return int
     */
    public function chunkSize(): int {
        return 500;
    }
}
