@extends('layouts.auth')
@section('title','Modifier le mot de passe')

<!-- Main Content -->
@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body"> -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="sr-only"> E-mail</label>
                            <input type="text" class="form-control  form-control-lg" id="email" name="email"
                                placeholder="E-mail">
                        </div>
                        <!-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group">
                            <!-- <div class="col-md-6 col-md-offset-4"> -->
                                <button type="submit" class="btn btn-primary center-block">
                                    <i class="fa fa-btn fa-envelope"></i> Envoyer le lien du mot de passe
                                </button>
                            <!-- </div> -->
                        </div>
                    </form>
                <!-- </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
