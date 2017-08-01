<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\User;
use App\UserMatch;
use DB;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //đưa ra danh sách trận đấu mà admin đã public
    public function listMatch() 
    {   
        $time_now = new Carbon();
		$matches = Match::orderBy('closing_bet_time','desc')->get();
    	return view('user.list_match')->with('matches',$matches)->with('time_now', $time_now);
    }

    //form đặt cược
    public function getBetMatch($user_id,$match_id)
    {
        $time_now = new Carbon();
    	$match = Match::where('id',$match_id)->get();
        if ($match[0]->closing_bet_time > $time_now)
    	   return view('user.bet_match')->with('user_id',$user_id)->with('match_id',$match_id)->with('match',$match);
        else
            return Redirect::to('user/list-match');
    }

    //xử lý dữ liệu của form đặt cược
    public function postBetMatch($user_id, $match_id, Request $Request)
    {
        $user = User::where('id',$user_id)->get();
        $sum_money = $user[0]->sum_money;
        $this->validate($Request,
            ["money_bet" => "required|integer|max:$sum_money|min:1",
            "bet_for" => "required",
            ]
            );
        // insert vào DB
    	DB::table('user_matches')->insert(['user_id'=>$user_id,
											'match_id'=>$match_id,
											'money_bet'=>$_POST["money_bet"], 
											'bet_for'=>$_POST["bet_for"],
											]);
        // cập nhập tổng số tiền của user
    	DB::table('users')->where('id',$user_id)->update([ 'sum_money'=>$sum_money - $_POST["money_bet"] ]);
		return Redirect::to('user/list-match');
    }


    // thông tin người dùng
    public function userInfo()
    {
        $id = Auth::user()->id;
        //join 3 bảng với nhau, lấy những bản ghi mà mà user đã đăng nhập có mặt
        $user_matches = DB::table('user_matches')
                            ->join('users', 'user_matches.user_id', '=', 'users.id')
                            ->join('matches', 'user_matches.match_id', '=', 'matches.id')
                            ->where('users.id',$id)
                            ->orderBy('time_start_match', 'desc')
                            ->get();
    	return view('user.user_info')->with('user_matches',$user_matches);
    }

    //thông tin trận đấu
    public function matchInfo($match_id) 
    {
        $user_id = Auth::user()->id;
        // thông tin của trận đấu mà user chọn
        // mảng 1 phần tử là 1 opject (bản ghi trận đấu)
        $match = Match::where('id',$match_id)->get();
        //thông tin user đã đặt trận đấu mà user chọn
        $match_users =  UserMatch::where('match_id',$match_id)->get();
        return view('user/match_info')->with('match_users',$match_users)->with('match',$match);
    }


}