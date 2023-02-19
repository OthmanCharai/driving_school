<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ContactEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function contact(Request $request): JsonResponse
    {
        $data=$request->validate([
            'name'=>'required',
            'email'=>'required',
            'message'=>'required'
        ]);
        $user=new User(['name'=>'admin','email'=>"othman.fiver@gmail.com"]);
        $user->notify(new ContactEmail($data));
        return response()->json('message was send with success',200);
    }
}
