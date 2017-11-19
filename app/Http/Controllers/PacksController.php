<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Habilitation;
use App\HabilitationPack;
use App\Pack;
use App\Profil;
use App\Courtier;
use App\User;
use Auth;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class PacksController extends Controller
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
        $packs          = Pack::all()->where('active' , '=' , 1);
    
        return view('pack.index', ['packs' => $packs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $habilitations = Habilitation::all()->where('active', 1);
        
        return view('pack.create', ['habilitations' => $habilitations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $pack = new Pack;

        request()->validate([
            'libelle'      => 'required',
           
        ]);

        $pack->libelle      = $request->libelle;
        $pack->description  = $request->description;
        $pack->active       = 1;
        $pack->save();

        $pack->habilitations()->sync($request->input('habilitation')); 

        return redirect('pack');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pack          = Pack::find($id);
        // $habilitations = $pack->habilitations()->get();
        $habilitations = Pack::find($id)->habilitations()->select('libelle', 'description')->get();
        
        // dd($habilitations);
        return view('pack.show', ['pack' => $pack, 'habilitations' =>$habilitations]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pack           = Pack::find($id);
        $habilitations  = Habilitation::all();
        // $hab            = $pack->habilitations()->get();
        $habs           = $pack->habilitations()->select('habilitation_id','libelle')->get();
        // dd($habs);
        return view('pack.edit', ['pack' => $pack ,'habilitations' => $habilitations, 'habs' => $habs,]);
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
        $pack           = Pack::find($id);

        request()->validate([
            'libelle'      => 'required',  
        ]);

        $pack->libelle      = $request->libelle;
        $pack->description  = $request->description;
        $pack->save();

        $pack->habilitations()->sync($request->input('habilitation')); 

        return redirect('pack');
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

    public function desactiver($id)
    {
        $pack           = Pack::find($id);
       
        $pack->active  = 0;
        $pack->save();

        return redirect('pack');
    }

    public function affecter()
    {

        // $user       = Auth::user();
        // $packs      = Pack::all()->where('active' , '=' , 1);
        // $courtierId = Courtier::find($user->courtier_id)->pluck('id')->first();

        // $users      = User::where('courtier_id', '=' , $courtierId)->get();

        // $packsUser 		= User::find($user->id)->packs()->get()->pluck('id');
        // // dd($packsUser);
        return view('pack.affect');

    }

    public function load()
    {
        $user       = Auth::user();
        $packs      = Pack::where('active' , 1)->get();
        $courtierId = Courtier::find($user->courtier_id)->pluck('id')->first();

        $users      = User::where('courtier_id' , $courtierId)->with('packs')->get();

        $packsUser 		= collect();
        foreach($users as $user){

            $packsUser->push([$user->id => User::find($user->id)->packs()->where('user_id', $user->id)->get()->pluck('id')]);
        }
        // $packsUser = User::find($user->id)->packs()->get()->pluck('id')->groupBy('user_id');
        return $data = ['users' => $users, 'packs' => $packs , 'packsUser' => $packsUser];
        // return $data = ['users' => $users, 'packs' => $packs];
    }
}
