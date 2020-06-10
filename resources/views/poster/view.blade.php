@extends('layouts.app')

@section('content')

<?php 
	$user = Auth::user();
?>

<style>
	.post{
		position: relative;
	}
</style>

<div class="container post my-5 overflow-hidden">
    <div class="row flex-nowrap justify-content-center">
        <div class="col mr-5 overflow-hidden">
            <h1>{{ $poster->title }}</h1>
            <div name="content">{!! $poster->content !!}</div>
        </div>

		@if (isset($topPosters))
        <div class="col-md-3">
			<h1 class=" p-3 title text-white curved-2 text-size-14 rounded" style='background-color:gray'>Bài nổi bật</h1>
			<ul>
				@foreach ($topPosters as $topPoster)
					<li class='p-2 my-1' style='list-style-type: none;'>
						<a class='text-dark text-bold' href="/poster/view/{{ $topPoster->id }}">
						{{ $topPoster->title }}
						</a>
					</li>
				@endforeach
			</ul>

			<h1 class="p-3 title text-white curved-2 text-size-14 rounded" style='background-color:gray'>Tác giả</h1>
			<p class='p-3 ml-2'>{{ $poster->author_name }}</p>

			<h1 class="p-3 title text-white curved-2 text-size-14 rounded" style='background-color:gray'>Lượt xem</h1>
			<p class='p-3 ml-2 text-bold'>{{ $poster->viewnumber }}</p>
        </div>
		@endif
    </div>
</div>

@if (isset($relatedPosters))
<div class="container my-5">
	<h1 class=" p-3 title text-white curved-2 text-size-14 rounded" style='background-color:gray'>Bài liên quan</h1>
	<ul>
		@foreach ($relatedPosters as $relatedPoster)
			<li class='p-2 my-2' style='list-style-type: none;'>
				<a class='text-dark text-bold' href="/poster/view/{{ $relatedPoster->id }}">
				{{ $relatedPoster->title }}
				</a>
			</li>
		@endforeach
	</ul>
</div>
@endif

 <div class="container my-5">
        <h1 class=" p-3 title text-white curved-2 text-size-14 rounded" style='background-color:gray'>Bình luận</h1>
        <div class="comments"></div>
        <div id="loader" class="ground-center" style="background-image:url('/images/loader.gif')"></div>

        <div id='reply' class='reply floating teal' style="margin-top:50px">
            @if(!isset($user))
                <p class="text-gray justify-center">
                    Bạn cần
                    <a href="{{ url('/login') }}" class="text-teal">đăng nhập</a>
                    để bình luận
                </p>
            @else
                <a class='avatar curved-circle' style='background-image:url("/images/avatar.jpg")'></a>
                <div class='body curved-circle'>
                    <input id='textReply' class="content" onkeypress="keyPress_pushComment(event)">
                    <i class="far fa-smile"></i>
                </div>
                <i class="far fa-paper-plane btn-submit" onclick="pushComment()"></i>
            @endif
        </div>
        <div id='replySeccond' class='reply floating teal child none' send_to_comment_id='' style="margin-bottom:50px">
            @if(!isset($user))
                <p class="text-gray justify-center">
                    Bạn cần
                    <a href="{{ url('/login') }}" class="text-teal">đăng nhập</a>
                    để bình luận
                </p>
            @else
                <a class='avatar curved-circle' style='background-image:url("/images/avatar.jpg")'></a>
                <div class='body curved-circle'>
                    <input id='textReplySeccond' class="content" onkeypress="keyPress_pushCommentFromComment(event)">
                    <i class="far fa-smile"></i>
                </div>
                <i class="far fa-paper-plane btn-submit" onclick="pushCommentFromComment()"></i>
            @endif
        </div>
    </div>

    <script>
        var chemID = "{{ $poster->id }}";
        // get all comment 
        $(document).ready(function (){
            $.post('{{ url("/comment/all") }}' + '/' + chemID, {_token:"{{ csrf_token() }}"}, function(data){
                $(".comments").html(data);
                $("#loader").css("display", "none");
                $("#reply").css("display", "flex");
            });
        });
        //
        function keyPress_pushComment(event){
            if($("textarea").attr('disabled') === "disabled") return;
            var key = event.which || event.keyCode;
            if(key === 13){
                pushComment();
            }
        }
        function pushComment(){
            var content = $("#textReply").val();
            push(null, content);
            $("#textReply").val("");
            $("textarea").attr('disabled','disabled');
        }
        function keyPress_pushCommentFromComment(event){
            if($("textarea").attr('disabled') === "disabled") return;
            var key = event.which || event.keyCode;
            if(key === 13){
                pushCommentFromComment();
            }
        }
        function pushCommentFromComment(){
            var id_parent = $("#replySeccond").attr("send_to_comment_id");
            var content = $("#textReplySeccond").val();
            push(id_parent, content);
            $("#textReplySeccond").val("");
            $("#textarea").attr('disabled','disabled');
            $("#replySeccond").css("display", "none");
        }
        function push(id_parent, text){
            $.post('{{ url("/comment/push") }}', {_token:"{{ csrf_token() }}", chemicalID:chemID, parentID:id_parent, content:text}, function(data){
                if(data != 1){
                    alert("bình luận không thành công!");
                } else {
					location.reload();
				}
            });
        }

        function btnReplay_Click(id){
            $("#textReplySeccond").val("");
            setInterval(function (){$("#textReplySeccond").focus();} , 400);
            $("#replySeccond").attr("send_to_comment_id", id);
            $("#replySeccond").css("display", "flex");
            $("#replySeccond").insertAfter(getLastComment(id));
        }
        // lấy ra bình luận con cuối cùng trong bình luận cha
        function getLastComment(parentid) {
            var comments = $("[data-parent_id='" + parentid + "']");
            var id = comments.length > 0 ? comments[comments.length - 1].id : parentid;
            return document.getElementById(id);
        }
		</script>
@endsection
