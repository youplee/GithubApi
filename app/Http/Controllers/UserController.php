<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\ValidPassword;

use App\Http\Requests;

use App\User;
use App\Profil;
use App\Courtier;
use App\Catalogue;
use App\Recherche;
use Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        // $pwd = $user->password->getAuthPassword();
        // return view('afterLogin', ['user'=> $user, 'pwd' => $pwd]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $courtiers  = Courtier::all()->where('active',1);
        // $user       = Auth::user();
        // $profils    = Profil::all()->where('active',1);

        // return view('auth.register', [ 'courtiers' => $courtiers , 'user' => $user, 'profils' => $profils]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user = new User;
        $this->validate($request, [
            'password'  =>[new ValidPassword ,'required','confirmed'],
            'username'  => 'required',
        ]);
    
        $user->username     = $request->prefixe.'_'.$request->username;
        $user->email        = $request->email;
        $user->nom          = $request->nom;
        $user->prenom       = $request->prenom;
        
        $user->password = bcrypt($request->password);
        // $pwd                = str_random(8);
        // $user->password     = bcrypt($pwd);
        $user->courtier_id  = $request->courtier_id;
        $user->profil_id    = $request->profil_id;
        
        $user->save();
        
        $pack = Profil::find($request->profil_id)->pack_id;
        $user->packs()->sync($pack);
        
        // $pwd = $user->password->getAuthPassword();
        return view('afterLogin', ['user'=> $user, 'pwd' => $request->password]);
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

    // public function loadCourtier(){
    //     $courtiers  = Courtier::all()->where('active',1);
    //     return $data = ['courtiers' => $courtiers];
    // }

    // public function changeCourtier($id){

    //     if($id){
    //         $courtierId = $id;
    //     }
        
    //     $courtier    = Courtier::where('id', $courtierId )->first();

    //     return $data = ['courtier' => $courtier];

    // }

    public function loadProfil(){

        $user           = Auth::user();
        $favorites      = $user->favorite(Catalogue::class);
        $typeRecherches = Recherche::all();
        return $data    = ['favorites' => $favorites, 'typeRecherches' => $typeRecherches];

    }
}
