<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{
    	protected $table ="user_matches";

	protected $fillable = [
        'user_id', 'match_id', 'money_bet', 'bet_for', 'money_win'   ];

    public function match()
    {
        return $this->belongsTo('App\Match');
    }
}
