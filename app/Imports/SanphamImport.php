<?php

namespace App\Imports;

use App\Models\sanpham;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class SanphamImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new sanpham([
            'tensp'=>$row['tensp'], 
            'anh'=>$row['anh'],
            'anh1'=>$row['anh1'],
            'anh2'=>$row['anh2'],
            'anh3'=>$row['anh3'],
            'soluong'=>$row['soluong'], 
            'gianhap'=>$row['gianhap'], 
            'giaxuat'=>$row['giaxuat'], 
            'loai_id'=>$row['loai_id'],
            'hang_id'=>$row['hang_id'], 
            'noisanxuat_id'=>$row['noisanxuat_id'],
            'baohanh_id'=>$row['baohanh_id'],
            'chitiet'=>$row['chitiet'],
            'video'=>$row['video'],
        ]);
    }
}