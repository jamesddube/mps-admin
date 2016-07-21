<?php


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiCheckTest extends TestCase
{

    /**
     * My test implementation
     */
    public function testApiWorks()
    {
        $this->get('/api/check');
        $this->see('success');
    }

    public function testInvalidAccessToken()
    {
        $this->get('api/orders?access_token=k');


        /*$this->call('get','/api/orders',
            [
                'access_token' => 'r',
            ]
        );*/
        $this->seeJson(['message'=>'the access token provided is invalid']);
    }

    public function testAccessTokenRequired()
    {
        $this->visit('/api/orders');
        //$this->seeJson(['message'=>'access token not found']);
        $this->assertResponseStatus(401);
    }

    public function testOauthBadCredentialsResponseCode()
    {
        $this->call('post','api/oauth/token');
        $this->assertResponseStatus(400);
    }

    public function testGetAccessToken()
    {
        $this->call('post','/api/oauth/token',
            [
                'grant_type' => 'password',
                'client_id'  => 'testclient',
                'client_secret'=> 'testpass',
                'username'   => 'info@mps.com',
                'password'   => 'password'
            ]
        );
        $this->seeJsonContains(
            [
                "token_type"=>"Bearer",
                "scope"=>null
            ]
        );
    }

  
}