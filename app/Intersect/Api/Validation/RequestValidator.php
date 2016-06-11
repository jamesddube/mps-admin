<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/1/15
 * Time: 8:02 PM
 */

namespace Intersect\Api\Validation;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Intersect\Api\Exception\ApiException;

class RequestValidator
{
    /** @private Request $request */
    private $request;

    protected $required;

    /**
     * RequestValidator constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function checkRequired()
    {
        foreach ($this->required as $item)
        {
            if($this->request->has($item) != true)
            {
                throw new ApiException("$item not found in request",400);
            }
        }
    }

}