<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\GeneralTrait;
use Auth;
use Exception;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class AuthAdminController extends Controller
{
    use GeneralTrait;
    
    public function login(Request $request)
    {
        try {
            $rules = [
                "email" => "required|exists:admin,email",
                "password" => "required"
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $credentials = $request->only(["email", "password"]);
            $token = Auth::guard("admin_api")->attempt($credentials);
            if(!$token){
                return $this->returnError("E001", "incorrect!");
            }

            $admin = Auth::guard('admin_api')->user();
            $admin->api_token = $token;
            return $this->returnData("admin", $admin);
            
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $token = $request -> header("auth_token");
        //return $token;
        if($token){
            try {
                if(JWTAuth::setToken($token)->checkOrFail()){
                    JWTAuth::setToken($token)->invalidate(); // logout
                    return $this -> returnSuccessMessage("Logout Successfully!");
                }else{
                    return $this->returnError("00", "something went wrong");
                }
            } catch (Exception $e) {
                return $this->returnError($e->getCode(), "something went wrong");
            } catch(Throwable $th){
                return $this->returnError($th->getCode(), "something went wrong");
            }
        }else{
            return $this -> returnSuccessMessage("some thing went wrong!");
        }

    }

}
