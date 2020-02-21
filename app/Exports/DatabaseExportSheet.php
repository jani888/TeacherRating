<?php

namespace App\Exports;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DatabaseExportSheet implements FromCollection, WithHeadings, WithTitle
{

    private $data;

    private $label;

    /**
     * DatabaseExportSheet constructor.
     *
     * @param $data
     */
    public function __construct(Collection $data, $label) {
        $this->data = $data;
        $this->label = $label;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function title(): string {
        return $this->label;
    }

    /**
     * @return array
     */
    public function headings(): array {
        if(count($this->data) == 0) return [];
        if($this->data[0] instanceof Model) return array_keys(Arr::except($this->data[0]->getAttributes(), $this->data[0]->getHidden()));
        return array_keys((array) $this->data[0]);
    }
}
