<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Agence;
use App\Courtier;

use Auth;

use App\Database;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AgencesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('database');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user 		= Auth::user();
        $agences 	= ($user->profil_id == 1 ? "" : Agence::all()); 
        
        return view('agence.index', compact('agences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agence.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agence = new Agence;

        $courtierId =  Auth::user()->courtier_id;
        $this->setConfigMySql2($courtierId);

        $agence->name = $request->name;

        $agence->save();
        // $agence = Agence::create($request->all());

        return redirect('agence');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setConfigMySql2($courtierId){
		
		$courtier 		= Courtier::find($courtierId);
		
		$database   = Database::where('id', $courtier->database_id)->first();
		
		DB::disconnect('mysql2');		    

		Config::set('database.connections.mysql2.database', $database->name);
		Config::set('database.connections.mysql2.username', $database->login);
		Config::set('database.connections.mysql2.password', $database->password);
		
	}
}
