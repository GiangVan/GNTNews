<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poster;
use App\User;
use App\Category;
use App\Helpers\TimeConvert;

class CategoryManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
	}
	
	public function index(){
		$category = DB::table('categories')->join('users', 'users.id', '=', 'categories.id_creator')->get(['categories.*', 'categories.id as category_id', 'categories.created_at as category_created_at', 'users.*']);
		$this->formatCategoryDataTime($category);

		return view('category/view', compact('category'));
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
        return redirect('/poster');
    }

    public function add(Request $request){
        $category = new Category();
        $category->title = $request->title;
        $category->id_creator = Auth::id();
        $category->save();
        return redirect('/poster');
    }

    public function delete($id){
        try {
            Category::find($id)->delete();
        } catch (\Throwable $th) {
            
        }
        return redirect('/poster');
	}
	
	
	protected function formatCategoryDataTime(&$categories){
		foreach($categories as &$category){
			$category->category_created_at = TimeConvert::getDiff($category->created_at);
		}
	}
}
