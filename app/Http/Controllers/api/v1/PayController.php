<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Resources\PayCollection;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Kind;
use App\Http\Requests\PayRequest;

class PayController extends BaseController
{
    public function index()
    {
        $pays = Auth::user()->pays()->with("kind")->orderBy('created_at', 'desc')->paginate(10);
        return new PayCollection($pays);
    }

    public function kinds()
    {
        $kinds = Kind::all();
        return response()->json($kinds);
    }

    public function save(PayRequest $request)
    {
        Auth::user()->pays()->create($request->all());
    }
}
