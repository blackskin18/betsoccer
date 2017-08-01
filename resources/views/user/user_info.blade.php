<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ URL::asset('/css/all.css') }}" />
</head>
<body>
{{ csrf_field() }}
	<div>
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
		      </button>
		      <a class="navbar-brand" href="list-match">Soccer Bet</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	@if (Auth::user()->level == 0)
		      		<li> <a> {{Auth::user()->name}} </a> </li>
		      	@else
		      		<li> <a href="../admin/list-match" target="_self"> admin </a> </li>
		      	@endif
		        <li> <a href="user-info" target="_self"> user info </a> </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</div>

<div style="margin-top:	100px;
			margin-left: 350px;">
	<div style="width: 550px;">
		<h4 style="text-align: center; ">Name:
			<b style="color: red; ">{{Auth::user()->name}} </b>
		</h4>
		<h4 style="text-align: center; "> Sum money: 
			<b style="color: red;"> {{Auth::user()->sum_money}} </b> APC
		</h4>
	</div>
	<div>
		<table border = "1px" cellpadding = "5px">
	     	<tr>
	     		<th  colspan = "1"> stt</th>
	     		<th  colspan = "1"> </th>
		      	<th  colspan = "1"> Home </th>
		     	<th  colspan = "1"> draw</th>
		     	<th  colspan = "1"> away </th>
		      	<th  colspan = "1"> time start match </th>
		      	<th  colspan = "1"> bet for </th>
		        <th  colspan = "1"> money win </th>
	      	</tr>

	      	@foreach ($user_matches as $key => $user_match)
	    	<tr>

	    		<th rowspan = "3">{{$key}}</th>

		      	<th  colspan = "1"> name </th>
		     	<th  colspan = "1"> {{$user_match->home}} </th>
		     	<th  colspan = "1"> vs </th>
		      	<th  colspan = "1"> {{$user_match->away}} </th>
		        <th  rowspan = "3"> {{$user_match->time_start_match}} </th>
		        <th  rowspan = "3">
		        	@if ($user_match->bet_for == 1)
		        		{{$user_match->home}}
		        	@elseif ($user_match->bet_for == 0)
		        		draw
		        	@else
		        		{{$user_match->home}}
		        	@endif
		        </th>
		      	<th  rowspan = "3">
			    	{{$user_match->money_win}}
		      	</th>
	     	</tr>
	     	<tr>
		      	<th  colspan = "1"> rate </th>
		     	<th  colspan = "1"> {{$user_match->home_rate}} </th>
		     	<th  colspan = "1"> {{$user_match->draw_rate}} </th>
		      	<th  colspan = "1"> {{$user_match->away_rate}}</th>

	     	</tr>
	     	<tr>
		      	<th  colspan = "1"> score</th>
		     	<th  colspan = "1"> {{$user_match->home_score}}</th>
		     	<th  colspan = "1"> - </th>
		      	<th  colspan = "1"> {{$user_match->away_score}}</th>
	     	</tr>
	     	@endforeach

	    </table>
	</div>
</div>
</body>
</html>