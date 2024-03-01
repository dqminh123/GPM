<?php

namespace App\Imports;

use App\Models\huyen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class HuyenImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new huyen([
            'id' => $row['id'],
            'tenhuyen' => $row['tenhuyen'],
            'thanhpho_id' => $row['thanhpho_id'],
        ]);
    }
}
