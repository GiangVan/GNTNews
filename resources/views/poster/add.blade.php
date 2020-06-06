@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">add new a poster</div>

                <div class="content">
                    <form action="/poster/add" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tile</label>
                            <input class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content"></textarea>
                            <script>CKEDITOR.replace('content',{filebrowserUploadUrl: '/api/image-upload'});CKEDITOR.config.extraPlugins='image2'</script>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect">Category</label>
                            </div>
                            <select class="custom-select" name="category" value='1'>
                                @foreach ($category as $c)
                                    <option value="{{ $c->id }}">{{ $c->title }}</option>
                                @endforeach
                            </select>
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
