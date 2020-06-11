@extends('layouts.app')

@section('content')

		<style>
			.content{
				margin-top: 55px !important;
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

			<nav class='mx-4'>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">	
					<a class="text-dark nav-item nav-link @if ($categoryId == null) active @endif" href="/home">Tất cả</a>
					
					@foreach ($categories as $category)
					<a class="text-dark nav-item nav-link @if ($categoryId == $category->id) active @endif" href="/home/{{$category->id}}">{{$category->title}}</a>
					@endforeach
				</div>
			</nav>

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
                    <p>Chưa có bài viết!</p>
                @endif
            </div>


                            
@endsection