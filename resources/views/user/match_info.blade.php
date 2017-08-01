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
		      <a class="navbar-brand" href="../list-match">Soccer Bet</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	@if (Auth::user()->level == 0)
		      		<li> <a> {{Auth::user()->name}} </a> </li>
		      	@else
		      		<li> <a href="../../admin/list-match" target="_self"> admin </a> </li>
		      	@endif
		        <li> <a href="../user-info" target="_self"> user info </a> </li>
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

	<div style="margin: 100px;">
	
	
	<?php 
	$sum_bet_for_home = 0;
	$sum_bet_for_draw = 0;
	$sum_bet_for_away = 0;

	$sum_money_bet_for_home = 0;
	$sum_money_bet_for_draw = 0;
	$sum_money_bet_for_away = 0;

	 ?>

	@foreach ($match_users as $match_user)
		@if ($match_user->bet_for == 1)
			<?php 
				$sum_bet_for_home++;
				$sum_money_bet_for_home += $match_user->money_bet;
			?>
		@elseif ($match_user->bet_for == 0)
			<?php 
				$sum_bet_for_draw++;
				$sum_money_bet_for_draw += $match_user->money_bet;
			?>
		@elseif ($match_user->bet_for == -1)
			<?php
				$sum_bet_for_away++;
				$sum_money_bet_for_away += $match_user->money_bet;
			?>
		@endif
	@endforeach


	<!-- $match là mảng gồm 1 opject là bản ghi trận đấu user chọn -->
	<h3> Match info</h3>
	<div class="match-info">  
	  <table class="table .table-condensed" style="text-align: center;">
	      <tr>
	        <th> Name:</th>
	        <th>{{$match[0]->home}}</th>
	        <th> vs </th>
	        <th> {{$match[0]->away}} </th>
	      </tr>
	      <tr>
	        <td>Rate:</td>
	        <td>{{$match[0]->home_rate}}</td>
	        <td>{{$match[0]->draw_rate}}</td>
	        <td>{{$match[0]->away_rate}}</td>
	      </tr>
	      <tr>
	        <td>Score:</td>
	        <td> {{$match[0]->home_score}}</td>
	        <td> - </td>
	        <td>{{$match[0]->away_score}}</td>
	      </tr>
	  </table>
	</div>

<h3 style="margin-top: 50px;"> Bet info </h3>
	<table class="table" border = "1px" cellpadding = "5px">
	<thead>
     	<tr>
	      	<th  colspan = "2"> Home </th>
	     	<th  colspan = "2"> draw</th>
	     	<th  colspan = "2"> away </th>
      	</tr>
      </thead>
      <tbody>
    	<tr>
	      	<th  colspan = "1"> sum bet </th>
	     	<th  colspan = "1"> sum money </th>
	     	<th  colspan = "1"> sum bet </th>
	      	<th  colspan = "1"> sum money </th>
	        <th  colspan = "1"> sum bet </th>
	      	<th  colspan = "1">	sum money  </th>
     	</tr>
     	<tr>
	      	<th  colspan = "1"> {{$sum_bet_for_home}} </th>
	     	<th  colspan = "1"> {{$sum_money_bet_for_home}} </th>
	     	<th  colspan = "1"> {{$sum_bet_for_draw}} </th>
	      	<th  colspan = "1"> {{$sum_money_bet_for_draw}} </th>
	        <th  colspan = "1"> {{$sum_bet_for_away}} </th>
	      	<th  colspan = "1">	{{$sum_money_bet_for_away}}  </th>
     	</tr>
     	</tbody>
	</table>

	</div>

</body>
</html>