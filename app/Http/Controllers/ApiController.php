<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function textMessageHook($password, Request $request)
    {
        if($password == config('platform.api-password')) {
            Log::warning(serialize($request));
        } else {

        }
    }
}
