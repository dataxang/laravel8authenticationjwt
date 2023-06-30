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

}
