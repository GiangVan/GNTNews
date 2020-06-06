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
        $category = DB::table('category')->join('users', 'users.id', '=', 'category.id_creator')->get(['category.*', 'category.id as category_id', 'users.*']);
        $posters = DB::table('category')->join('posters', 'posters.id_category', '=', 'category.id')->join('users', 'users.id', '=', 'posters.id_creator')->where('users.id', '=', Auth::id())->get(['category.title as categorytitle','posters.id as poster_id', 'category.id as category_id', 'users.*', 'posters.*']);
        return view('admin', compact('posters', 'category'));
    }
}
