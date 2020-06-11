<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use App\Poster;
use App\User;
use App\Category;
use App\Account;
use App\Poster;

class HomeController extends Controller
{
	public function index($categoryId = null)
	{
		if($categoryId){
			$posters = Poster::whereNotNull('id_approver')->where('id_category', '=', $categoryId)->where('has_deleted', '=', false)->orderBy('created_at', 'desc')->get(['title', 'id', 'content']);
			
		} else {
			$posters = Poster::whereNotNull('id_approver')->where('has_deleted', '=', false)->orderBy('created_at', 'desc')->get(['title', 'id', 'content']);

		}
		$user = Auth::user();
		$categories = Category::all();
		return view('home', compact('posters', 'user', 'categories', 'categoryId'));
	}

	public function search(Request $req)
	{
		$text = $req->text;
		$categoryId = null;

		if($text){
			$posters = Poster::whereNotNull('id_approver')->where('has_deleted', '=', false)->where('content', 'like', "%{$text}%")->orderBy('created_at', 'desc')->get(['title', 'id', 'content']);
			$user = Auth::user();
			$categories = Category::all();
			return view('home', compact('posters', 'user', 'categories', 'categoryId'));
		} else {
			return $this->index($categoryId);
		}
	}

	public function showDetailPoster($id)
	{
		$poster = Poster::find($id);
		$topPosters = Poster::whereNotNull('posters.id_approver')->where('has_deleted', '=', false)->orderBy('viewnumber', 'desc')->limit(10)->get();
		$relatedPosters = Poster::where('id', '!=', $poster->id)->where('id_category', '=', $poster->id_category)->where('has_deleted', '=', false)->orderBy('created_at', 'desc')->limit(10)->get();
		
		if ($poster->id_approver && !$poster->has_deleted) {
			$poster->viewnumber = $poster->viewnumber + 1;
			$poster->save();
			
			$poster->author_name = User::find($poster->id_creator)->name;
			return view('poster/view', compact('poster', 'topPosters', 'relatedPosters'));
		}
	}

	public function showDetailPrivatePoster($id)
	{
		$poster = Poster::find($id);
		return view('poster/view', compact('poster'));
	}



	// public function speedtest(){
	//     for ($i=0; $i < 1000; $i++) { 
	//         $result = Account::selectRaw('account.*, login_session.*, account_bound.*')
	//                             ->join('login_session', 'account.id_account', '=', 'login_session.id_account')
	//                             ->join('account_bound', 'account.id_account', '=', 'account_bound.id_sender')
	//                             ->where('account.id_account', '>', '0')
	//                             ->where('login_session.id_account', '>', '0')
	//                             ->limit(10000)
	//                             ->get();
	//     }
	//     return $result;
	// }
}
