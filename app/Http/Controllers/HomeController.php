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

class HomeController extends Controller
{
	public function index()
	{
		$posters = DB::table('categories')->join('posters', 'posters.id_category', '=', 'categories.id')->join('users', 'users.id', '=', 'posters.id_creator')->whereNotNull('posters.id_approver')->where('has_deleted', '=', false)->get(['categories.title as categorytitle', 'users.*', 'posters.*']);
		$user = Auth::user();
		return view('home', compact('posters', 'user'));
	}

	public function showDetailPoster($id)
	{
		$poster = Poster::find($id);
		$topPosters = Poster::whereNotNull('posters.id_approver')->where('has_deleted', '=', false)->orderBy('viewnumber', 'desc')->get();
		
		if ($poster->id_approver && !$poster->has_deleted) {
			$poster->viewnumber = $poster->viewnumber + 1;
			$poster->save();
			
			$poster->author_name = User::find($poster->id_creator)->name;
			return view('poster/view', compact('poster', 'topPosters'));
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
