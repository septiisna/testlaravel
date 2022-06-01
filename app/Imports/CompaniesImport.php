<?php

namespace App\Imports;

use App\Models\Companies;
use Maatwebsite\Excel\Concerns\ToModel;

class CompaniesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Companies([
            'nama' => $row[1],
            'email' => $row[2],
            'logo' => $row[3],
            'website' => $row[4]
        ]);
    }
}