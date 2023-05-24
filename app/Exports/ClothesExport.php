<?php

namespace App\Exports;

use App\Models\Clothes;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClothesExport implements FromCollection
{
    public function collection()
    {
        return Clothes::all();
    }
}
