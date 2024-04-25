<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PuppyResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke()
    // {
    //     return User::all();
    // }
    public function index()
    {
        // return User::all();
        return PuppyResource::collection(User::all());
    }
}
