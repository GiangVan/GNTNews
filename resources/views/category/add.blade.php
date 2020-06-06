@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">add new a category</div>

                <div class="content">
                    <form action="/category/add" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tile</label>
                            <input class="form-control" name="title">
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
