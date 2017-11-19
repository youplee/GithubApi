<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Auth;
use App\Courtier;
use App\Licence;
use App\Token;
use App\User;

class TokenMiddleware
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
        }
       
        $courtier   = Courtier::where('id',$user->courtier_id)->first();
        
        if($user->profil_id != 1 && $user->profil_id != 2) {

            $token      = Token::where('user_id',$user->id)->first();
           
            if($token){

                $token->last_action= Carbon::now();
                $token->save();

                if($token->date == null){

                    $token->delete();
                    Auth::logout();
                    return redirect('login')->with('errorMsg', ' Votre session a expiré. Vous devez vous identifier à nouveau pour continuer');
                        
                }
                
            }else{

                $licence    = Licence::where('courtier_id',$courtier->id)->where('active', '=' , 0)->first();

                // vérification licence
                if (!$licence){
                    return redirect('login')->with('errorMsg',' Toutes vos licences sont actuellement occupées. Veuillez mettre fin à une des sessions en cours ou contacter votre support.');
                }
            }
        }

        return $next($request); 
       
    }
}
