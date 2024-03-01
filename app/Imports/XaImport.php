<?php

namespace App\Imports;

use App\Models\xa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');


class xaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new xa([
            'id' => $row['id'],
            'tenxa' => $row['tenxa'],
            'huyen_id' => $row['huyen_id'],
        ]);
    }
}
