<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\Teacher;
use App\User;
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

class StudentGroupsImport implements OnEachRow, WithChunkReading, WithHeadingRow, WithProgressBar
{
    use Importable;
    /**
     * @param Row $row
     */
    public function onRow(Row $row) {
        if($row->toArray()['kisorolas_datum'] != null){
            //Már kiiratkozott
            return false;
        }
        //row[1]: user name
        $user = User::where('name', $row->toArray()['tanulo_neve'])->first();
        $group = Group::where('name', $row->toArray()['osztaly_csoport'])->first();
        if($group == null){
            //Csoport megszűnt
            //todo: figyelmeztetni az users h lehet h rossz a fájl
            return false;
        }
        $group->users()->attach($user->id);
    }

    /**
     * @return int
     */
    public function chunkSize(): int {
        return 500;
    }
}
