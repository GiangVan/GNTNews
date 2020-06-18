<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poster;
use App\User;
use App\Category;
use App\Http\Enums\AccountRoles;
use App\Helpers\TimeConvert;

class PosterManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
	}
	
	
	public function index()
	{
		$posters = null;

		if(!$this->isNotAdmin()){
			$posters = Poster::where('has_deleted', '=', false)->where('id_creator', '!=', Auth::id())->get();
			$this->fetchApproverNames($posters);
			$this->fetchCategoryTitles($posters);
			$this->formatDataTime($posters);
			$this->fetchAuthorNames($posters);
		}

		$myPosters = Poster::where('has_deleted', '=', false)->where('id_creator', '=', Auth::id())->get();
		$this->fetchCategoryTitles($myPosters);
		$this->formatDataTime($myPosters);
			
		return view('poster/post_management', compact('posters', 'myPosters'));
	}

	protected function isNotAdmin(): bool{
		return Auth::user()->role < AccountRoles::ADMIN;
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

	protected function fetchAuthorNames(&$posters){
		foreach($posters as &$poster){
			if($poster->id_creator){
				$poster->author_name = User::find($poster->id_creator)->name;
			}
		}
	}

	protected function formatDataTime(&$posters){
		foreach($posters as &$poster){
			$poster->time = TimeConvert::getDiff($poster->created_at);
		}
	}
    
    public function showEditingPage($id){
		$poster = Poster::find($id);
		if($poster && Auth::user()->role > AccountRoles::USER || ($poster->id_approver === null && $poster->id_creator === Auth::id())){
			$category = Category::all();
			return view('poster/edit', compact('poster', 'category'));
		}
	}

	public function approve($id){
		if(Auth::user()->role > AccountRoles::USER){
			$poster = Poster::find($id);
			$poster->id_approver = Auth::id();
			if($poster->save()){
				return redirect('/poster');
			}
		}
	}


    public function delete($id){
		if(Auth::user()->role > AccountRoles::USER){
			$poster = Poster::find($id);
			$poster->has_deleted = true;
			$poster->save();
			
			return redirect('/poster');
		} else {
			$poster = Poster::find($id);
			if($poster && $poster->id_creator === Auth::id()){
				$poster->has_deleted = true;
				$poster->save();

				return redirect('/poster');
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
		if(Auth::user()->role > AccountRoles::USER){
			$poster->id_approver = Auth::id();
		}

        $poster->save();

		return redirect('/poster');
    }

    public function edit(Request $request){
		$poster = Poster::find($request->id);
		if($poster && Auth::user()->role > AccountRoles::USER || ($poster->id_approver === null && $poster->id_creator === Auth::id())){
			$poster->title = $request->title;
			$poster->content = $request->content;
			$poster->id_category = $request->category;
			$poster->save();
		}

		return redirect('/poster');
    }

    public function apiget(Request $request){
        $id = $request->id;
        return "hello {$id}";
    }
}
