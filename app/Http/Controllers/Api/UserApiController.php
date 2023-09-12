<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserApiController extends Controller
{
    public function __construct(protected UserService $service)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index() /* JsonResponse */
    {
        $users = $this->service->findAll();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        $user = $this->service->register($request);
        if (!$user) {
            return response()->json(["error" => "Failed to create the task"], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(["message" => "User created successfully", "data" => $user], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserCreateRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
