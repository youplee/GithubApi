@extends('layouts.auth')

@section('title','Login')

@section('content')
<!-- <div class="container">
    <div class="row"> -->
        @if(session('errorMsg'))
            <div class="alert alert-warning" >
                <p><center>{!! session('errorMsg') !!}</center></p>
            </div>
        @endif
        @if (session('wrongPass'))
            <div class="alert alert-danger">
                 <p><center>{{ session('wrongPass') }}</center></p>
            </div>
        @endif
        <!-- <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Se connecter</div>
                <div class="panel-body"> -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                                <label for="name" class="sr-only"> Nom d'utilisateur</label>
                                <input type="text" class="form-control  form-control-lg" id="name" name="name"
                                       placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password"
                                       name="password" placeholder="Password">
                            </div>
                            <div class="form-group checkbox">
                                <label for="remember">
                                    <input type="checkbox" name="remember" id="remember">&nbsp; Se souvenir de moi
                                </label>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" value="Se connecter" class="btn btn-primary btn-block"/>
                            </div>
                            <a id="forgot" class="forgot" href="{{ url('/password/reset') }}">Mot de passe oublié?</a>
                            <span class="pull-right sign-up">Nouveau ? <a href="{{ url('/register') }}">Creer un compte</a></span>


                        <!-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nom d'utilisateur</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Se souvenir de moi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Se connecter
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Mot de passe oublié?</a>
                            </div>
                        </div> -->
                    </form>
                <!-- </div>
            </div>
        </div>
    </div> 
</div>-->
@endsection



<!-- <form action="{{ url('/login') }}" id="authentication" method="post" class="login_validator">

                {{ csrf_field() }}
                           
                        </form> -->