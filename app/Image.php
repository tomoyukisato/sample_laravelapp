<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $fillable =[
        'memo_id',
        'file_path'
    ];
}
