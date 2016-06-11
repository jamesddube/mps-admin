<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/19/16
 * Time: 11:38 PM
 */

namespace App\Intersect\Api\Controller;


use Illuminate\Database\Eloquent\Model;

class SyncController
{
    /** 
     *  Checks for new or updated Models. Just pass in the model
     *  and the last time you updated. The Sync Manager will then check
     *  the database for models created/updated after your your last sync
     *
     *  @param Model $model 
     */
    public function getUpdated(Model $model)
    {
        return $model->sync();
    }
}