<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 7/20/16
 * Time: 12:22 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Mps\Repositories\OrderRepository;
use App\Mps\Repositories\PresellSheetRepository;
use App\Mps\Transformers\OrderTransformer;
use App\Mps\Transformers\PresellSheetTransformer;
use App\Mps\Validators\OrderValidator;
use App\Mps\Validators\PresellSheetValidator;
use App\PresellSheet;
use Illuminate\Support\Collection;

class PresellSheetController extends ApiController
{
    public function __construct(PresellSheetRepository $repository, PresellSheetTransformer $transformer, PresellSheetValidator $collectionValidator)
    {
        parent::__construct($repository, $transformer, $collectionValidator);
    }

    public function index()
    {
        return parent::index();
        $one = array('one','two','five'=>'d');
        $two = array('three','four','five'=>'l');

        //return $one->merge($two);

        return array_merge($one,$two);


       $sheets =  $this->repository->paginate(0);

        return($sheets->toArray());
        return $sheets = PresellSheet::paginate(2);

        return response()->json(['sheets' => $sheets]);
    }


}