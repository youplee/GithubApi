@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Information d'authentification d'un utilisateur</div>

                <div class="panel-body">
                L'utilisateur <em>{{$user->username}}</em> a été créé avec le mot de passe <em>{{$pwd}}</em>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
