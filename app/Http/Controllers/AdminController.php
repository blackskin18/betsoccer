<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\User;
use App\UserMatch;
use DB;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function show()
    {
        $matches = UserMatch::all()->groupBy('match_id');
        echo "<pre>";
        print_r($matches);
        echo "</pre>";
    }

    //đưa ra danh sách các trận chưa public
    public function listMatch()
    {	
    	$matches = Match::orderBy('time_start_match', 'desc')->get();
    	return view('admin.list_match')->with('matches', $matches);
    }

    //form tạo trận đấu
    public function getCreateMatch()
    {
    	return view('admin.create_match');
    }

    //xử lý dữ liệu nhập trong form tạo trận đấu
    public function postCreatMatch(Request $Request)
    {
        $time_now = new Carbon();
        $this->validate($Request,
            ["home_name" => "required",
            "away_name" => "required|different:home_name",
            "closing_bet_time" => "required|date|before:time_start_match|after:$time_now",
            "time_start_match" => "required|date",
            "time_end_match" => "required|date|after:time_start_match",
            "home_rate" => "required",
            "draw_rate" => "required",
            "away_rate" => "required",
            ],
                ["home_name.required"=>"enter team home's name",
                "away_name.required"=>"enter team away's name",
                "closing_bet_time.required"=>"enter closing time bet",
                "time_start_match.required"=>"enter time to start match",
                "time_end_match.required"=>"enter time to end match",
                "home_rate.required"=>"enter rate for home team",
                "draw_rate.required"=>"enter rate when draw",
                "away_rate.required"=>"enter rate for away team",
                "away_name.different"=>"home team's name can't same away team's name",
                "closing_bet_time.before" => "time close bet can't after time to start match",
                "closing_bet_time.after" => "time close bet need after now",
                "time_end_match.after" => "time to end match can't before time to start match",
                "closing_bet_time.date" => "enter time in 'clossing bet time'",
                "time_end_match.date" => "enter time in 'time end match'",
                "time_start_match.date" => "enter time in 'time start match'",
                ]
            );

        //insert dữ liệu đã nhập vào DB
		DB::table('matches')->insert(array(	'home'=>$_POST["home_name"],
											'away'=>$_POST["away_name"], 
											'home_rate'=>$_POST["home_rate"],
											'draw_rate'=>$_POST["draw_rate"],
											'away_rate'=>$_POST["away_rate"],
											'home_score'=>null,
											'away_score'=>null,
											'closing_bet_time'=>$_POST["closing_bet_time"],
											'time_start_match'=>$_POST["time_start_match"],
											'time_end_match'=>$_POST["time_end_match"],
											'public'=>0));
		return Redirect::to('admin/list-match');
    }

    // công khai trận đấu cho người dùng thấy
    public function publicMatch($id)
    {
    	DB::table('matches')->where('id', $id)->update(['public'=>1]);
    	return Redirect::to('admin/list-match');
    }

    //xóa trận đấu chưa public
    public function deleteMatch($id)
    {
    	DB::table('matches')->where('id', $id)->delete();
    	return Redirect::to('admin/list-match');
    }

    //xóa trận đấu khi đã public
    public function deletePublicMatch($id)
    {
        $sum_user_bet_match = UserMatch::where('match_id', $id)->count();
        //nếu đã có người đặt thì không xóa được
        if ($sum_user_bet_match == 0) {
            DB::table('matches')->where('id', $id)->delete();
            return Redirect::to('admin/public-list-match');
        }
        else
            return Redirect::to('admin/public-list-match');
    }

    //đưa ra form xửa thông tin trận đấu
    public function getEditMatch($id)
    {
		$match = Match::find($id);
    	return view('admin.edit_match')->with('id', $id)->with('match', $match);
    }

    //xử lý dữ liệu đã nhập trong form edit trận đấu
    public function postEditMatch($id, Request $Request) 
    {
        $match = Match::find($id);
        $time_start_match =$match->time_start_match;
        $time_now = new Carbon();
        $this->validate($Request,
            ["home_name" => "required",
            "away_name" => "required|different:home_name",
            "closing_bet_time" => "required|date|before:$time_start_match|after:$time_now",
            "time_end_match" => "required|date|after:time_start_match",
            "home_rate" => "required",
            "draw_rate" => "required",
            "away_rate" => "required",
            ],
                ["home_name.required"=>"enter team home's name",
                "away_name.required"=>"enter team away's name",
                "closing_bet_time.required"=>"enter closing time bet",
                "time_end_match.required"=>"enter time to end match",
                "home_rate.required"=>"enter rate for home team",
                "draw_rate.required"=>"enter rate when draw",
                "away_rate.required"=>"enter rate for away team",
                "away_name.different"=>"home team's name can't same away team's name",
                "closing_bet_time.before" => "time close bet can't after time to start match",
                "closing_bet_time.after" => "time close bet need after now",
                "time_end_match.after" => "time to end match can't before time to start match",
                "closing_bet_time.date" => "enter time in 'clossing bet time'",
                "time_end_match.date" => "enter time in 'time end match'",
                ]
            );
        //update dữ liệu trong form edit vào DB
    	DB::table('matches')->where('id', $id)->update(array(
    										'home'=>$_POST["home_name"],
											'away'=>$_POST["away_name"], 
											'home_rate'=>$_POST["home_rate"],
											'draw_rate'=>$_POST["draw_rate"],
											'away_rate'=>$_POST["away_rate"],
											'closing_bet_time'=>$_POST["closing_bet_time"],
											'time_end_match'=>$_POST["time_end_match"]
											));
		return Redirect::to('admin/list-match');
    }
    //đưa ra danh sách trận đấu đã public (user có thể nhìn thấy)
    public function publicListMatch()
    {
    	$matches = Match::orderBy('time_start_match', 'desc')->get();
        $user_matches = UserMatch::all();
    	return view('admin.public_list_match')->with('matches', $matches)->with('user_matches', $user_matches);
    }

    // form cập nhập tỉ số
    public function getUpdateScore()
    {
        // thông tin các trận đấu đã public
        $matches = Match::where('public', 1)->orderBy('time_end_match')->get();
        $time_now = new Carbon();
        return view('admin.update_score')->with('time_now', $time_now)->with('matches', $matches);
    }

    //xử lý khi cập nhập tỉ sổ
    public function postUpdateScore($match_id, Request $Request)
    {      
        $this->validate($Request,
            ["home_score" => "required|Integer",
            "away_score" => "required|Integer",
            ],
                ["home_score.required"=>"Enter home score",
                "away_score.required"=>"Enter away score",
                "home_score.Integer"=>"The score must be a number ",
                "away_score.Integer"=>"The score must be a number ",
                ]
            );

        $user_id = Auth::user()->id; 
        //cập nhập tỉ số vào bảng matches trong DB
        DB::table('matches')->where('id', $match_id)->update(array(
                                            'home_score'=>$_POST["home_score"],
                                            'away_score'=>$_POST["away_score"], 
                                            ));
        $result = 0;                                            //kết quả trận đấu đội nào thăng
        if ($_POST["home_score"] > $_POST["away_score"]) {
            $result = 1;                                        //đội nhà thắng
        }
        elseif ($_POST["home_score"] < $_POST["away_score"]) {
            $result =-1;                                        // đấu hòa
        }
        else {
            $result = 0;                                       //đội khách thắng
        }
        
        $user_matches = UserMatch::where('match_id', $match_id)->get();
        $match = Match::find($match_id);
        //cập nhập số tiền thắng trong bảng user_matches và tổng tiền của user trong bảng users
        foreach ($user_matches as $user_match) {
            //nếu đặt cược đúng và đặt cho đội nhà
            if ($user_match->bet_for == $result and $user_match->bet_for == 1) {
                // updata tổng tiền của user = tổng hiện tại + tiền thắng + tiền đặt 
                $user = User::find($user_match->user_id);
                $user->sum_money = $user->sum_money + $user_match->money_bet * $match->home_rate + $user_match->money_bet;
                $user->save();
                //update số tiền thắng mà user đặt cho mỗi trận
                $user_match->money_win = $user_match->money_bet * $match->home_rate;
                $user_match->save();
            }

            //nếu đặt cược đúng và đặt hòa
            elseif ($user_match->bet_for == $result and $user_match->bet_for == 0) {
                // updata tổng tiền của user = tổng hiện tại + tiền thắng + tiền đặt 
                $user = User::find($user_match->user_id);
                $user->sum_money = $user->sum_money + $user_match->money_bet * $match->draw_rate + $user_match->money_bet;
                $user->save();
                //update số tiền thắng mà user đặt cho mỗi trận
                $user_match->money_win = $user_match->money_bet * $match->draw_rate;
                $user_match->save();
            }
            elseif ($user_match->bet_for == $result and $user_match->bet_for == -1) {
                // updata tổng tiền của user = tổng hiện tại + tiền thắng + tiền đặt 
                $user = User::find($user_match->user_id);
                $user->sum_money = $user->sum_money + $user_match->money_bet * $match->away_rate + $user_match->money_bet;
                $user->save();
                //update số tiền thắng mà user đặt cho mỗi trận
                $user_match->money_win = $user_match->money_bet * $match->away_rate;
                $user_match->save();
            }
            // nếu đặt cược sai
            // nếu đặt cược thua thì tổng tiền không đổi
            else {
                $user_match->money_win = -$user_match->money_bet;
                $user_match->save();
            }
        }
        return Redirect::to('admin/update-score');
    }

    //đưa ra thông tin của 1 trận đấu đã public
    public function getMatchInfo($id)
    {
        $match = Match::find($id);
        $match_users = UserMatch::where('match_id', $id)->get();
        $users = User::all();
        return view('admin.match_info')->with('match', $match)->with('match_users', $match_users)->with('users', $users);
    }

}