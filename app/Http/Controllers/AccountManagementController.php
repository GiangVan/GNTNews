<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poster;
use App\User;
use App\Category;
use App\Helpers\TimeConvert;
use App\Http\Enums\AccountRoles;

class AccountManagementController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }

	public function index(){
		$accounts = User::where('id', '!=', Auth::id())->get(['id', 'name', 'email', 'role', 'created_at', 'is_blocked']);
		$this->formatAccountsDataTime($accounts);

		return view('account/view', compact('accounts'));
	}

	protected function formatAccountsDataTime(&$accounts){
		foreach($accounts as &$account){
			$account->account_created_at = TimeConvert::getDiff($account->created_at);
		}
	}

	    
    public function showEditingPage($id){
		$account = User::find($id);
		return view('account/edit', compact('account'));
	}

	
    public function edit(Request $request){
		$account = User::find($request->id);
		if($account->role < AccountRoles::MASTER){
			$account->name = $request->name;
			$account->email = $request->email;
			$account->role = $request->role;
			$account->save();
		}

		return redirect('/accounts');
    }
	
    public function block($id){
		$account = User::find($id);
		$account->is_blocked = true;
		$account->save();

		return redirect('/accounts');
    }
	
    public function unblock($id){
		$account = User::find($id);
		$account->is_blocked = false;
		$account->save();

		return redirect('/accounts');
    }
}
