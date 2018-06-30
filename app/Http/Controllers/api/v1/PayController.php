<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Routing\Controller as BaseController;
use App\Pay;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PayController extends BaseController
{
    public function index()
    {
        $user = User::find(1);
        $pays = $user->pays()->with("kind")->get();
        return response()->json($pays);
    }
}
