<?php


class UserTest extends TestCase
{
    public  function testCanCreateUser()
    {
        $user = factory('App\User')->create();

        $this->seeInDatabase('users', ['email' => $user->email]);
    }
    
    public function testCanLogIn()
    {
        $user = \App\User::first();
        ($user);
    }

}