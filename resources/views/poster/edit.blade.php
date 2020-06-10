@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Sửa bài viết</h2>

                <div class="card-body">
                    <form action="/poster/edit" method="post">
                        @csrf
                        
                        <div class="form-group my-5">
                            <label class='font-weight-bold'>Tiêu đề bài viết:</label>
                            <input class="form-control" name="title" value="{{ $poster->title }}" required>
                            <input style="display:none" name="id" value="{{ $poster->id }}">
                        </div>
                        <div class="form-group my-5">
                            <label class='font-weight-bold'>Nội dung bài viết:</label>
                            <textarea name="content">{{ $poster->content }}</textarea>
                            <script>CKEDITOR.replace('content',{filebrowserUploadUrl: '/api/image-upload',height: 700});CKEDITOR.config.extraPlugins='image2'</script>
                        </div>
                        <div class="form-group my-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class='font-weight-bold input-group-text' for="inputGroupSelect">Thể loại</label>
                                </div>
                                <select class="custom-select" name="category" value="{{ $poster->category_id }}">
                                    @foreach ($category as $c)
                                        @if ($c->id === $poster->category_id)
                                            <option value="{{ $c->id }}" selected>{{ $c->title }}</option>
                                        @else
                                            <option value="{{ $c->id }}">{{ $c->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-5 mr-2">Thêm bài ngay</button>
                        <a href="/admin" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
</div>
@endsection
