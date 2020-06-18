@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sửa thể loại</div>

                <div class="card-body">
                    <form action="/category/edit" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tên thể loại</label>
                            <input class="form-control" name="title" value="{{ $category->title }}" required autofocus >
                            <input style="display:none" name="id" value="{{ $category->id }}">
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mr-1">Sửa ngay</button>
                        <a href="/category" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
