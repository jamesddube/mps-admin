<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwUser extends Model
{
    //
    
    public function scopeReps($query)
    {
        return $query->where('user_type','Sales Representative');
    }

}
