<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\Teacher;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class StudentGroupsImport implements OnEachRow
{

    /**
     * @param Row $row
     */
    public function onRow(Row $row) {
        if($row[4] != null){
            //Már kiiratkozott
            return false;
        }
        //row[1]: user name
        $user = User::findByCode($row[1]);
        $group = Group::where('name', $row[2])->first();
        $group->users()->attach($user);
    }
}
