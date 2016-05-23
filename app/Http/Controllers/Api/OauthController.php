<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 5/5/16
 * Time: 8:12 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use OAuth2\HttpFoundationBridge\Request;
use OAuth2\HttpFoundationBridge\Response;

class OauthController extends Controller
{
    public function getToken(\Illuminate\Http\Request $request)
    {
        $bridgedRequest = Request::createFromRequest($request->instance());
        $bridgedResponse = new Response();

        $bridgedResponse = App::make('oauth2')->handleTokenRequest($bridgedRequest , $bridgedResponse);

        return $bridgedResponse;
    }

}