<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poster;
use App\User;
use App\Category;
use App\Helpers\TimeConvert;

class AdminController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }



	public function showAll()
	{
		$posters = null;
		$user = Auth::user();

		if(!$this->isNotAdmin()){
			$posters = Poster::where('has_deleted', '=', false)->where('id_creator', '!=', Auth::id())->get();
			$this->fetchApproverNames($posters);
			$this->fetchCategoryTitles($posters);
			$this->formatDataTime($posters);
		}

		$category = DB::table('categories')->join('users', 'users.id', '=', 'categories.id_creator')->get(['categories.*', 'categories.id as category_id', 'users.*']);
		$myPosters = Poster::where('has_deleted', '=', false)->where('id_creator', '=', Auth::id())->get();
		$this->fetchCategoryTitles($myPosters);
		$this->formatDataTime($myPosters);
			
		return view('admin', compact('posters', 'myPosters', 'category', 'user'));
	}

	protected function isNotAdmin(): bool{
		return Auth::user()->role != 'admin';
	}

	protected function fetchCategoryTitles(&$posters){
		foreach($posters as &$poster){
			$poster->categorytitle = Category::find($poster->id_category)->title;
		}
	}

	protected function fetchApproverNames(&$posters){
		foreach($posters as &$poster){
			if($poster->id_approver){
				$poster->approver_name = User::find($poster->id_approver)->name;
			}
		}
	}

	protected function formatDataTime(&$posters){
		foreach($posters as &$poster){
			$poster->time = TimeConvert::getDiff($poster->created_at);
		}
	}
}
