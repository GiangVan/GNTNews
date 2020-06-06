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

    public function showAll(){
        $category = DB::table('categories')->join('users', 'users.id', '=', 'categories.id_creator')->get(['categories.*', 'categories.id as category_id', 'users.*']);
        $posters = DB::table('categories')->join('posters', 'posters.id_category', '=', 'categories.id')->join('users', 'users.id', '=', 'posters.id_creator')->where('users.id', '=', Auth::id())->get(['categories.title as categorytitle','posters.id as poster_id', 'categories.id as category_id', 'users.*', 'posters.*']);
        return view('admin', compact('posters', 'category'));
    }
}
