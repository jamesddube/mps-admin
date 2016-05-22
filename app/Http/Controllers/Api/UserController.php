<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Intersect\Api\Controller\ApiController;
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
        	echo "not authenticated";
        }
	}
}
