<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poster;
use App\User;
use App\Category;
use App\Http\Resources\PosterResource;

class APIPosterManagementController extends Controller
{
    public function get(Request $request){
        $id = $request->id;
        $poster = Poster::find($id);
        if(!is_null($poster))
        {
            return new PosterResource($poster);
        }
        else
        {
            echo 'not found';
        }
    }

}
