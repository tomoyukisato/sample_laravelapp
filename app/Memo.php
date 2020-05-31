<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    public $fillable =[
        'title',
        'content',
        'start',
        'end',
        'allDay',
        'user_id'
    ];
}
