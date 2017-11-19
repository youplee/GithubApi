@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenu</div>
                @if(session('errorMsg'))
                    <div class="alert alert-warning" >
                        <p><center>{!! session('errorMsg') !!}</center></p>
                    </div>
                @endif
                <div class="panel-body">
                La page d'accueil de votre application.<br> Soyez les bienvenues.
                </div>
     
            </div>
        </div>
    </div>
</div>
@endsection
