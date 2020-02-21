<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DatabaseExport implements WithMultipleSheets
{

    protected $data;

    /**
     * DatabaseExport constructor.
     *
     * @param $data
     */
    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function sheets(): array {
        return $this->data->map(function ($sheet, $label){
            return new DatabaseExportSheet($sheet, $label);
        })->toArray();
    }
}
