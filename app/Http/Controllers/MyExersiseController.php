<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Exersise;
use Validator;


class MyExersiseController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {

        $post = Exersise::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $post
        ];
    }


    /**
     * @return mixed
     */
    public function store()
    {
        request()->validate([
            'action' => 'required',
            'level' => 'required',
            'energy' => 'required',
            'duration' => 'required',
        ]);
        //get logged-in user
        $userId = auth()->user()->id;

        return Exersise::create([
            'user_id' => $userId,
            'date' => date("Y-m-d",time()),
            'action' => request('action'),
            'level' => request('level'),
            'energy' => request('energy'),
            'duration' => request('duration'),
            'description' => request('description'),
            'created_by' => $userId,
            'updated_by' => $userId,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }
}
