<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet" media="screen" >
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'ramen711') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
				@if (!Auth::guest())
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
						<form class="form_serch form-inline" action="{{route('shop.index')}}">
							<input type="text" name="keyword" placeholder="店名または駅名を入力">
							<button type="submit" class="btn btn-primary">探す</button>
						</form>
                    </ul>
                    <ul class="nav navbar-nav">
						<form name="sort" action="{{route('shop.index')}}" method="post">
						  {{ csrf_field() }} 
							<select name="sort">
							<option value=""> 並び替え</option>
							<option value="likeDesc"> いいねが多い順</option>
							</select>
						</form>
                    </ul>
				@endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
		@if (!AUth::guard('admin')->guest())
				<a class="admin_user_chg btn btn-danger" href ="{{route('admin.index')}}" role="button">admin-pageに移る</a>
		@endif
        @yield('content')
		<footer class="footer">
			<div class="container">
				<p class="text-muted">Copylight @ramen711</footer></p>
			</div>
		</footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	<script>
	     var select = document.getElementById('sort');
	     select.addEventListener('change', function () { 
			this.form.submit();
	     }, false); 
	</script>
</body>
</html>
