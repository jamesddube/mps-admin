<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api;
use Closure;
use Illuminate\Support\Facades\App;
use OAuth2\HttpFoundationBridge\Request as OauthRequest;
use OAuth2\HttpFoundationBridge\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OauthMiddleware
{
    protected $request;
    protected $access_token;
    protected $response;
    protected $bridgedRequest;
    protected $bridgedResponse;

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

        $this->boot($request);
        
        if($this->getAccessTokenData())
        {
            $this->setUserDetails();
            
            return $next($this->request);
        }
        else
        {
            $this->throwError();
        }
    }

    private function boot($request)
    {
        $this->request = $request;
        $req = Request::createFromGlobals();
        $this->bridgedRequest = OauthRequest::createFromRequest($req);
        $this->bridgedResponse = new Response();
        $this->response = App::make('oauth')->getResponse();
    }



    private function getAccessTokenData()
    {
        $this->access_token = App::make('oauth')->getAccessTokenData($this->bridgedRequest,$this->bridgedResponse);
        return is_null($this->access_token) ? false : true;
    }

    /**
     * @throws BadRequestHttpException
     */
    private function throwError()
    {

        if(!$this->request->has('access_token'))
        {
            throw new BadRequestHttpException('access token not found');
        }
        else if(!is_null($this->response) && $this->response->getParameter('error') == 'expired_token')
        {
            throw new BadRequestHttpException('the access token has expired');
        }
        else
        {
            throw new BadRequestHttpException('the access token provided is invalid');
        }
    }
    
    private function setUserDetails()
    {
        $this->request['user_id'] = $this->access_token['user_id'];
    }
}
