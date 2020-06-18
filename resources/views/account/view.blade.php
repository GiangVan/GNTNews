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
			
			@if (Auth::user()->role === App\Http\Enums\AccountRoles::MASTER && $accounts)
            <div class="card my-5">
                <p class="card-header">Quản lý tài khoản</p>
                <div class="card-body">
                    @if (count($accounts))       
                        <table class='w-100' style="text-align:left">
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
								<th>Email</th>
                                <th>Chức vụ</th>
                                <th>Tham gia</th>
                                <th>Tùy chọn</th>
                            </tr>
                            @foreach ($accounts as $c)
                                <tr class='border-bottom'>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td>
									@if ($c->role < App\Http\Enums\AccountRoles::ADMIN)
										<h5>👨‍💼</h5>
									@else									
										<h4>👨‍✈️</h4>
									@endif
									</td>
                                    <td>{{ $c->account_created_at }}</td>
                                    <td class="btn-list">
                                        <a href="/accounts/edit/{{ $c->id }}" class="btn btn-primary">Sửa</a>
										@if ($c->is_blocked)
                                        <a href='/accounts/unblock/{{ $c->id }}' class="btn btn-success">Mở khóa tài khoản</a>
										@else
                                        <div onclick='bandAccount({{ $c->id }})' class="btn btn-danger">Khóa tài khoản</div>
										@endif
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

	function bandAccount(id){
		swal({
			title: "Bạn chắc chứ?",
			text: "Cân nhắc kỹ trước khi quyết định!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			buttons: ['Đóng', 'Khóa tài khoản']
		})
		.then((willDelete) => {
			if (willDelete) {
				window.location.href = `/accounts/block/${id}`;
			}
		});
	}


</script>
@endsection
