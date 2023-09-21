<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Response;

class AccessTokenController extends Controller
{
    public function index(){
        if(!Auth::guard('sanctum')->user()->tokenCan('classroom.read')){
            abort(403,'Sorry, you do not have authrization');
        }
        return Auth::guard('sanctum')->user()->tokens;
    }
    public function createToken(Request $request){
        $request->validate([
            'email' => 'required | email',
            'password' => 'required',
            'device_name' => 'sometimes | required',
            'abilities' => 'array',
        ]);
        $user = User::whereEmail($request->email)->first();
        $name = $request->post('device_name',$request->userAgent());
        if($user && Hash::check($request->password,$user->password)){
            $token = $user->createToken($name,['*'],now()->addDays(30));
            return Response::json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ]);
        }
        return Response::json([
            'msg'   => 'Invalid cooden',
        ]);

    }
    public function destroy($id = null){
        $user= Auth::guard('sanctum')->user();

        if($id){
            if($id =='current'){
                $user->currentAccessToken()->delete();
            }else{
                $user->tokens()->findOrFail($id)->delete();
            }
        }else{
            $user->tokens()->delete();
        }
    }
}
