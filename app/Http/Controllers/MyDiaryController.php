<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Diaries;
use Validator;


class MyDiaryController extends Controller
{
    /** * @OA\Info( * version="0.8.1",
     *      * title="Zerobug OpenApi Demo Documentation"
     * , * description="Swagger OpenApi description", *
     *      @OA\Contact( * email="admin@zeroblog.net" * ),
     *     * @OA\License( * name="ZeroBlog", * url="https://www.zeroblog.net" * ) * )
     * * * @OA\Server( * url=L5_SWAGGER_CONST_HOST, * description="Zerobug API Server" * ) * * @OA\Tag( * name="Zerobug",
     * * description="API Endpoints of Projects" * ) *
     */

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

    }


    /**
     * @OA\Get(
     *    path="/api/auth/diary/get-my-diary",
     *    operationId="index",
     *    tags={"Diary"},
     *    summary="Get list of diaries",
     *    description="Get list of diaries",
     *    @OA\Parameter(name="date", in="query", description="limit", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *
     *    @OA\Parameter(name="subject", in="query", description="limit", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *
     *    @OA\Parameter(name="page", in="query", description="the page number", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="order", in="query", description="order  accepts 'asc' or 'desc'", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example="200"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function index() {

        $post = Diaries::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $post
        ];
    }


    /**
     * @OA\Post(
     *      path="/api/auth/diary/store",
     *      operationId="store",
     *      tags={"diary"},
     *      summary="Store diary in DB",
     *      description="Store diary in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"subject"},
     *            @OA\Property(property="title", type="string", format="string", example="Test diary"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
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
