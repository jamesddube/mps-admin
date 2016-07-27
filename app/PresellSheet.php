<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresellSheet extends Model
{
    use SoftDeletes;
    
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'user_id'
    ];
}
