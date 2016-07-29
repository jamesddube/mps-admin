<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api;
use Closure;
use Illuminate\Support\Facades\App;
use OAuth2\HttpFoundationBridge\Request as OauthRequest;
use OAuth2\HttpFoundationBridge\Response;
use Symfony\Component\HttpFoundation\Request;
use \App\Mps\Response\Response as ApiResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class OauthMiddleware
{
    /** @var  ApiResponse $response */
    private $response;

    /** @var Api\OauthController $controller */
    private $controller;

    /**
     * OauthMiddleware constructor.
     * @param ApiResponse $apiResponse
     * @param Api\OauthController $controller
     */
    public function __construct(ApiResponse $apiResponse, Api\OauthController $controller)
    {
        $this->response = $apiResponse;
        $this->controller = $controller;
    }


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

        if($this->controller->isValidToken()){
            return $next($request);
        }else{
            return $this->controller->getError();//$this->controller->getError();
        }
       /*//return $next($request);
       if(!$request->has('access_token'))
        {
            return $this->response->respondWithError('access token not found',401);
        }

        $req = Request::createFromGlobals();
        $brigedRequest = OauthRequest::createFromRequest($req);
        $brigedResponse = new Response();

        if(!$token = App::make('oauth')->getAccessTokenData($brigedRequest,$brigedResponse))
        {
            $response = App::make('oauth')->getResponse();

            if($response->isClientError() && $response->getParameter('error'))
            {
                if($response->getParameter('error') == 'expired_token')
                {
                    throw new UnauthorizedHttpException(null,"the access token has expired");
                }

                return $this->response->respondWithError('the access token provided is invalid',401);

            }
        }
        else
        {
            $request['user_id'] = $token['user_id'];
            return $next($request);
        }

        return $next($request);*/

        
    }
}
