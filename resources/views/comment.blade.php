@if(!is_null($comments))
    @foreach($comments as $comment)
        {!!
            //Comment parent and child
            $add_class = "";
            $timeStyle = "font-size: 1rem;color: #9e9e9e;top: -63px; position: absolute;right: -11px;";
            $add_attribute = "";
            $add_ButtonReply = "<p class='hand btn-reply' onclick='btnReplay_Click({$comment->id})'>TRẢ LỜI</p>";
            if(isset($comment->comment_id)){
				$timeStyle = "font-size: 1rem;color: #9e9e9e;top: -103px; position: absolute;right: -11px;";
                $add_class = "child";
                $add_attribute = "data-parent_id={$comment->comment_id}";
                $add_ButtonReply = "";
            }
        !!}
        <div id='{{ $comment->id }}' class='p-3 comment lite floating teal {{ $add_class }} hover curved-8' {{ $add_attribute }}>
            <a class='owner-avatar curved-circle' style='background-image:url("/images/avatar.jpg")'></a>
            <div class="body curved-8">
                <i class='hand btn-dropdown fas fa-ellipsis-h' data-toggle=''></i>
                <a class='owner-name'>{{ $comment->owner_name }}</a>
                <pre class='content font-weight-bold'>{{ $comment->content }}</pre>
				<div class='tool-bar'>
					{!! $add_ButtonReply !!}
					<div style='{{ $timeStyle }}' class="time">{{$comment->time}}</div>
				</div>         
            </div>   
        </div>
    @endforeach
@endif