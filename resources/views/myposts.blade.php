@extends('layouts.app')

@section('content')
<style>
	.post-content{
		width: 300px;
		height: 200px;
		overflow: auto;
		position: relative;
	}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Posts</div>
                <div class="content">
                    @if (count($posters))       
                        <table style="text-align:left">
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>View</th>
                                <th>#</th>
                            </tr>
                            <?php $count = 0; ?>
                            @foreach ($posters as $poster)
                                <?php $count++; ?>
                                <tr>
                                    <td>{{ $poster->title }}</td>
                                    <td>
                                        <div class='post-content' name="{{ $poster->id }}">{!! $poster->content !!}</div>
                                        <style>#cke_{{ $count }}_top, #cke_{{ $count }}_bottom{display:none}</style>
                                    </td>
                                    <td>{{ $poster->categorytitle }}</td>
                                    <td>{{ $poster->viewnumber }}</td>
                                    <td class="btn-list">
                                        <a href="/poster/view/private/{{ $poster->id }}" class="btn btn-warning">View</a>
                                        <a href="/poster/edit/{{ $poster->id }}" class="btn btn-primary">Edit</a>
                                        <a href="/poster/delete/{{ $poster->id }}" class="btn btn-danger">Delete</a>
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
        </div>
    </div>
</div>
@endsection
