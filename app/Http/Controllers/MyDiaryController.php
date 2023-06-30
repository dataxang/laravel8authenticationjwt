<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Diaries;
use Validator;


class MyDiaryController extends Controller
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

        $post = Diaries::latest()->paginate(10);
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
            'subject' => 'required',
        ]);
        //get logged-in user
        $userId = auth()->user()->id;

        return Diaries::create([
            'user_id' => $userId,
            'date' => date("Y-m-d",time()),
            'subject' => request('subject'),
            'description' => request('description'),
            'created_by' => $userId,
            'updated_by' => $userId,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }
}
