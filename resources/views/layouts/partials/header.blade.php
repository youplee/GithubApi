
 <nav class="navbar navbar-static-top" role="navigation">
        <a href="{{url ('/')}}" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the marginin -->
            <img src="{{asset('assets/img/logo_nxt.png')}}" width="100px" height="35px" alt="logo"/>
            <!-- <h3>Belair CRM</h3> -->
        </a>
        <!-- Header Navbar: style can be found in header-->
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i
                    class="fa fa-fw ti-menu"></i>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown-->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle padding-user" data-toggle="dropdown">
                        <img src="{{asset('assets/img/authors/avatar1.jpg')}}" width="35" class="img-circle img-responsive pull-left"
                             height="35" alt="User Image">
                        <div class="riot">
                            <div>
                            {{ucfirst(Auth::user()->nom)}}  {{ucfirst(Auth::user()->prenom)}}
                                <span> <i class="caret"></i> </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('assets/img/authors/avatar1.jpg')}}" class="img-circle" alt="User Image">
                            <p> {{ucfirst(Auth::user()->nom)}}  {{ucfirst(Auth::user()->prenom)}}</p>
                        </li>
                        <!-- Menu Body -->
                        <li class="p-t-3"><a href="{{ url('/profil') }}"> <i class="fa fa-fw ti-user"></i> My Profile </a>
                        </li>
                        <li role="presentation"></li>
                        <li role="presentation" class="divider"></li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}">
                                    <i class="fa fa-fw ti-shift-right"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>