@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">edit your poster</div>

                <div class="content">
                    <form action="/poster/edit" method="post">
                        @csrf
                        
                        <div class="form-group">
                            <label>Tile</label>
                            <input class="form-control" name="title" value="{{ $poster->title }}">
                            <input style="display:none" name="id" value="{{ $poster->poster_id }}">
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content">{{ $poster->content }}</textarea>
                            <script>CKEDITOR.replace('content',{filebrowserUploadUrl: '/api/image-upload'});CKEDITOR.config.extraPlugins='image2'</script>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect">Category</label>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="/admin" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
