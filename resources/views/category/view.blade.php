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
			
			@if (Auth::user()->role > App\Http\Enums\AccountRoles::USER && $category)
            <div class="card my-5">
                <p class="card-header">Quản lý thể loại</p>
                <div class="card-body">
					<a href="/category/add" style="margin:10px" class="mb-5 w-100 btn btn-primary">Thêm thể loại</a>

                    @if (count($category))       
                        <table class='w-100' style="text-align:left">
                            <tr>
                                <th>STT</th>
                                <th>Tên thể loại</th>
                                <th>Người thêm</th>
								<th>Ngày thêm</th>
                                <th>Tùy chọn</th>
                            </tr>
							<?php $count = 0; ?>
                            @foreach ($category as $c)
								<?php $count++; ?>
                                <tr class='border-bottom'>
									<td>{{$count}}</td>
                                    <td>{{ $c->title }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->category_created_at }}</td>
                                    <td class="btn-list">
                                        <a href="/category/edit/{{ $c->category_id }}" class="btn btn-primary">Sửa</a>
                                        <div onclick='deleteCategory({{ $c->category_id }})' class="btn btn-danger">Xóa</div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                    
                </div>
			</div>
			@endif
        </div>
    </div>
</div>

<script>

	function deleteCategory(id){
		swal({
			title: "Bạn chắc chứ?",
			text: "Cân nhắc kỹ trước khi quyết định!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			buttons: ['Đóng', 'Xóa']
		})
		.then((willDelete) => {
			if (willDelete) {
				window.location.href = `/category/delete/${id}`;
			}
		});
	}


</script>
@endsection
