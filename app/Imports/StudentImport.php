<?php

namespace App\Imports;

use App\Models\Base_Persons;
use App\Models\Base_UniversityStudents;
use Illuminate\Console\OutputStyle;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class StudentImport implements ToModel,WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return Base_UniversityStudents
    */
    public function model(array $row)
    {
//        return $row;
//        dd($row['firstname']);
        $Person=new Base_Persons();
        $Person->Name=$row['firstname'];
        $Person->Family=$row['family'];
        $Person->NationalCode=$row['nationalcode'];
        $Person->Gender=$row['gender'];
        $Person->save();
//        $person=Base_Persons::create([
//            'Name'=>$row['firstname'],
//            'Family'=>$row['family'],
//            'NationalCode'=>$row['nationalcode'],
//            'Gender'=>$row['gender'],
//        ]);
//        return $Person;
        return new Base_UniversityStudents([
            'PersonId'=>$Person->id,
            'PersonalCode'=>$row['personalcode'],
            'CollegeId'=>'055',
            'FieldId'=>'1',
            'DegreeId'=>'2',
        ]);
    }
}
