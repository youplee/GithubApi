@extends('layouts.auth')

@section('title','Login')

@section('content')

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
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/registerUser') }}">
                        {{ csrf_field() }}

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="first" class="sr-only">First Name</label>
                                <input type="text" class="form-control  form-control-lg" id="nom" name="nom"
                                       placeholder="First name">
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-2 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                            <div class="form-group">
                                <label for="last" class="sr-only">Last Name</label>
                                <input type="text" class="form-control  form-control-lg" id="prenom" name="prenom"
                                       placeholder="Last name">
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="last" class="sr-only">Username</label>
                                <input type="text" class="form-control  form-control-lg" id="username" name="username"
                                       placeholder="Username">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only"> E-mail</label>
                                <input type="text" class="form-control  form-control-lg" id="email" name="email"
                                       placeholder="E-mail">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password"
                                       name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Confirm Password</label>
                                <input type="password" class="form-control form-control-lg" id="confirm-password_confirmation"
                                <input type="password" class="form-control form-control-lg" id="password_confirmation"
                                       name="password_confirmation" placeholder="Confirm Password">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group checkbox">
                                <label for="remember">
                                    <input type="checkbox" name="remember" id="remember">&nbsp; Se souvenir de moi
                                </label>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" value="Enregistrer" class="btn btn-primary btn-block"/>
                            </div>
                            <a id="forgot" class="forgot" href="{{ url('/password/reset') }}">Mot de passe oublié?</a>
                    </form>
@endsection