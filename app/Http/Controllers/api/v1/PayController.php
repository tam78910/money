<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Resources\PayCollection;
use Illuminate\Routing\Controller as BaseController;
use App\User;

class PayController extends BaseController
{
    public function index()
    {
        $user = User::find(1);
        $pays = $user->pays()->with("kind")->paginate(10);
        return new PayCollection($pays);
    }
}
