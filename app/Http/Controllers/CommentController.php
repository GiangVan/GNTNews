<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use App\Poster;
use App\User;
// use App\Category;
use App\Account;
use App\Poster;
use App\Comment;
use Carbon\Carbon;
use App\Helpers\TimeConvert;

class CommentController
{
    public function getAllComment($post_id){
		$comments = Poster::find($post_id)->comments;

		if($comments){
			$comments = $this->sortComments($comments);
			foreach ($comments as &$comment)
			{
				$comment->owner_name = User::find($comment->id_user)->name;
			}
			$this->formatDateTime($comments);

			return view("comment", [
				"chemicalID" => $post_id, 
				"comments" => $comments
			]);
		}
	}
	
	protected function sortComments($comments){
		$newComments = [];

		foreach ($comments as $comment){
			if(!$comment->comment_id){
				array_push($newComments, $comment);
				foreach ($comments as $cmt){
					if($comment->id === $cmt->comment_id){
						array_push($newComments, $cmt);
					}
				}
			}
		}

		return $newComments;
	}

	protected function formatDateTime(&$comments){
		foreach ($comments as $comment){
			$comment->time = TimeConvert::getDiff($comment->created_at);
		}
	}

    public function push(Request $request){
        if(Auth::user()){
            if($request->content){
                $newComment = new Comment();
                $newComment->content = $request["content"];
                $newComment->comment_id = $request["parentID"];
                $newComment->poster_id = $request["chemicalID"];
                $newComment->id_user = Auth::id();
                $newComment->save();
                return 1;
            }
        }
        return null;
    }
}
