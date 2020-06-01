<?php

namespace App\Exports;

use App\Country;
use Maatwebsite\Excel\Concerns\FromCollection;

class CountryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Country::all();
    }
}
