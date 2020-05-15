<?php

namespace App\Modules\Search\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    /**
     * Show search results.
     *
     * @return json
     */
    public function __invoke(Request $request)
    {
        if(strlen($request->get('q')) < 6) return [];
        return User::select('id','name', 'email')
            ->where('email', 'LIKE', '%'. $request->get('q') . '%')
            ->get()
            ->map(function($item){
                return [
                    'id' => $item->id,
                    'text' => $item->name . ' (' . $item->email . ')',
                ];
            });
    }
}
