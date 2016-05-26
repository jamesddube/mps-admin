<?php


use App\User;
use Illuminate\Support\Facades\DB;

class ApiCheckTest extends TestCase
{
    /** @var  User $user */
    private $user;

    /**
     * My test implementation
     */
    public function testApiWorks()
    {
        $this->get('/api/check');
        $this->see('success');
    }

    public function testOauthBadCredentialsResponseCode()
    {
        $this->call('post','api/oauth/token');
        $this->assertResponseStatus(400);
    }

    public function testGetAccessToken()
    {
        $password= 'some random password';
        $user = factory('App\User')->make(['password' => bcrypt($password)]);
        $user->save();

        $this->call('post','/api/oauth/token',
            [
                'grant_type' => 'password',
                'client_id'  => 'testclient',
                'client_secret'=> 'testpass',
                'username'   => $user->email,
                'password'   => $password,
            ]
        );
        $this->seeJsonContains(
            [
                "token_type"=>"Bearer",
                "scope"=>null
            ]
        );
    }

    public function testInvalidAccessToken()
    {

        //$this->markTestSkipped();
        $this->call('get','/api/users',
            [
                'access_token' => 'random string',
            ]
        );
        $this->seeJson(['message'=>'the access token provided is invalid']);
    }

    public function testAccessTokenRequired()
    {
        $this->call('get','/api/orders');
        $this->seeJson(['message'=>'access token not found']);
    }

    public function testExpiredTokens()
    {
        
        $token = $this->hack();
        $this->call('post','/api/orders',
            [
                'access_token' => $token,
            ]
        );
        $this->seeJson(
            [
                "message"=>"authenticated",
            ]
        );

    }
    
    private function hack()
    {
        /*@todo This is a hack, find how to change the TTL of the access token.*/
        $access_token = DB::table('oauth_access_tokens')
            ->orderBy('expires','desc')
            ->first();
        $date = \Carbon\Carbon::now();
        $date= $date->subHour(1);
        DB::table('oauth_access_tokens')
            -> where('access_token',$access_token->access_token)
            ->update(['expires'=>$date]);
        
        return $access_token->access_token;
    }
}
