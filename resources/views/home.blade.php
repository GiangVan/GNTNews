<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- bootstrap -->
        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            td, th{
                padding: 15px;
            }
            table *{
                padding: 15px;
            }
        </style>

		<style>
			.content{
				margin-top: 125px !important;
			}
		
			.post-content{
				height: 200px;
				transform: scale(0.5);
    			overflow: hidden;
			}

			.card{
				width: 400px;
				height: 300px;
				transition: all .5s ease;
			}

			.card:hover{
				transform: scale(1.03);
			}
		</style>

        <!-- ckeditor -->
        <script src="/ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
						@if ($user->role === 'admin')
						<a href="{{ url('/admin') }}">Admin</a>
						@endif
						<a href="{{ url('/myposts') }}">My posts</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="overflow-auto w-100 h-100 content justify-content-start align-items-start d-flex flex-wrap">
                @if (count($posters))  
                        @foreach ($posters as $poster)
						<a class='' href="/poster/view/{{ $poster->id }}">
							<div class="card m-4 shadow">
								<h5 class="card-header text-dark font-weight-bold">
									{{ $poster->title }}
								</h5>
								<div class="card-body">
									<div class='post-content' name="{{ $poster->id }}">{!! $poster->content !!}</div>
								</div>
							</div>
						</a>
                        @endforeach
                @else
                    <p>empty!</p>
                @endif
            </div>
        </div>

        <script src="/jquery/jquery-3.3.1.slim.min.js"></script>
        <script src="/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>


                            
