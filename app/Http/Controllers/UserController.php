<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Repositories\SalesRepRepository;
use DB;
use App\vwUser;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserController extends Controller
{

    use AuthenticatesAndRegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all the users
        $users = vwUser::all();
        
        return view ('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get all the user types
        $user_types = DB::table('user_types')->get();

        return view('users.create',compact('user_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->uploadAvatar($request);
        //User::create($request->all());

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            if(!$file->move('assets/uploads',$file->getClientOriginalName()))
            {
                throw new \Exception('cannot upload');
            }
        }
        else throw new BadRequestHttpException('no image found');
    }
    
    public function salesReps()
    {
        $users =  vwUser::reps()->get();

        return view ('sales_reps.index',compact('users'));
    }

    public function salesRepsShow($id)
    {
        $user =  SalesRepRepository::show($id);

        return view ('sales_reps.show',compact('user'));
    }
}
