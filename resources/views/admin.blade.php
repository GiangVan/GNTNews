@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Your posters</div>
                <div class="content">
                    @if (count($posters))       
                        <table style="text-align:left">
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>View</th>
                                <th></th>
                            </tr>
                            <?php $count = 0; ?>
                            @foreach ($posters as $poster)
                                <?php $count++; ?>
                                <tr>
                                    <td>{{ $poster->title }}</td>
                                    <td>
                                        <textarea name="{{ $poster->poster_id }}">{{ $poster->content }}</textarea>
                                        <script>CKEDITOR.replace('{{ $poster->poster_id }}');</script>
                                        <style>#cke_{{ $count }}_top, #cke_{{ $count }}_bottom{display:none}</style>
                                    </td>
                                    <td>{{ $poster->categorytitle }}</td>
                                    <td>{{ $poster->viewnumber }}</td>
                                    <td class="btn-list">
                                        <a href="/poster/view/{{ $poster->poster_id }}" class="btn btn-warning">View</a>
                                        <a href="/poster/edit/{{ $poster->poster_id }}" class="btn btn-primary">Edit</a>
                                        <a href="/poster/delete/{{ $poster->poster_id }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>empty!</p>
                    @endif
                    <a href="/poster/add" style="margin:10px" class="btn btn-primary">Add</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Categories</div>
                <div class="content">
                    @if (count($category))       
                        <table style="text-align:left">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th></th>
                            </tr>
                            @foreach ($category as $c)
                                <tr>
                                    <td>{{ $c->title }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td class="btn-list">
                                        <a href="/category/edit/{{ $c->category_id }}" class="btn btn-primary">Edit</a>
                                        <a href="/category/delete/{{ $c->category_id }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>empty!</p>
                    @endif
                    <a href="/category/add" style="margin:10px" class="btn btn-primary">Add</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
