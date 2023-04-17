<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Exception;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*$user = null;
        try {
            //  $user = $this->auth->authenticate($request);  //check authenticted user
            $user = JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch (Exception $e) {
            if($e instanceof TokenExpiredException){
                return  $this -> returnError('E003','token expired');
            }elseif($e instanceof TokenInvalidException){
                return  $this -> returnError('E003','invailed token');
            }else{
                return  $this -> returnError('E003',$e->getMessage());
            }
        } catch (Throwable $e){
            if($e instanceof TokenExpiredException){
                return  $this -> returnError('E003','token expired');
            }elseif($e instanceof TokenInvalidException){
                return  $this -> returnError('E003','invailed token');
            }else{
                return  $this -> returnError('E003','token not found');
            }
        }

        if(!$user){
            return  $this -> returnError('401','unauthenticted Admin');
        }*/

        return $next($request);
        /*if($guard != null){
            auth()->shouldUse($guard); //shoud you user guard / table
            $token = $request->header('auth-token');
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            try {
              //  $user = $this->auth->authenticate($request);  //check authenticted user
                $user = JWTAuth::parseToken()->authenticate();
            } catch (TokenExpiredException $e) {
                return  $this -> returnError('401','Unauthenticated user');
            } catch (JWTException $e) {

                return  $this -> returnError('', 'token_invalid'.$e->getMessage());
            }

        }*/
        
    }
}
