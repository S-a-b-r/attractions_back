<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttractionResource;
use App\Models\Attraction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request){
        $data = $request->validate([
                                       'search'=>'required|string',
                                       'filter'=>'boolean',
                                       'sorted'=>'boolean',
                                       'remember_token'=>'string'
                                   ]);
        $query = Attraction::where('title','like',"%{$data['search']}%");

        if(isset($data['filter']) && $data['filter'] == true){
            $user = User::where('remember_token', $data['remember_token'])->first();
            $query = $query->where('id_creator', $user->id);
        }

        if(isset($data['sorted'])) {
            $query = $data['sorted']?$query->orderBy('title'):$query->orderBy('created_at', 'desc');
        }

        return AttractionResource::collection($query->where('is_published', '1')->paginate(5));
    }
}
