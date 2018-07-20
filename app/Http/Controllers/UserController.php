<?php

namespace App\Http\Controllers;

use App\Helpers\HttpCode;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function get()
    {
        $user = Auth::user();
        return self::respond(['account' => $user], HttpCode::OK);
    }

    public function post(Request $request)
    {
        $rules = [
            'account'          => 'required|bail',
            'account.email'    => 'unique:users,email',
            'account.password' => 'min:8'
        ];

        if (self::validateRequest($request, $rules)) {
            $account = $request->all()['account'];
            $account = self::generateApiToken($account);

            if(strtolower(env('VERIFY_EMAILS')) !== 'true'){
                $account['email_verified'] = true;
            }

            if(strtolower(env('APP_ENV')) == 'local'){
                $account['status'] = User::STATUS_ACTIVE;
            }

            $user    = User::create($account);
            if ($user) {

                if($user['email_verified'] == false) {
                    try {
                        Mail::send('emails.verify', [], function ($message) {
                            $message->to('eduardo@sunriseintegration.com');
                        });
                    } catch (Exception $e) {

                    }
                }

                $user->makeVisible('api_token')->toArray();
                self::setResponse(['account' => $user], HttpCode::CREATED);
            } else {
                self::serverError();
            }
        }
        return self::respond();
    }

    public function put()
    {
        //
    }

    public function delete()
    {
        //
    }

    public function generateApiToken($account)
    {
        $account['api_token'] = str_random(60);
        return $account;
    }
}
