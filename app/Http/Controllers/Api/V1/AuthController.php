<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $authUser = Auth::user();
            $success['token'] =  $authUser->createToken('AvtoMoeApp')->plainTextToken;
            $success['first_name'] =  $authUser->first_name;
            $success['last_name'] =  $authUser->last_name;

            return $this->sendResponse($success, __('auth.sign_in-success'));
        }
        else{
            return $this->sendError(__('auth.sign_in-error'), ['error'=> __('auth.sign_in-error-code')]);
        }
    }
    public function signup(Request $request)
    {
        $user = new User();

        if(!$user->validate($request->all())) {
            return $this->sendError(__('auth.sign_up-error'), $user->errors);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('AvtoMoeApp')->plainTextToken;
        $success['first_name'] =  $user->first_name;
        $success['last_name'] =  $user->last_name;

        return $this->sendResponse($success, __('auth.sign_up-success'));
    }
}
