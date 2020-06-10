@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Thêm bài mới</h5>

                <div class="card-body">
                    <form action="/poster/add" method="post">
                        @csrf
                        <div class="form-group">
                            <label class='font-weight-bold'>Tiêu đề bài viết:</label>
                            <input class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label class='font-weight-bold'>Nội dung bài viết:</label>
                            <textarea name="content"></textarea>
                            <script>CKEDITOR.replace('content',{filebrowserUploadUrl: '/api/image-upload'});CKEDITOR.config.extraPlugins='image2'</script>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="font-weight-bold input-group-text" for="inputGroupSelect">Thể loại</label>
                            </div>
                            <select class="custom-select" name="category" value='1'>
                                @foreach ($category as $c)
                                    <option value="{{ $c->id }}">{{ $c->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success px-5 mr-2">Thêm bài ngay</button>
                        <a href="/admin" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
