<!-- Navigation -->

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Grouppie</a>

        <!-- Check if the user is logged in or not -->
    @if(Auth::check())
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!-- Menu buttons -->
                    <li class="{{ Request::is('/') ? "active" : "" }}">
                        <a href='/'>
                            <i class="fa fa-home fa-lg"></i>
                        </a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <!-- User's dropdown menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                    <li class="{{ Request::is('/') ? "" : "active" }}">
                        <span>{{ \Illuminate\Support\Facades\Auth::user()->name }} </span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/user"> <i class="fa fa-user"></i> My profile</a></li>
                            @if(\App\Wallet::wholeCash() >= 0)
                                <li><a href="/wallets"><i class="fa fa-money"></i> My wallet <span
                                                style="color: lawngreen">({{ \App\Wallet::wholeCash() }}€)</span></a>
                                </li>
                            @else
                                <li><a href="/wallets"><i class="fa fa-money"></i> My wallet <span
                                                style="color: orangered">({{ \App\Wallet::wholeCash() }}€)</span></a>
                                </li>
                            @endif
                            <li><a href="/posts"><i class="fa fa-calendar"></i> My posts
                                    ({{ Auth::user()->posts->count() }})</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        @else
            <ul class="nav navbar-nav navbar-right">
                <li>
                    {{-- Login icon --}}
                    <a class="pull-right" href="{{ route('login') }}">
                        <i class="fa fa-sign-in fa-lg"></i>
                    </a>
                </li>
                <li>
                    {{-- Register icon --}}
                    <a class="pull-right" href="{{ route('register') }}">
                        <i class="fa fa-pencil-square-o fa-lg"></i>
                    </a>
                </li>
            </ul>
        @endif
    </div>
</div>