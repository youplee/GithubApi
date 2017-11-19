<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Http\Controllers\Controller;

use App\Produit;
use App\User;
use App\Courtier;
use App\Database;
use App\Agence;
use Auth;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ProduitsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('database');
    }

    /**
	 * Display a listing of the products.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$user 		= Auth::user(); 

		$courtier   = Courtier::find($user->courtier_id);

		$agences 	= ($user->profil_id == 1 ? "" : Agence::all());

		$produits   = ($user->profil_id == 1 ? Produit::all() : $courtier->produits()->get());

        return view('produits.index', compact('produits', 'agences'));
	}

	/**
	 * Show the form for creating a new product.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('produits.create');
	}

	/**
	 * Store a new created product.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$produit = Produit::create($request->all());

        return redirect()->route('produits.index');
    }
    
    //table pivote

    public function affect()
	{
		return view('produits.affect');
	}


	public function load(){

		$courtiers 		= Courtier::all();
		$produits 	    = Produit::all();
		
		return ['courtiers'=> $courtiers, 'produits' => $produits];
	}

	public function setConfigMySql2($courtierId){
		
		$courtier 		= Courtier::find($courtierId);
		
		$database   = Database::where('id', $courtier->database_id)->first();
		
		DB::disconnect('mysql2');		    

		Config::set('database.connections.mysql2.database', $database->name);
		Config::set('database.connections.mysql2.username', $database->login);
		Config::set('database.connections.mysql2.password', $database->password);
		
	}
	
	public function changeCourtier($id){
		
		if($id){

			$courtierId   			= $id;
			
			$this->setConfigMySql2($courtierId);
			
			$produitsCourtier 		= Courtier::find($courtierId)->produits()->get()->pluck('id');
			
			return $donnee = ['produitsCourtier'=> $produitsCourtier];
		}	
	}

	/**
	 * Store a new created product.
	 *
	 * @return Response
	 */
	public function saveProdCourtier(Request $request)
	{ 
	
		$courtierId  	= $request->get('courtierId');
		$this->setConfigMySql2($courtierId);

		$courtier          = Courtier::find($courtierId);
		

		$courtier->produits()->sync($request->get('produitIds'));
		
	}
}
