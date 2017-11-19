<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

use Auth;

use App\Licence;
use App\Courtier;
use App\Token;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;



class LicenceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();
        }else{
            $user = User::where('username',$request->name)->first();
            if(!$user){
                Auth::logout();
                return redirect('login')->with('errorMsg', Config::get('errorsMsg.errors.account_not_found'));
                //return redirect('login')->with('errorMsg', ' Ce compte n\'existe pas');
            }
        }

        $courtier   = Courtier::where('id',$user->courtier_id)->first();

        if($user->profil_id != 1 && $user->profil_id != 2){
            // récupération des licences actives
            $licences   = Licence::where('courtier_id',$courtier->id)->whereActive(1)->get();

            //liberation des licences non actives pendant une durée > 5min
            if($licences){
                foreach($licences as $l){
                    $tokens  = Token::where('licence_id', $l->id)->get();
                    if($tokens){
                        foreach($tokens as $token){
                        
                            $t   = new Carbon($token->last_action);
                            $now = Carbon::now();
                            
                            if ($t->diffInMinutes($now) > 5) {
            
                                $token->date = null;
                                $token->save();

                                $l->active = 0;
                                $l->save();
                                
                            }

                        }
                    }
                }
            }

            $token      = Token::where('user_id',$user->id)->first();
            
            if($token){
                if ($token->date) {
                    
                    Auth::logout();
                    return redirect('login')->with('errorMsg', Config::get('errorsMsg.errors.account_occupied'));
                    //return redirect('login')->with('errorMsg', ' Ce compte est déjà utilisé par ailleurs');
        
                }
               
            }
        }

        return $next($request);
    }
}
