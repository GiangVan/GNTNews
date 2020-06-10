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
				    height: 723px;
				transform: scale(0.5);
				overflow: hidden;
				width: 188%;
				position: relative;
				top: -59%;
				left: -44%;
			}

			.card{
				width: 350px;
				height: 478px;
				transition: all .35s ease;
			}

			.card:hover{
				transform: scale(1.02);
			}

			.card-body {
				position: relative;
				overflow: hidden;
			}

			.card-body .shield{
				position: absolute;
				width: 100%;
				height: 100%;
				left: 0;
				top: 0;
				z-index: 1000;
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
						<a href="{{ url('/admin') }}">Quản lý bài viết</a>
                    @else
                        <a href="{{ route('login') }}">Đăng nhập</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Đăng ký</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="overflow-auto w-100 h-100 content justify-content-start align-items-start d-flex flex-wrap">
                @if (count($posters))  
                        @foreach ($posters as $poster)
						<div class="m-5">
							<a style='text-decoration: none !important;' class='d-block' href="/poster/view/{{ $poster->id }}">
								<div class="card shadow">
									<h4 class="card-header p-4 text-dark font-weight-bold">
										{{ $poster->title }}
									</h4>
									<div class="card-body">
									<div class="shield"></div>
										<div class='post-content' name="{{ $poster->id }}">{!! $poster->content !!}</div>
									</div>
								</div>
							</a>
						</div>
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


                            
