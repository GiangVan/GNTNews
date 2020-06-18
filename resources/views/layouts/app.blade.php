<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tin tức</title>


    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- my css -->
	<link href="/my_CSS.css" rel="stylesheet">
    <!-- bootstrap -->
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="/bootstrap/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
	
	<!--  -->
	
	<script src="/jquery/jquery-3.3.1.slim.min.js"></script>
	<script src="/jquery/sweetalert.min.js"></script>
	<script src="/jquery/popper.min.js"></script>
	<!-- <script src="/jquery/jquery.dataTables.min.js"></script>
	<script src="/jquery/dataTables.bootstrap4.min.js"></script> -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
	
	<!--  -->
    <style>

		body{
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
		}

		td, th{
			padding: 10px;
		}

		.card-body{
			max-height: 700px;
    		overflow: auto;
		}

		.dropdown-item:hover{
			transition: all .3s ease;
			background-color: #dadada !important;
		}
    </style>
    <!-- ckeditor -->
    <script src="/ckeditor/ckeditor.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Trang chủ
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

									<a class="dropdown-item my-2 py-2" href="{{ url('/poster/add') }}">✍ Viết bài</a>
									<a class="dropdown-item my-2 py-2" href="{{ url('/poster') }}">📝 Quản lý bài viết</a>
									@if (Auth::user()->role > App\Http\Enums\AccountRoles::USER)
										<a class="dropdown-item my-2 py-2" href="{{ url('/category') }}">📃 Quản lý thể loại</a>
									@endif
									@if (Auth::user()->role === App\Http\Enums\AccountRoles::MASTER)
										<a class="dropdown-item my-2 py-2" href="{{ url('/accounts') }}">👨‍🔧 Quản lý tài khoản</a>
									@endif
                                    <a class="dropdown-item my-2 py-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">↪ Đăng xuất</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
 