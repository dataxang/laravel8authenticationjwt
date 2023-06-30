<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Record;
use Validator;


class MyRecordController extends Controller
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

        //get logged-in user
        $userId = auth()->user()->id;
        $record = Record::latest()
            ->where(['user_id' => $userId])
            ->paginate(10);
        return [
            "status" => 1,
            "data" => $record
        ];
    }


    /**
     * @return mixed
     */
    public function store()
    {
        request()->validate([
            'weight' => 'required',
            'fat' => 'required',
        ]);
        //get logged-in user
        $userId = auth()->user()->id;

        return Record::create([
            'user_id' => $userId,
            'date' => date("Y-m-d",time()),
            'weight' => request('weight'),
            'fat' => request('fat'),
            'created_by' => $userId,
            'updated_by' => $userId,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyRecordGraph() {


        //get logged-in user
        $userId = auth()->user()->id;
        $record = Record::latest()
            ->select(['weight','fat','date',\DB::raw('SUBSTR(date,6,2) as month')])
            ->where(['user_id' => $userId])
            ->orderBy('date', 'ASC')
            ->paginate(10);
        return [
            "status" => 1,
            "data" => $record
        ];
    }
}
