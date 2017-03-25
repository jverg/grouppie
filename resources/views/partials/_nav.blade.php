
<!-- Navigation file -->

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Jverg's Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!-- Menu buttons -->
                <li class="{{ Request::is('/') ? "active" : "" }}">
                    <a href='/'>
                        <i class="fa fa-home fa-2x"></i>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <!-- Check if the user is logged in or not -->
                @if(Auth::check())

                    <!-- User's dropdown menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <li class="{{ Request::is('/') ? "" : "active" }}">
                            <i class="fa fa-user fa-2x"></i><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/user"> <i class="fa fa-address-card-o"></i> My profile</a></li>
                            <li><a href="/expenses/create"><i class="fa fa-money"></i> My wallet</a></li>
                            <li><a href="/posts"><i class="fa fa-calendar"></i> My posts ( {{ Auth::user()->posts->count() }} )</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                @else

                    {{-- Login icon --}}
                    <li class="{{ Request::is('login') ? "active" : "" }}">
                        <a href="{{ route('login') }}">
                            <i class="fa fa-sign-in fa-2x"></i>
                        </a>
                    </li>

                    {{-- Register icon --}}
                    <li class="{{ Request::is('register') ? "active" : "" }}">
                        <a href="{{ route('register') }}" class="{{ Request::is('register') ? "active" : "" }}">
                            <i class="fa fa-pencil-square-o fa-2x"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<br><br><br><br>