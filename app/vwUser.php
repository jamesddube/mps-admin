<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwUser extends Model
{
    public static function reps()
    {
        return self::where('user_type','Sales Representative');
    }
}
