<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('histories')->insert(array(
    		array('user_id'=>1, 'match_id'=>1, 'money_win'=>200),
    		array('user_id'=>1, 'match_id'=>2, 'money_win'=>200),
    		array('user_id'=>1, 'match_id'=>3, 'money_win'=>200),
    		array('user_id'=>1, 'match_id'=>4, 'money_win'=>200),
    		array('user_id'=>2, 'match_id'=>1, 'money_win'=>200),
    		array('user_id'=>1, 'match_id'=>2, 'money_win'=>200),
    		array('user_id'=>1, 'match_id'=>3, 'money_win'=>200),
    		array('user_id'=>4, 'match_id'=>4, 'money_win'=>200),
    		array('user_id'=>3, 'match_id'=>2, 'money_win'=>200),
    		array('user_id'=>2, 'match_id'=>3, 'money_win'=>200),
    		array('user_id'=>6, 'match_id'=>1, 'money_win'=>200),
    		array('user_id'=>4, 'match_id'=>2, 'money_win'=>200),
    		));

    /*
    	DB::table('matches')->insert(array(
    		array('home'=>'sda sdsd', 'away'=>'fsdf342sdf', 'home_win'=> 1, 'draw'=>1, 'away_win'=>2, 'result'=>0, 'status'=>1, 'score'=>'5-0'),
    		array('home'=>'sda 32dfs', 'away'=>'fsdf 23 234 2sdf', 'home_win'=> 1, 'draw'=>1, 'away_win'=>2, 'result'=>0, 'status'=>1, 'score'=>'5-0'),
    		array('home'=>'sda sdfs', 'away'=>'fsdfs 2 23 24dfsdf', 'home_win'=> 1, 'draw'=>1, 'away_win'=>2, 'result'=>0, 'status'=>1, 'score'=>'5-0'),
    		array('home'=>'sfsd sdsd', 'away'=>'fsdf23 2sdf', 'home_win'=> 1, 'draw'=>1, 'away_win'=>2, 'result'=>0, 'status'=>1, 'score'=>'5-0'),
    		array('home'=>'sdsdfsasf sdsd', 'away'=>'fsdf2342sdf', 'home_win'=> 1, 'draw'=>1, 'away_win'=>2, 'result'=>0, 'status'=>1, 'score'=>'5-0'),
    		array('home'=>'ssdfsfda ssdfdsd', 'away'=>'fssdf  sdfsdf', 'home_win'=> 1, 'draw'=>1, 'away_win'=>2, 'result'=>0, 'status'=>1, 'score'=>'5-0'), 
    		array('home'=>'sdfagsdsa sdsd', 'away'=>'fsdf  sdf', 'home_win'=> 1, 'draw'=>1, 'away_win'=>2, 'result'=>0, 'status'=>1, 'score'=>'5-0'),
    		));

         DB::table('users')->where('password', '=', '23456')->update(['password'=>'12346']);
    
	*/
    }
}
