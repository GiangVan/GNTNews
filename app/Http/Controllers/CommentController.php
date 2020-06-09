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

    public function like(Request $request){
        // if(!is_null(Guard::$accessUser["ID"])){
        //     if(is_null(LikeComment::where("ID_User", Guard::$accessUser["ID"])->where("ID_Comment", $request["commentID"])->first())){
        //         $like = new LikeComment();
        //         $like->id_comment = $request["commentID"];
        //         $like->id_user = Guard::$accessUser["ID"];
        //         $like->save();
        //     } else{
        //         $likeInstance = LikeComment::where("ID_User", Guard::$accessUser["ID"])->where("ID_Comment", $request["commentID"]);
        //         return $likeInstance->delete();
        //     }
        //     return 1;
        // }
        // return 0;
    }
}
