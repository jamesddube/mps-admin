<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 7/25/16
 * Time: 12:15 PM
 */

namespace App\Mps\Traits;


use App\Mps\Response\Response;
use Prettus\Repository\Eloquent\BaseRepository;

trait SyncableTrait
{

    /** @return BaseRepository */
    public abstract function repo();

    /**
     * 
     * Return listing of new resources
     * 
     * @param $ids
     * @return mixed
     */
    public function syncNew($ids)
    {
        return $models = $this->repo()->findWhereNotIn('id',$ids);

    }

    public function syncModified($ids)
    {
        $models = $this->repo()->findWhereIn('id',$ids);
    }

    public function syncDeleted()
    {
        
    }
}