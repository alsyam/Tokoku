<?php

namespace App\Exports;

use App\Models\Checkout;
use Maatwebsite\Excel\Concerns\FromCollection;

class CheckoutExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Checkout::all();
    }
}
