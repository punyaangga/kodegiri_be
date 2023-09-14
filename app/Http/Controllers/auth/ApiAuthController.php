<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User\ProfileUser;
use PhpParser\Node\Stmt\Global_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\GlobalResources;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Http\Resources\auth\LoginResources;
use App\Http\Resources\auth\RegisterResources;
use App\Http\Requests\admin\GenerateAccessRequest;
use App\Http\Requests\admin\sendCredentialRequest;
use App\Http\Controllers\thirdparty\SendWaController;

class ApiAuthController extends Controller
{
    public function login(LoginRequest $request){

        $credential = $request->only('email','password');
        if(Auth::attempt($credential)){
            $user = User::where('email',$credential)->first();
            $token =  $user->createToken('token')->plainTextToken;
            return new GlobalResources(true,'Login Berhasil',$user,$token);
        }else{
            return response()->json([
                "success"=> false,
                "message"=>'Email atau password salah',
                "data"=>null
            ],401);
        }
    }

    public function register(RegisterRequest $request){
        try{
            $photoProfile = $request->file('photo_profile');
            $filename = time().'_'.$photoProfile->getClientOriginalName();
            $photoProfile->move(public_path('images/'.$request->name.'/'), $filename);
            $destination = 'images/'.$request->name.'/'.$filename;

            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number'=>$request->phone_number,
                'password' => Hash::make($request->password),
            ]);
            ProfileUser::create([
                'user_id' => $user->id,
                'pu_company_name'=>$request->company_name,
                'pu_division'=>$request->division,
                'pu_photo'=>$destination,
            ]);
            DB::commit();
            return new GlobalResources(true,'Register Berhasil',null,null);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                "success"=> false,
                "message"=>'Terjadi kesalah',
                "data"=>$e->getMessage()
            ],500);
        }

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return new GlobalResources(true,'Logout Berhasil',null,null);
    }


}
