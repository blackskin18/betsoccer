<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
	protected $table ="matches";

	protected $fillable = [
        'home', 'away', 'home_rate', 'draw_rate', 'away_rate', 'home_score', 'away_score', 'closing_bet_time', 'time_start_match', 'time_end_match'
    ];

    public function user () 
    {
    	return $this->belongsToMany('App\User', 'user_matches');
    }

    public function matchUser()
    {
    	return $this->hasMany('App\UserMatch');
    }
    
}