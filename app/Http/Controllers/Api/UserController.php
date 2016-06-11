<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Intersect\Api\Controller\ApiController;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    

    public function store(Request $request)
	{
		if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            // Authentication passed...
            return "authenticated";
        }
        else
        {
        	return "not authenticated";
        }
	}
}
