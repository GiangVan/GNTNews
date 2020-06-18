@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sửa tài khoản</div>

                <div class="card-body">
                    <form action="/accounts/edit" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="name" value="{{ $account->name }}" required autofocus >
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" value="{{ $account->email }}" required>
                        </div>
                        <div class="form-group">
                            <label>Chức vụ</label>
                            <select class="form-control" name='role'>
								<option value="{{ App\Http\Enums\AccountRoles::USER }}" {!! ($account->role === App\Http\Enums\AccountRoles::USER) ? 'selected' : '' !!}>User</option>
								<option value="{{ App\Http\Enums\AccountRoles::ADMIN }}" {!! ($account->role === App\Http\Enums\AccountRoles::ADMIN) ? 'selected' : '' !!}>Admin</option>
							</select>
                        </div>
                        <input style="display:none" name="id" value="{{ $account->id }}">
                        <button type="submit" class="btn btn-primary px-4 mr-1 mt-3">Cập nhật</button>
                        <a href="/accounts" class="btn btn-secondary  mt-3">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
