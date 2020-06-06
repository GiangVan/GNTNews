@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">edit category</div>

                <div class="content">
                    <form action="/category/edit" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tile</label>
                            <input class="form-control" name="title" value="{{ $category->title }}">
                            <input style="display:none" name="id" value="{{ $category->id }}">
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
