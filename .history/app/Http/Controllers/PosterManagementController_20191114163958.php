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
        $poster = $this->checkPosterExist($id);
        if($poster !== false){
            $category = Category::all();
            return view('poster/edit', compact('poster', 'category'));
        }
        else
        {
            return view('redirect', ['url' => '/admin']);
        }
    }

    public function delete($id){
        foreach (User::find(Auth::id())->posters->where('id', '=', $id) as $value) {
            $value->delete();
        }
        return view('redirect', ['url' => '/admin']);
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

        $poster->save();

        return view('redirect', ['url' => '/admin']);
    }

    public function edit(Request $request){
        if($this->checkPosterExist($request->id) !== false){
            $poster = Poster::find($request->id);
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

    private function checkPosterExist($id){
        if($id !== '')
        {
            $posters = $posters = DB::table('category')->join('poster', 'poster.id_category', '=', 'category.id')->join('users', 'users.id', '=', 'poster.id_creator')->where('users.id', '=', Auth::id())->where('poster.id', '=', $id)->get(['category.title as categorytitle', 'poster.id as poster_id', 'category.id as category_id', 'users.*', 'poster.*']);
            if(count($posters))
            {
                $poster = $posters->where('id', $id);
                if(count($poster)){
                    foreach ($poster as $value) {
                        $poster = $value;
                    }
                    return $poster;
                }
            }
        }
        return false;
    }
}
