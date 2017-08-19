<!-- Navigation menu -->

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">

        <!-- Check if the user is logged in or not -->
    @if(Auth::check())
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="mob-toggle">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only"></span>
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="mob-wallet">
                <a href="/transactions">
                    @if(\App\Transaction::wholeCash() >= 0)
                        <a href="/transactions">
                            <span style="color: lawngreen">
                                <button type="button" class="navbar-toggle">
                                    <i class="fa fa-money"></i>
                                </button>
                            </span>
                        </a>
                    @else
                        <a href="/transactions">
                            <span style="color: orangered">
                                <button type="button" class="navbar-toggle">
                                    <i class="fa fa-money"></i>
                                </button>
                            </span>
                        </a>
                    @endif
                </a>
            </div>
            <a class="navbar-brand" href="/">Grouplend</a>
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
                    <div class="dropdown-menu">
                        <table class="table">

                            <!-- Body of the table -->
                            <tbody>

                            {{-- User --}}
                            <tr>
                                <td style="text-align: center">
                                    <a href="/user">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/user">My profile
                                    </a>
                                </td>
                            </tr>

                            {{-- My wallet --}}
                            <tr>
                                <td style="text-align: center"><a href="/transactions"><i class="fa fa-money"></i></a></td>
                                <td>
                                    @if(\App\Transaction::wholeCash() >= 0)
                                        <a href="/transactions">
                                            Wallet <span style="color: lawngreen">({{ \App\Transaction::wholeCash() }}€)</span>
                                        </a>
                                    @else
                                        <a href="/transactions">
                                            Wallet <span style="color: orangered">({{ $money }}€)</span>
                                        </a>
                                    @endif
                                </td>
                            </tr>

                            {{-- Logout --}}
                            <tr>
                                <td style="text-align: center"><a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out"></i></a></td>
                                <td><a href="{{ URL::to('auth/logout') }}">Logout</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </div>
        @else
        <a class="navbar-brand" href="/">Grouplend</a>
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