<?php

namespace App\Imports;
use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Auth;

class Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Post([
            'title'     => $row[0],
            'description'    => $row[1],
            'status' => $row[2],
            'create_user_id' => Auth::user()->id,
            'updated_user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}