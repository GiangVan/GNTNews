@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm thể loại</div>

                <div class="card-body">
                    <form action="/category/add" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tên thể loại</label>
                            <input class="form-control" name="title" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mr-1">Thêm ngay</button>
                        <a href="/admin" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
