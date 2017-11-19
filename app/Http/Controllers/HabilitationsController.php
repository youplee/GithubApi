<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Habilitation;

class HabilitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habilitations = Habilitation::all()->where('active', 1);

        return view('habilitation.index', ['habilitations' => $habilitations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('habilitation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $habilitation = new habilitation;
        
        request()->validate([
            'libelle'      => 'required',
            
        ]);

        $habilitation->libelle      = $request->libelle;
        $habilitation->description  = $request->description;
        $habilitation->active       = 1;

        $habilitation->save();

        return redirect('habilitation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $habilitation   = Habilitation::find($id);
       
        return view('habilitation.show', ['habilitation' =>$habilitation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $habilitation   = Habilitation::find($id);
        
         return view('habilitation.edit', ['habilitation' =>$habilitation]);
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
        $habilitation = Habilitation::find($id);
        
        request()->validate([
            'libelle'      => 'required',
            
        ]);

        $habilitation->libelle      = $request->libelle;
        $habilitation->description  = $request->description;
        $habilitation->active       = 1;

        $habilitation->save();

        return redirect('habilitation');
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
        $habilitation           = Habilitation::find($id);
       
        $habilitation->active   = 0;
        $habilitation->save();

        return redirect('habilitation');
    }
}
