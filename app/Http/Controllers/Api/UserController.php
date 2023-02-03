<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return UserCollection
     */
    public function index(Request $request): UserCollection
    {
        $users = User::all();

        return new UserCollection($users);
    }

    /**
     * @param UserStoreRequest $request
     * @return UserResource
     */
    public function store(UserStoreRequest $request): UserResource
    {
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
    public function show(Request $request, User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function destroy(Request $request, User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
