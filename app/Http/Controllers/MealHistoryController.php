<?php

namespace App\Http\Controllers;
use App\Models\MealHistory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Diaries;
use Validator;


class MealHistoryController extends Controller
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

        $mealHistory = MealHistory::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $mealHistory
        ];
    }


}
