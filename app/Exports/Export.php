<?php

namespace App\Exports;

use App\Post;
use Maatwebsite\Excel\Concerns\FromCollection;

class Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Post::all();
    }
}