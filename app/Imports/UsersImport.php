<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\SchoolClass;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class UsersImport implements ToModel, WithHeadingRow, WithChunkReading, WithProgressBar
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $school_class = SchoolClass::where('name', $row['osztaly'])->first();
        if($school_class == null){
            //Már kiiratkozott
            return null;
        }
        return new User([
            'name' => $row['nev'],
            'password' => bcrypt($row['oktatasi_azonosito']),
            'school_class_id' => $school_class->id
        ]);
    }

    /**
     * @return int
     */
    public function chunkSize(): int {
        return 100;
    }
}
