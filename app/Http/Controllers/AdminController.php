<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poster;
use App\User;
use App\Category;

class AdminController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }



	public function showAll()
	{
		if($this->isNotAdmin()){
			return view('redirect', ['url' => '/home']);
		}

		$category = DB::table('categories')->join('users', 'users.id', '=', 'categories.id_creator')->get(['categories.*', 'categories.id as category_id', 'users.*']);
		$posters = Poster::all();
		return view('admin', compact('posters', 'category'));
	}

	protected function isNotAdmin(): bool{
		return Auth::user()->role != 'admin';
	}
}
