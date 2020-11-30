<?php

namespace App\Imports;

use App\Models\File;
use Maatwebsite\Excel\Concerns\ToModel;

class FileImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new File([
            'date' => $row[0],
            'description' => $row[1],
            'nominal' => $row[2],
            'balance' => $row[3],
        ]);
    }
}
