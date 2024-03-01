<?php

namespace App\Imports;

use App\Models\thanhpho;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');


class TinhImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new thanhpho([
            'id' => $row['id'],
            'tenthanhpho' => $row['tenthanhpho'],
        ]);
    }
}
