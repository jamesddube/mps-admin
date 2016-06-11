<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2/28/16
 * Time: 8:27 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Intersect\Api\Controller\ApiController;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class SampleController extends  Controller
{
    public function index(Request $request)
    {
        throw new UnauthorizedHttpException("kk");
    }

}