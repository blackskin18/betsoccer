<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ URL::asset('/css/all.css') }}" />
</head>
<body>
	<div>
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
		      </button>
		      <a class="navbar-brand" href="../list-match">Socer bet</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	<li>
		        	<a href="../../user/list-match" target="_self"> user </a> </li>
		        <li>
		        	<a href="../public-list-match" target="_self"> list public match </a> </li>
		        <li> <a href="../create-match" target="_self"> create match </a></li>
		        <li> <a href="../update-score" target="_self"> update score </a> </li>
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
	<div id = "content">
	<h3> Match info</h3>
	<table id = "table-name-match" class="table" style="width: 1000px;">
	    <thead>
	      <tr>
	        <th>Match</th>
	        <th>{{$match->home}}</th>
	        <th> vs </th>
	        <th>{{$match->away}}</th>
	      </tr>
	    </thead>
	    <tbody>
	      	<tr>
	        	<td>Rate</td>
	        	<td>{{$match->home_rate}}</td>
	       	 	<td>{{$match->draw_rate}}</td>
	       	 	<td>{{$match->away_rate}}</td>
	      	</tr>
	      	<tr>
	      		<td>Score</td>
				<td>{{$match->home_score}}</td>
	       	 	<td> - </td>
	       	 	<td>{{$match->away_score}}</td>
	      	</tr>
	    </tbody>
 	</table>
 	<br>
	<table id ="table-match-info" border = "1px" cellpadding = "5px" style="margin-left: 200px;">
	     	<tr> 
	     		<th  colspan = "1"> User </th>
		      	<th  colspan = "1"> Bet for home </th>
		     	<th  colspan = "1"> Bet for draw </th>
		     	<th  colspan = "1"> Bet for away  </th>
		      	<th  colspan = "1"> Money win</th>
	      	</tr>
	     	@foreach ($match_users as $match_user)
	    	<tr>
	    		<th  colspan = "1"> 
		    		@foreach($users as $user)
		    			@if ($user->id == $match_user->user_id)
		    				<b title="{{$user->email}}"> {{$user->name}} <b>
		    			@endif
		    		@endforeach
	    		</th>
	    		<th  colspan = "1"> 
	    			@if ($match_user->bet_for == 1)
	    				{{$match_user->money_bet}}
	    			@endif
	    		</th>
		      	<th  colspan = "1">  
		      		@if ($match_user->bet_for == 0)
	    			 	{{$match_user->money_bet}}
	    			@endif
		      	</th>
		     	<th  colspan = "1">  
		     		@if ($match_user->bet_for == -1)
	    				{{$match_user->money_bet}}
	    			@endif
		     	</th>
		     	<th  colspan = "1"> {{$match_user->money_win}} </th>
	     	</tr>
	     	@endforeach
	    </table>
	</div>
</body>
</html>