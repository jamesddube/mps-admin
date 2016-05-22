<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api;
use Closure;
use Illuminate\Support\Facades\App;
use OAuth2\HttpFoundationBridge\Request as OauthRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OauthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {

       if(!$request->has('access_token'))
        {
            throw new BadRequestHttpException('access token not found');
        }

        $req = Request::createFromGlobals();
        $brigedRequest = OauthRequest::createFromRequest($req);
        $brigedResponse = new \OAuth2\HttpFoundationBridge\Response();

        if(!$token = App::make('oauth2')->getAccessTokenData($brigedRequest,$brigedResponse))
        {
            $response = App::make('oauth2')->getResponse();

            if($response->isClientError() && $response->getParameter('error'))
            {
                if($response->getParameter('error') == 'expired_token')
                {
                    new BadRequestHttpException("the token has expired");
                    //return $response->send();
                }

                throw new BadRequestHttpException('the access token provided is invalid');
            }
        }
        else
        {
            $request['user_id'] = $token['user_id'];
        }

        return $next($request);
    }
}
