<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\UserFilter;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserFilter $filter)
    {
        $user = User::filter($filter)->orderBy('first_name', 'asc')->get();

        return $this->sendResponse(UserResource::collection($user), __('user_message.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();

        $user->setRules([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        if (!$user->validate($request->all())) {
            return $this->sendError(__('auth.sign_up-error'), $user->errors);
        }

        $input = $request->all();
        $post = User::create($input);

        return $this->sendResponse(new UserResource($post), __('user_message.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (is_null($user)) {
            return $this->sendError(__('event.show-error'));
        }
        return $this->sendResponse(new UserResource($user), __('user_message.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!$user->validate($request->all())) {
            return $this->sendError($user->errors);
        }

        $input = $request->all();

        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->birthday = $input['birthday'];
        $user->password = $input['password'];
        $user->save();

        return $this->sendResponse(new UserResource($user), __('user_message.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse([], __('user_message.destroy'));
    }
}
