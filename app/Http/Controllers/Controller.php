<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Info(
     * title="MyBizz Hive API",
     * version="1.0",
     * )
     * @OA\Server(
     * url="http://localhost:8000/api",
     * description="Local server"
     * )
     * @OA\Server(
     * url="http://204.236.184.192/api",
     * description="Dev server"
     * )
     * @OA\SecurityScheme(
     * securityScheme="bearerAuth",
     * type="http",
     * scheme="bearer",
     * bearerFormat="JWT"
     * ),
     */
}
