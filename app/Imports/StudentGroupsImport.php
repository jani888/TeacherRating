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

    protected $users, $groups;

    /**
     * @param Row $row
     */

    public function __construct() {
        $this->users = User::all();
        $this->groups = Group::all();
    }

    public function onRow(Row $row) {
        if($row->toArray()['kisorolas_datum'] != null){
            //Már kiiratkozott
            return false;
        }
        //row[1]: user name
        $user = $this->users->firstWhere('code', $row->toArray()['tanulo_oktatasi_azonosito']);
        $group = $this->groups->firstWhere('name', $row->toArray()['osztaly_csoport']);
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
