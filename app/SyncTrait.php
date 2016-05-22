<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/20/16
 * Time: 1:54 AM
 */

namespace App;


trait SyncTrait
{
    public function scopeUnsynced($query,$date)
    {
        return $query->where('updated_at','>',$date);
    }

}