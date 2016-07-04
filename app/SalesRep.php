<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesRep extends User
{
    protected $table = 'users';

    public static function all($columns = ['*'])
    {
        return $users =  vwUser::reps()->get();
    }

    public static function show($id)
    {
        return self::where('user_type_id',1)->where('id',$id)->first();
    }
    
    public function orders()
    {
        return $this->hasMany('App\vwOrder','sales_rep','name');
    }
}
