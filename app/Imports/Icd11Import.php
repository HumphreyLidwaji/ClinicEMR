<?php

namespace App\Imports;

use App\Models\Icd11;
use Maatwebsite\Excel\Concerns\ToModel;

class Icd11Import implements ToModel
{
    public function model(array $row)
    {
        return new Icd11([
            'code' => $row[0],
            'description' => $row[1],
        ]);
    }
}