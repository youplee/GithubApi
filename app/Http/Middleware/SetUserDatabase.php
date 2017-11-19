<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

use App\Database;
use App\Courtier;

class SetUserDatabase
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
        // Get the current authenticated user
        $user = Auth::user();
        
        if(Auth::user()->profil_id != 1 ){
            
            $courtier = Courtier::find(Auth::user()->courtier_id);
            $database = database::where('id', 1)->first();

            DB::disconnect('mysql2');		    

            Config::set('database.connections.mysql2.database', $database->name);
            Config::set('database.connections.mysql2.username', $database->login);
            Config::set('database.connections.mysql2.password', $database->password);
        }
        
        return $next($request);
    }
}
