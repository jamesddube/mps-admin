<?php


namespace App\Mps\Support;



use Illuminate\Database\Eloquent\Collection;
class Helpers
{
    /**
     *
     * Builds an Array of Models to insert to the
     * database
     *
     * @param $modelClass
     * @param array $models
     * @return Collection
     */
    static function getModelCollection($modelClass ,array $models)
    {
        $orderCollection = new Collection();

        foreach ($models as $model)
        {
            $orderCollection->add(new $modelClass($model));
        }

        return ($orderCollection);
    }
}

