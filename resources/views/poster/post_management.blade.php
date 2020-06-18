@extends('layouts.app')

@section('content')
<style>
	.post-title {
		position: relative;
		max-width: 300px;
	}
	.post-content{
		position: absolute !important;
    	width: 1000px;
		height: calc(1000px + 120%);
		overflow: auto;
		border: solid;
		top: -246px;
		transform: scale(.4);
		left: -300px;
		background-color: white;
		z-index: 2;
		display: none;
	}
	.post-title:hover .post-content{
		display: block;
	}
	.shield{
		position: absolute;
		width: 100%;
		height: 100%;
		left: 0;
		top: 0;
		z-index: 1000;
	}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			@if (Auth::user()->role > App\Http\Enums\AccountRoles::USER)
            <div class="card my-5">
                <p class="card-header">Tất cả bài viết</p>
                <div class="card-body">
				
                    @if (count($posters))       
                        <table style="text-align:left">
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Thể loại</th>
                                <th>Ngày đăng</th>
                                <th>Lượt xem</th>
                                <th>Tác giả</th>
                                <th>Người duyệt</th>
                                <th>Tùy chọn</th>
                            </tr>
                            <?php $count = 0; ?>
                            @foreach ($posters as $poster)
                                <?php $count++; ?>
                                <tr class='border-bottom'>
									<td>{{$count}}</td>
                                    <td>
										<div class="post-title d-inline-flex">
											<a class='d-block text-dark font-weight-bold' href="/poster/view/private/{{ $poster->id }}">{{ $poster->title }}</a>
											<div class='post-content rounded' name="{{ $poster->id }}">
												<div class="shield"></div>
												{!! $poster->content !!}
											</div>
										</div>
									</td>
                                    <td>{{ $poster->categorytitle }}</td>
                                    <td>{{ $poster->time }}</td>
                                    <td>{{ $poster->viewnumber }} 👀</td>
                                    <td>{{ $poster->author_name }}</td>
									@if ($poster->id_approver)
                                    	<td>{{ $poster->approver_name }}</td>
									@else
                                        <td><a href="/poster/approve/{{ $poster->id }}" class="btn btn-success">Duyệt</a></td>
									@endif
                                    <td class="btn-list d-inline-flex">
                                        <a href="/poster/edit/{{ $poster->id }}" class="m-1 btn btn-primary">Sửa</a>
                                        <div onclick='deletePost({{ $poster->id }})' class="m-1 btn btn-danger">Xóa</div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                    
                </div>
            </div>
			@endif

			<div class="card my-5">
                <p class="card-header">Bài Viết của tôi</p>
                <div class="card-body">
					<a href="/poster/add" class="w-100 mb-5 btn btn-warning">Viết bài mới</a>
				
                    @if (count($myPosters))       
                        <table id="myPosts" class='w-100' style="text-align:left">
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Thể loại</th>
                                <th>Ngày đăng</th>
                                <th>Lượt xem</th>
                                <th>Được duyệt</th>
                                <th>Tùy chọn</th>
                            </tr>
                            <?php $count = 0; ?>
                            @foreach ($myPosters as $poster)
                                <?php $count++; ?>
                                <tr class='border-bottom'>
									<td>{{$count}}</td>
                                    <td>
										<div class="post-title d-inline-flex">
											<a class='d-block text-dark font-weight-bold' href="/poster/view/private/{{ $poster->id }}">{{ $poster->title }}</a>
											<div class='post-content rounded' name="{{ $poster->id }}">
												<div class="shield"></div>
												{!! $poster->content !!}
											</div>
										</div>
									</td>
                                    <td>{{ $poster->categorytitle }}</td>
                                    <td>{{ $poster->time }}</td>
                                    <td>{{ $poster->viewnumber }} 👀</td>
                                    <td>
										@if ($poster->id_approver === null)
											<span>❌</span>
										@endif
											<span>✔</span>
									</td>
                                    <td>
										<div class="btn-list d-inline-flex">
											@if (Auth::user()->role > App\Http\Enums\AccountRoles::USER || $poster->id_approver === null)
												<a href="/poster/edit/{{ $poster->id }}" class="m-1 btn btn-primary">Sửa</a>
											@endif
											<div onclick='deletePost({{ $poster->id }})' class="m-1 btn btn-danger">Xóa</div>
										</div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	function deletePost(id){
		swal({
			title: "Bạn chắc chứ?",
			text: "Cân nhắc kỹ trước khi quyết định!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			cancel: 'Đóng',
			buttons: ['Đóng', 'Xóa']
		})
		.then((willDelete) => {
			if (willDelete) {
				window.location.href = `/poster/delete/${id}`;
			}
		});
	}


</script>
@endsection
