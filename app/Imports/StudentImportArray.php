<?php


namespace App\Imports;


use App\Models\Base_Persons;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImportArray implements ToArray,WithHeadingRow
{
    public function array(array $array)
    {

    }
}
