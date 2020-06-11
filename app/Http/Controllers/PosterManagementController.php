<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poster;
use App\User;
use App\Category;

class PosterManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showEditingPage($id){
		$poster = Poster::find($id);
		if($poster && Auth::user()->role === 'admin' || ($poster->id_approver === null && $poster->id_creator === Auth::id())){
			$category = Category::all();
			return view('poster/edit', compact('poster', 'category'));
		}
	}

	public function approve($id){
		if(Auth::user()->role === 'admin'){
			$poster = Poster::find($id);
			$poster->id_approver = Auth::id();
			if($poster->save()){
				return view('redirect', ['url' => '/admin']);
			}
		}
	}


    public function delete($id){
		if(Auth::user()->role === 'admin'){
			$poster = Poster::find($id);
			$poster->has_deleted = true;
			$poster->save();
			
			return view('redirect', ['url' => '/admin']);
		} else {
			$poster = Poster::find($id);
			if($poster && $poster->id_creator === Auth::id()){
				$poster->has_deleted = true;
				$poster->save();

				return view('redirect', ['url' => '/admin']);
			}
		}
    }

    public function showAddingPage(){
        $category = Category::all();
        return view('poster/add', compact('category'));
    }

    public function add(Request $request){
        $poster = new Poster;
        $poster->title = $request->title;
        $poster->content = $request->content;
        $poster->id_category = $request->category;
		$poster->id_creator = Auth::id();
		if(Auth::user()->role === 'admin'){
			$poster->id_approver = Auth::id();
		}

        $poster->save();

		return view('redirect', ['url' => '/admin']);
    }

    public function edit(Request $request){
		$poster = Poster::find($request->id);
		if($poster && Auth::user()->role === 'admin' || ($poster->id_approver === null && $poster->id_creator === Auth::id())){
			$poster->title = $request->title;
			$poster->content = $request->content;
			$poster->id_category = $request->category;
			$poster->save();
		}

		return view('redirect', ['url' => '/admin']);
    }

    public function apiget(Request $request){
        $id = $request->id;
        return "hello {$id}";
    }
}
