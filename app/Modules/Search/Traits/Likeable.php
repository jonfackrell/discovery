<?php

namespace App\Modules\Search\Traits;

use App\Modules\Search\Events\ItemSaved;
use App\Modules\Search\Models\Like;

trait Likeable
{

    public function toggleLike($database, $an)
    {
        if(auth()->guest()){
            return redirect()->route('login');
        }

        if (Like::where('user_id', user()->id)
                    ->where('database', $database)
                    ->where('an', $an)
                    ->first()) {
            Like::where('user_id', user()->id)
                ->where('database', $database)
                ->where('an', $an)
                ->delete();
             $this->item['liked'] = false;
        } else {
            $user = auth()->user();
            $like = new Like();
            $like->database = $database;
            $like->an = $an;
            $user->likes()->save($like);
            $this->item['liked'] = true;

            event(new ItemSaved($like));
        }
    }
}
