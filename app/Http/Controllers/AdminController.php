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

class AdminController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }
}
