        <div id="menu" role="navigation">
        <div class="nav_profile">
            <div class="media profile-left">
                <a class="pull-left profile-thumb" href="#">
                    <img src="{{asset('assets/img/authors/avatar1.jpg')}}" class="img-circle" alt="User Image"></a>
                <div class="content-profile">
                    <h4 class="media-heading">{{ucfirst(Auth::user()->nom)}}  {{ucfirst(Auth::user()->prenom)}}</h4>
                    <ul class="icon-list">
                        <li>
                            <a href="{{ url('/profil') }}">
                                <i class="fa fa-user" aria-hidden="true">
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
       
        <ul class="navigation">
        </ul>
        <!-- / .navigation --> 
    </div>
    <!-- menu --> 
