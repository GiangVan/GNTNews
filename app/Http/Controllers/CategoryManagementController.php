<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poster;
use App\User;
use App\Category;

class CategoryManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showEditingPage($id){
        $category = Category::find($id);
        return view('category/edit', compact('category'));
    }
    public function showAddingPage(){
        return view('category/add');
    }

    public function edit(Request $request){
        $category = Category::find($request->id);
        $category->title = $request->title;
        $category->save();
        return view('redirect', ['url' => '/admin']);
    }

    public function add(Request $request){
        $category = new Category();
        $category->title = $request->title;
        $category->id_creator = Auth::id();
        $category->save();
        return view('redirect', ['url' => '/admin']);
    }

    public function delete($id){
        try {
            Category::find($id)->delete();
        } catch (\Throwable $th) {
            
        }
        return view('redirect', ['url' => '/admin']);
    }
}
