@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Thêm bài mới</h2>

                <div class="card-body">
                    <form action="/poster/add" method="post">
                        @csrf
                        <div class="form-group my-5">
                            <label class='font-weight-bold'>Tiêu đề bài viết:</label>
                            <input class="form-control" name="title" required autofocus>
                        </div>
                        <div class="form-group my-5">
                            <label class='font-weight-bold'>Nội dung bài viết:</label>
                            <textarea name="content" required></textarea>
                            <script>CKEDITOR.replace('content',{filebrowserUploadUrl: '/api/image-upload',height: 700});CKEDITOR.config.extraPlugins='image2'</script>
                        </div>
                        <div class="input-group my-5">
                            <div class="input-group-prepend">
                                <label class="font-weight-bold input-group-text" for="inputGroupSelect">Thể loại</label>
                            </div>
                            <select class="custom-select" name="category" value='1'>
                                @foreach ($category as $c)
                                    <option value="{{ $c->id }}">{{ $c->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success px-5 mr-2">Gửi bài ngay</button>
                        <a href="/admin" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
</div>
@endsection
